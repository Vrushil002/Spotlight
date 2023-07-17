<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function delete_img(){
		extract($_POST);
		if(is_file($path)){
			if(unlink($path)){
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete '.$path;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown '.$path.' path';
		}
		return json_encode($resp);
	}
	function save_post(){
		if(empty($_POST['id'])){
			$_POST['member_id'] = $this->settings->userdata('id');
			$prefix = date("Ymd");
			$code = sprintf("%'.04d", 1);
			if(!is_dir(base_app."uploads/posts/"))
			mkdir(base_app."uploads/posts/");

			while(true){
				if(is_dir(base_app."uploads/posts/".$prefix.$code."/")){
					$code = sprintf("%'.04d", abs($code) + 1);
				}else{
					mkdir(base_app."uploads/posts/".$prefix.$code."/");
					$file_path = "uploads/posts/".$prefix.$code."/";
					$_POST['upload_path'] = $file_path;

					break;
				}
			}
		}else{

		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `post_list` set {$data} ";
		}else{
			$sql = "UPDATE `post_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$aid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			$resp['aid'] = $aid;

			if(empty($id))
				$resp['msg'] = "New Post successfully saved.";
			else
				$resp['msg'] = " Post successfully updated.";

			if(isset($_FILES['img']) && count($_FILES['img']['tmp_name']) > 0){
				$err='';
				if(!is_dir(base_app.$file_path))
					mkdir(base_app.$file_path);
				foreach($_FILES['img']['tmp_name'] as $k => $v){
					if(!empty($_FILES['img']['tmp_name'][$k])){
						$accept = array('image/jpeg','image/png');
						if(!in_array($_FILES['img']['type'][$k],$accept)){
							$err = "Image file type is invalid";
							break;
						}
						if($_FILES['img']['type'][$k] == 'image/jpeg')
							$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name'][$k]);
						elseif($_FILES['img']['type'][$k] == 'image/png')
							$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name'][$k]);
						if(!$uploadfile){
							$err = "Image is invalid";
							break;
						}
						list($width, $height) =getimagesize($_FILES['img']['tmp_name'][$k]);
						if($width > 1200 || $height > 480){
							if($width > $height){
								$perc = ($width - 1200) / $width;
								$width = 1200;
								$height = $height - ($height * $perc);
							}else{
								$perc = ($height - 480) / $height;
								$height = 480;
								$width = $width - ($width * $perc);
							}
						}
						$temp = imagescale($uploadfile,$width,$height);
						$spath = base_app.$file_path.$_FILES['img']['name'][$k];
						$i = 1;
						while(true){
							if(is_file($spath)){
								$spath = base_app.$file_path.($i++).'_'.$_FILES['img']['name'][$k];
							}else{
								break;
							}
						}
						if($_FILES['img']['type'][$k] == 'image/jpeg')
						imagejpeg($temp,$spath,80);
						elseif($_FILES['img']['type'][$k] == 'image/png')
						imagepng($temp,$spath,8);
	
						imagedestroy($temp);
					}
				}
				if(!empty($err)){
					$resp['status'] = 'failed';
					$resp['msg'] = $err;
				}
			}
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_post(){
		extract($_POST);
		$path = $this->conn->query("SELECT upload_path from `post_list` where id = '{$id}'")->fetch_array()[0];
		$del = $this->conn->query("DELETE FROM `post_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Post successfully deleted.");
			if(is_dir(base_app.$path)){
				$fopen = scandir(base_app.$path);
				foreach($fopen as $file){
					if(!in_array($file, ['.', '..']) && is_file(base_app.$path.$file)){
						unlink(base_app.$path.$file);
					}
				}
				rmdir(base_app.$path);
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function update_post_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `post_list` set `status` = '{$status}' where id = '{$id}' ");
		if($update){
			$resp['status'] = 'success';
			$resp['msg'] = 'post\'s Status has been updated successfully.';
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = $this->conn->error;
		}
		if($resp['status'])
		$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function update_like(){
		extract($_POST);
		if($status == 1){
			$sql = "INSERT INTO `like_list` set post_id = '{$post_id}', member_id = '{$this->settings->userdata('id')}'";
		}else{
			$sql = "DELETE FROM `like_list` where post_id = '{$post_id}' and member_id = '{$this->settings->userdata('id')}'";
		}
		$process = $this->conn->query($sql);
		if($process){
			$resp['status'] = 'success';
			$resp['likes'] = $this->conn->query("SELECT member_id FROM `like_list` where post_id = '{$post_id}'  ")->num_rows;
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_comment(){
		extract($_POST);
		$sql = "INSERT INTO `comment_list` set post_id = '{$post_id}', member_id = '{$this->settings->userdata('id')}', `message` = '{$comment}'";
		$process = $this->conn->query($sql);
		if($process){
			$resp['status'] = 'success';
			$resp['comments'] = $this->conn->query("SELECT member_id FROM `comment_list` where post_id = '{$post_id}'  ")->num_rows;
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function delete_comment(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `comment_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Comment successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function update_personal_info(){
		$data = "";
		foreach($_POST as $k=> $v){
			if(!empty($data)) $data .= ", ";
			$data .= "('{$this->settings->userdata('id')}', '{$this->conn->real_escape_string($k)}', '{$this->conn->real_escape_string($v)}')";
		}
		if(!empty($data)){
			$sql = "INSERT INTO `member_meta` (`member_id`, `meta_field`, `meta_value`) VALUES {$data}";
			$this->conn->query("DELETE FROM `member_meta` where member_id = '{$this->settings->userdata('id')}'");
			$save = $this->conn->query($sql);
			if($save){
				$resp['status'] = 'success';
				$resp['msg'] = 'Your Personal Information has been updated successfully';
			}else{
				$resp['status'] = 'failed';
				$resp['sql'] = $sql;
				$resp['msg'] = $this->conn->error;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "No data has been sent.";
		}

		if($resp['status'] && isset($resp['msg']))
		$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function search_user(){
		extract($_POST);
		$sql = "SELECT *, concat(firstname,coalesce(concat(' ', middlename),''), ' ', lastname) as `name` FROM `member_list` where (concat(firstname,coalesce(concat(' ', middlename),''), ' ', lastname) LIKE '%$search%' or concat(firstname, ' ', lastname) LIKE '%$search%' or concat(lastname,' ', firstname,coalesce(concat(' ', middlename),'')) LIKE '%$search%' or email LIKE '%{$search}%') and id != '{$this->settings->userdata('id')}' ";
		$data = [];
		$qry = $this->conn->query($sql);
		if($qry){
			$data['status'] = 'success';
			if($qry->num_rows > 0){
				while($row = $qry->fetch_assoc()){
					$row['avatar'] = validate_image($row['avatar']);
					$data['data'][] = $row;
				}
			}
		}else{
			$data['status'] = 'failed';
			$data['msg'] = $this->conn->error;
		}
		return json_encode($data);
	}
	function add_friend(){
		extract($_POST);
		$check = $this->conn->query("SELECT * FROM `request_list` where (member_id = '{$this->settings->userdata('id')}' and ask_member_id = '{$ask_member_id}') OR (ask_member_id = '{$this->settings->userdata('id')}' and member_id = '{$ask_member_id}') ");
		if($check->num_rows > 0){
			$resp['status'] = 'failed';
			$result = $check->fetch_array();
			if($result['status'] == 0){
				if($result['member_id'] == $this->settings->userdata('id')){
					$resp['msg'] = "You already sent request on this user.";
				}else{
					$resp['msg'] = "This user already sent you a request.";
				}
			}elseif($result['status'] == 3){
				$resp['msg'] = "You declined this user's friend request already.";
			}else{
				$resp['msg'] = "You are already friend with this user.";
			}
		}else{
			$sql = "INSERT INTO `request_list` (`member_id`, `ask_member_id`) VALUES ('{$this->settings->userdata('id')}', '{$ask_member_id}')";
			$save = $this->conn->query($sql);
			if($save){
				$resp['status'] = 'success';
				$resp['msg'] = "Friend Request Succesfully Sent.";
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
			}
		}
		
		if($resp['status']=='success' && isset($resp['msg']))
		$this->settings->set_flashdata('success', $resp['msg']);
		return json_encode($resp);
	}
	function confirm_request(){
		extract($_POST);
		$sql = "UPDATE `request_list` set `status` = 1 where id = '{$request_id}'";
		$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			$resp['msg'] = "Request has been confirmed successfully.";
		}else{
			$resp['status'] = "failed";
			$resp['error'] = $this->conn->error;
			$resp['sql'] = $sql;
		}

		if($resp['status']=='success' && isset($resp['msg']))
		$this->settings->set_flashdata('success', $resp['msg']);

		return json_encode($resp);
	}
	function decline_request(){
		extract($_POST);
		$sql = "UPDATE `request_list` set `status` = 3 where id = '{$request_id}'";
		$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			$resp['msg'] = "Request has been declined successfully.";
		}else{
			$resp['status'] = "failed";
			$resp['error'] = $this->conn->error;
			$resp['sql'] = $sql;
		}

		if($resp['status']=='success' && isset($resp['msg']))
		$this->settings->set_flashdata('success', $resp['msg']);

		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'delete_img':
		echo $Master->delete_img();
	break;
	case 'save_post':
		echo $Master->save_post();
	break;
	case 'delete_post':
		echo $Master->delete_post();
	break;
	case 'update_post_status':
		echo $Master->update_post_status();
	break;
	case 'update_like':
		echo $Master->update_like();
	break;
	case 'save_comment':
		echo $Master->save_comment();
	break;
	case 'delete_comment':
		echo $Master->delete_comment();
	break;
	case 'update_personal_info':
		echo $Master->update_personal_info();
	break;
	case 'search_user':
		echo $Master->search_user();
	break;
	case 'add_friend':
		echo $Master->add_friend();
	break;
	case 'confirm_request':
		echo $Master->confirm_request();
	break;
	case 'decline_request':
		echo $Master->decline_request();
	break;
	default:
		// echo $sysset->index();
		break;
}
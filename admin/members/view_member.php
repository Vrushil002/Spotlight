<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT *, concat(lastname, ', ', firstname, ' ', coalesce(middlename,'')) as `name` from `member_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
        if(isset($id)){
            $meta_qry = $conn->query("SELECT * FROM `member_meta` where `member_id` = '{$id}' ");
            while($row = $meta_qry->fetch_assoc()){
                ${$row['meta_field']} = $row['meta_value'];
            }
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
    #indi-img{
        width:6em;
        height:6em;
        object-fit:cover;
        object-position:center center;
    }
</style>
<div class="container-fluid">
    <center>
        <img src="<?= validate_image(isset($avatar) ? $avatar : '') ?>" alt="" class="img-thumbnail rounded-circle" id="indi-img">
    </center>
    <div class="d-flex w-100">
        <div class="col-auto text-muted">Name:</div>
        <div class="col-auto flex-shrink-1 flex-grow-1 font-weight-bolder"><?= isset($name) ? $name : '' ?></div>
    </div>
    <div class="d-flex w-100">
        <div class="col-auto text-muted">Email:</div>
        <div class="col-auto flex-shrink-1 flex-grow-1 font-weight-bolder"><?= isset($email) ? $email : '' ?></div>
    </div>
</div>
<div class="mt-3 text-right">
    <button class="btn btn-light bg-gradient-light" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</div>
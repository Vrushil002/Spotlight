<?php
$id = $_GET['id'];
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$qry = $conn->query("SELECT p.*, concat(m.firstname, ' ', coalesce(concat(m.middlename,' '),''),m.lastname) as `name`, m.avatar, COALESCE((SELECT count(member_id) FROM `like_list` where post_id = p.id),0) as `likes`, COALESCE((SELECT count(member_id) FROM `comment_list` where post_id = p.id),0) as `comments` FROM post_list p inner join `member_list` m on p.member_id = m.id where p.id = '{$_GET['id']}'");
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_assoc() as $k => $v) {
			$$k = $v;
		}
		if (isset($id)) {
			$qry_like = $conn->query("SELECT post_id FROM `like_list` where post_id = '{$id}' and member_id = '{$_settings->userdata('id')}'")->num_rows > 0;
		}
	} else {
		echo '<script> alert("Post ID is invalid."); location.replace("./?page=user/profile");</script>';
	}
} else {
	echo '<script> alert("Post ID is required."); location.replace("./?page=user/profile");</script>';
}
?>
<div class="mx-0 py-5 px-3 mx-ns-4 bg-gradient-light shadow blur">
	<h3><b>Post Details</b></h3>
</div>
<style>
	.avatar-img {
		height: 3em;
		width: 3em !important;
		object-fit: cover;
		object-position: center;
	}
</style>
<div class="row justify-content-center" style="margin-top:-2em;">
	<div class="col-lg-6 col-md-8 col-sm-11 col-xs-11">
		<div class="card rounded-0 shadow">
			<div class="card-body">
				<div class="container-fluid">
					<div class="d-flex w-100 align-items-center">
						<div class="col-auto">
							<img src="<?= validate_image(isset($avatar) ? $avatar : '') ?>" alt=""
								class="avatar-img img-thumbnail rounded-circle p-0">
						</div>
						<div class="col-auto flex-shrink-1 flex-grow-1">
							<div style="line-height:1em">
								<div class="font-weight-bolder">
									<?= isset($name) ? $name : '' ?>
								</div>
								<div class="text-meted"><small>Posted <i class="far fa-calendar"></i>
										<?= isset($date_created) ? date("M d, Y h:i A", strtotime($date_created)) : '' ?>
									</small></div>
							</div>
						</div>
					</div>
					<hr>
					<div>
						<div class="truncate-5 truncated-text">
							<?= isset($caption) ? str_replace(["\n\r", "\n", "\r"], "<br />", $caption) : '' ?>
						</div>
						<a href="javascript:void(0)" class="seemore d-none">Read More</a>
						<a href="javascript:void(0)" class="seeless d-none">Show Less</a>
					</div>
					<a href="http://<?php echo $reg_link ?>">Link</a>
					<div class="container-fluid bg-gradient-dark" style="height: 30em !important">
						<?php
						if (isset($upload_path) && is_dir(base_app . $upload_path)):
							$files = array();
							$fopen = scandir(base_app . $upload_path);
							if (count($fopen) > 2):
								?>
								<?php
								foreach ($fopen as $fname) {
									if (in_array($fname, array('.', '..')))
										continue;
									$files[] = validate_image($upload_path . $fname);
								}
								?>
								<div id="post<?= isset($id) ? $id : '' ?>" class="carousel slide h-100" data-interval="false">
									<ol class="carousel-indicators">
										<?php foreach ($files as $k => $img): ?>
											<li data-target="#post<?= isset($id) ? $id : '' ?>" data-slide-to="<?= $k ?>"
												class=" <?php echo $k == 0 ? 'active' : '' ?>"></li>
										<?php endforeach; ?>
									</ol>
									<div class="carousel-inner h-100">
										<?php foreach ($files as $k => $img): ?>
											<div class="carousel-item  h-100 <?php echo $k == 0 ? 'active' : '' ?>">
												<img class="d-block w-100  h-100" style="object-fit:scale-down"
													src="<?php echo $img ?>" alt="">
											</div>
										<?php endforeach; ?>
									</div>
									<?php if (count($files) > 1): ?>
										<a class="carousel-control-prev" href="#post<?= isset($id) ? $id : '' ?>" role="button"
											data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#post<?= isset($id) ? $id : '' ?>" role="button"
											data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
										</a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<hr class="mx-n4">
					<?php if (isset($qry_like) && !!$qry_like): ?>
						<a href="javascript:void(0)" data-like='true' class="text-reset text-decoration-none like_post"
							data-id="<?= isset($id) ? $id : '' ?>"><i class="fa fa-heart text-danger"></i></a>
					<?php else: ?>
						<a href="javascript:void(0)" data-like='false' class="text-reset text-decoration-none like_post"
							data-id="<?= isset($id) ? $id : '' ?>"><i class="far fa-heart"></i></a>
					<?php endif; ?>
					<span class="like-count font-style-italic">
						<?= isset($likes) ? format_num($likes) : 0 ?>
					</span>
					<a href="javascript:void(0)" class="text-reset text-decoration-none post_comments"
						data-id="<?= isset($id) ? $id : '' ?>"><i class="far fa-comment"></i></a>
					<span class="comment-count font-style-italic">
						<?= isset($comments) ? format_num($comments) : 0 ?>
					</span>
					<hr class="mx-n4 mb-3">
					<div class="mx-n4">
						<div class="list-group mb-3">
							<?php if (isset($id)): ?>
								<?php
								$comment_qry = $conn->query("SELECT c.*, concat(m.firstname, ' ', coalesce(concat(middlename,' '),''),m.lastname) as `name` FROM `comment_list` c inner join member_list m on c.member_id = m.id where c.post_id = '{$id}'");
								while ($crow = $comment_qry->fetch_assoc()):
									?>
									<div class="list-group-item">
										<div class="d-flex w-100">
											<div class="col-auto flex-shrink-1 flex-grow-1">
												<b class="mr-2">
													<?= $crow['name'] ?>
												</b>
												<span>
													<?= str_replace(["\n", "\r", "\n\r"], '<br/>', $crow['message']) ?>
												</span>
											</div>
											<?php if ($crow['member_id'] == $_settings->userdata('id')): ?>
												<div class="col-auto">
													<div class="dropdown">
														<a class="text-reset text-decoration-none" type="button"
															id="comment<?= $crow['id'] ?>" data-toggle="dropdown"
															aria-haspopup="true" aria-expanded="false">
															<i class="fa fa-ellipsis-v"></i>
														</a>
														<div class="dropdown-menu" aria-labelledby="comment<?= $crow['id'] ?>">
															<a class="dropdown-item delete-comment" data-id="<?= $crow['id'] ?>"
																href="javascript:void(0)">Delete</a>
														</div>
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-center py-1">
				<button class="btn btn-danger bg-gradient-danger rounded-0" id="delete-data"><i class="fa fa-trash"></i>
					Delete Post</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#delete-data').click(function () {
			_conf("Are you sure to delete this post permanently?", "delete_post", ['<?= isset($id) ? $id : '' ?>'])
		})
		$('.delete-comment').click(function () {
			_conf('Are you sure to delete this comment?', 'delete_comment', [$(this).attr('data-id')])
		})
		$('.truncate-5').each(function () {
			var _this = $(this)
			var oh = _this[0].offsetHeight
			var sh = _this[0].scrollHeight
			if (oh < sh) {
				_this.siblings('.seemore').removeClass('d-none')
			}
		})
		$('.seemore').click(function () {
			$(this).addClass('d-none')
			$(this).siblings('.seeless').removeClass('d-none')
			$(this).siblings('.truncated-text').removeClass('truncate-5')
		})
		$('.seeless').click(function () {
			$(this).addClass('d-none')
			$(this).siblings('.seemore').removeClass('d-none')
			$(this).siblings('.truncated-text').addClass('truncate-5')
		})
		$('.carousel').each(function () {
			var _this = $(this)
			if (_this.find('.carousel-item:nth-child(1)').hasClass('active')) {
				_this.find('.carousel-control-prev').addClass('d-none')
			} else {
				_this.find('.carousel-control-prev').removeClass('d-none')
			}
			if (_this.find('.carousel-item:nth-last-child(1)').hasClass('active')) {
				_this.find('.carousel-control-next').addClass('d-none')
			} else {
				_this.find('.carousel-control-next').removeClass('d-none')
			}
		})
		$('.carousel').on('slid.bs.carousel', function () {
			var _this = $(this)
			if (_this.find('.carousel-item:nth-child(1)').hasClass('active')) {
				_this.find('.carousel-control-prev').addClass('d-none')
			} else {
				_this.find('.carousel-control-prev').removeClass('d-none')
			}
			if (_this.find('.carousel-item:nth-last-child(1)').hasClass('active')) {
				_this.find('.carousel-control-next').addClass('d-none')
			} else {
				_this.find('.carousel-control-next').removeClass('d-none')
			}
			if (_this.find('.carousel-item').length > 2 && !_this.find('.carousel-item:nth-child(1)').hasClass('active') && !_this.find('.carousel-item:nth-last-child(1)').hasClass('active')) {
				_this.find('.carousel-control-prev').removeClass('d-none')
				_this.find('.carousel-control-next').removeClass('d-none')
			}
		})
	})

	function delete_post($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_post",
			method: "POST",
			data: { id: $id },
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function (resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.replace("./?page=posts");
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
	function delete_comment($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_comment",
			method: "POST",
			data: { id: $id },
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function (resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload()
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
</script>
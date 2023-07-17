<h1>Welcome to <?php echo $_settings->info('name') ?> - Management Site</h1>
<hr>
<div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-gradient-secondary elevation-1"><i class="fas fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Members</span>
            <span class="info-box-number">
              <?php 
                $member = $conn->query("SELECT * FROM member_list")->num_rows;
                echo format_num($member);
              ?>
              <?php ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-image"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Posts</span>
          <span class="info-box-number">
            <?php 
              $posts = $conn->query("SELECT * FROM post_list")->num_rows;
              echo format_num($posts);
            ?>
            <?php ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div class="container-fluid">
  <?php 
    $files = array();
      $fopen = scandir(base_app.'uploads/banner');
      foreach($fopen as $fname){
        if(in_array($fname,array('.','..')))
          continue;
        $files[]= validate_image('uploads/banner/'.$fname);
      }
  ?>
  <div id="tourCarousel"  class="carousel slide" data-ride="carousel" data-interval="2500" data-pause="false">
      <div class="carousel-inner h-100">
          <?php foreach($files as $k => $img): ?>
          <div class="carousel-item  h-100 <?php echo $k == 0? 'active': '' ?>">
              <img class="d-block w-100  h-100" style="object-fit:contain" src="<?php echo $img ?>" alt="">
          </div>
          <?php endforeach; ?>
      </div>
  </div>
</div>

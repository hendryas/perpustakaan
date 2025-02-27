<style>
  .profile_card {
    position: relative;
    float: left;
    overflow: hidden;
    width: 100%;
    text-align: center;
    height: 320px;
    border: none;
  }

  .profile_card .background-block {
    float: left;
    width: 100%;
    height: 200px;
    overflow: hidden;
  }

  .profile_card .background-block .background {
    width: 100%;
    vertical-align: top;
    opacity: 0.9;
    -webkit-filter: blur(0.5px);
    filter: blur(0.5px);
    -webkit-transform: scale(1.8);
    transform: scale(2.8);
  }

  .profile_card .card-content {
    width: 100%;
    padding: 15px 25px;
    color: #232323;
    float: left;
    background: #efefef;
    height: 50%;
    border-radius: 0 0 5px 5px;
    position: relative;
    z-index: 9999;
  }

  .profile_card .card-content::before {
    content: '';
    background: #efefef;
    width: 120%;
    height: 100%;
    left: 1px;
    bottom: 63px;
    position: absolute;
    z-index: -1;
    transform: rotate(-11deg);
  }

  .icon-block a {
    margin-right: 10px;
  }

  .profile_card .profile {
    border-radius: 50%;
    position: absolute;
    bottom: 50%;
    left: 50%;
    max-width: 100px;
    opacity: 1;
    box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.5);
    border: 2px solid rgba(255, 255, 255, 1);
    -webkit-transform: translate(-50%, 0%);
    transform: translate(-50%, 0%);
    z-index: 99999;
  }

  .profile_card h2 {
    margin: 0 0 5px;
    font-weight: 600;
    font-size: 25px;
  }

  .profile_card h2 small {
    display: block;
    font-size: 15px;
    margin-top: 10px;
  }

  .profile_card i {
    display: inline-block;
    font-size: 16px;
    color: #232323;
    text-align: center;
    border: 1px solid #232323;
    width: 30px;
    height: 30px;
    line-height: 30px;
    border-radius: 50%;
    margin: 0 5px;
  }

  .profile_card .icon-block {
    float: left;
    width: 100%;
    margin-top: 15px;
  }

  .profile_card .icon-block a {
    text-decoration: none;
  }

  .profile_card i:hover {
    background-color: #232323;
    color: #fff;
    text-decoration: none;
  }

  .box-part {
    background: #FFF;
    border-radius: 0;
    padding: 50px 10px;
    margin: 30px 0px;
  }

  .edt_icon {
    width: 25px;
    margin-left: 10px;
    margin-bottom: 9px;
  }

  .icon_bottom_s {
    width: 60px;
    margin-bottom: 20px;
  }
</style>
<div class="wrapper">
  <div class="container-fluid">

    <!-- Page-Title -->
    <div class="row mt-3">
      <div class="col-sm-12">
        <div class="page-title-box">
          <div class="btn-group float-right">
            <ol class="breadcrumb hide-phone p-0 m-0">
              <li class="breadcrumb-item"><a href="#"><?php echo $title; ?></a></li>
            </ol>
          </div>
          <h4 class="page-title"><?php echo $title; ?></h4>
        </div>
      </div>
    </div>
    <!-- end page title end breadcrumb -->

    <!--====START CONTENT HERE =====-->

    <section>
      <div class="container mt-2">
        <div class="row">
          <div class="col-md-3"></div>

          <!--Profile Card 3-->
          <div class="col-md-6">
            <div class="card profile_card">
              <div class="background-block">
                <img src="https://live.staticflickr.com/7368/26944418810_1c420df3e3_b.jpg" alt="profile-sample1" class="background" />

              </div>
              <div class="profile-thumb-block">
                <?php if ($user['gender'] == 2) : ?>
                  <img src="<?php echo base_url('assets/images/default.png'); ?>" style="width: 120px; height: 99px;" alt="profile-image" class="profile" />
                <?php else : ?>
                  <img src="<?php echo base_url('assets/images/default.png'); ?>" style="width: 120px; height: 99px;" alt="profile-image" class="profile" />
                <?php endif; ?>
              </div>
              <div class="card-content">
                <span style="font-size: 20px; font-weight: 600;"><?php echo $user['name'] ?></span>
                <br>
                <p>
                  <?php echo $user['email'] ?>
                </p>
                <p>
                  <?php echo $user['phone'] ?>
                </p>
              </div>
            </div>
          </div>

        </div>



      </div>
  </div>
  </section>
  <!--====END CONTENT HERE =====-->

</div> <!-- end container -->
</div>
<!-- end wrapper -->
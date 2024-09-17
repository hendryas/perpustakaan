<style>
  .piechart_3d {
    width: 800px;
    height: 450px;
  }

  .container {
    padding: 2rem;
  }

  .slider__wrapper {
    position: relative;
    max-width: 48rem;
    margin: 0 auto;
    /*   background-color: blue; */
  }

  .slider {
    display: flex;
    aspect-ratio: 16 / 9;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    scroll-behavior: smooth;
    box-shadow: 0 1.5rem 3rem -0.75rem hsla(0, 0%, 0%, 0.25);
    border-radius: 1rem;
    -ms-overflow-style: none;
    scrollbar-width: none;
  }

  .slider::-webkit-scrollbar {
    display: none;
  }

  .slider img {
    flex: 1 0 100%;
    /* This will stretch the image*/
    scroll-snap-align: start;
    object-fit: cover;
    /* This will fix the stretch tho the image will be croppped a bit */
  }

  .slider__nav {
    display: flex;
    column-gap: 1rem;
    position: absolute;
    bottom: 1.25rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1;
  }

  .slider__nav a {
    width: 1.2rem;
    height: 1.2rem;
    border-radius: 50%;
    background-color: #fff;
    opacity: 0.5;
    transition: opacity ease 0.25s;
  }

  .slider__nav a:hover {
    opacity: 1;
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
    <div class="card">

      <h5 class="text-center mt-5">Selamat Datang</h5>
      <p class="text-center">Selamat datang di dashboard perpustakaan, tempat di mana Anda dapat dengan mudah mengakses dan mengelola <br> koleksi buku serta informasi penting lainnya.</p>
      <div class="row">
        <div class="col-xl-12">
          <section class="container">
            <div class="slider__wrapper">
              <div class="slider">
                <img src="<?= base_url('assets/images/carousel1.jpg') ?>" alt="" id="slide1">
                <img src="<?= base_url('assets/images/carousel2.jpg') ?>" alt="" id="slide2">
              </div>
              <div class="slider__nav">
                <a id="btn1" href="#slide1"></a>
                <a id="btn2" href="#slide2"></a>
              </div>
            </div>
          </section>
        </div>

      </div>

      <div class="row">
        <div class="col-xl-3 col-md-6 ml-3">
          <div class="card mini-stat m-b-30">
            <div class="p-3 bg-primary text-white">
              <div class="mini-stat-icon">
                <i class="mdi mdi-account-network float-right mb-0"></i>
              </div>
              <h6 class="text-uppercase mb-0 text-white">Total Peminjam</h6>
            </div>
            <div class="card-body">
              <div class="mt-4 text-muted">
                <h5 class="m-0"><?php echo count($jumlah_peminjam); ?><i class="mdi mdi-arrow-up text-success ml-2"></i></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--====END CONTENT HERE =====-->

  </div> <!-- end container -->
</div>
<!-- end wrapper -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" type='text/javascript'></script>
<script src="https://www.gstatic.com/charts/loader.js" type='text/javascript'></script>
<script>
  var counter = 2;

  setInterval(function() {
    document.getElementById('btn' + counter).click();
    counter++;
    // console.log(counter);
    if (counter == 4) {
      counter = 1;
    }
  }, 5000);
</script>
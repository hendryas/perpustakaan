<style>
  .card {
    border: 1px solid var(--color-three);
    margin-bottom: 20px;
    transition: border 0.1s, transform 0.3s;
  }

  .card:hover {
    border: 1px solid var(--color-two);
    -webkit-transform: translateY(-10px);
    transform: translateY(-10px);
  }

  .card .card-body h2 {
    color: var(--color-two);
  }

  .card img:hover {
    opacity: 0.6;
  }

  .card-p {
    color: var(--color-three);
  }

  .card-p i {
    color: var(--color-two);
    margin-right: 8px;
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
    <div class="col-lg">
      <div class="card m-b-30">
        <div class="card-body">

          <h4 class="mt-0 header-title">List Buku</h4>
          <p class="text-muted m-b-30 font-14">
            Selamat datang, silahkan melihat list buku di bawah ini.
          </p>

          <?php echo $this->session->flashdata('message'); ?>

          <!-- <a href="#" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-target="#newMenuModal">Tambahkan menu baru</a> -->

          <div class="container">
            <div class="row">
              <?php foreach ($data_buku as $buku) : ?>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                  <div class="card shadow">
                    <img src="<?= base_url('assets/images/buku/') . $buku['image'] ?>" class="card-img-top" alt="..." width="200">
                    <div class="card-body">
                      <h2 class="card-title"><?php echo $buku['judul']; ?></h2>
                      <p class="card-text">
                        <?php
                        $dateString2 = $buku['tahun_terbit'];
                        $dateTime = new DateTime($dateString2);
                        $formattedDate = $dateTime->format("d-m-Y");
                        ?>
                        Penulis : <?php echo $buku['penulis']; ?>
                        <br>
                        Penerbit : <?php echo $buku['penerbit']; ?>
                        <br>
                        Tahun : <?php echo $formattedDate; ?>
                        <br>
                        Jumlah Kopi : <?php echo $buku['jumlah_kopi']; ?>
                      </p>
                    </div>
                    <div class="card-body card-p">
                      <div class="row">
                        <div class="col col-xs-4 ">
                          <a href="#">
                            <span class="badge badge-success waves-effect waves-light" data-toggle="modal" data-target="#newPinjam<?php echo $buku['id_manajemen_buku']; ?>">Pinjam</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>

        </div>
      </div>
    </div> <!-- end col -->
    <!--====END CONTENT HERE =====-->

  </div> <!-- end container -->
</div>
<!-- end wrapper -->

<!-- START EDIT MENU MODAL -->
<?php
foreach ($data_buku as $buku) :  ?>
  <div class="modal fade" id="newPinjam<?php echo $buku['id_manajemen_buku']; ?>" tabindex="-1" aria-labelledby="newPinjamLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newPinjamLabel">Form Pinjam Buku</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url(); ?>buku/pinjambuku" method="POST">
          <input type="hidden" name="id_manajemen_buku" value="<?php echo $buku['id_manajemen_buku']; ?>">
          <input type="hidden" name="id_user" value="<?php echo $user['id']; ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama_peminjam">Nama Peminjam</label>
              <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" autocomplete="off" value="<?php echo $user['name']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="email_peminjam">Email Peminjam</label>
              <input type="text" class="form-control" id="email_peminjam" name="email_peminjam" autocomplete="off" value="<?php echo $user['email']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="judul_buku">Judul Buku</label>
              <input type="text" class="form-control" id="judul_buku" name="judul_buku" autocomplete="off" value="<?php echo $buku['judul']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="penulis_buku">Penulis Buku</label>
              <input type="text" class="form-control" id="penulis_buku" name="penulis_buku" autocomplete="off" value="<?php echo $buku['penulis']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="penerbit_buku">Penerbit Buku</label>
              <input type="text" class="form-control" id="penerbit_buku" name="penerbit_buku" autocomplete="off" value="<?php echo $buku['penerbit']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="tahun_terbit">Tahun Terbit Buku</label>
              <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" autocomplete="off" value="<?php echo $buku['tahun_terbit']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="tanggal_pinjam">Tanggal Pinjam</label>
              <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="tanggal_kembali">Tanggal Kembali</label>
              <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" autocomplete="off">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Pinjam</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<!-- END EDIT MENU MODAL -->


<!-- Footer -->
<?php $this->load->view('templates/footers/footer'); ?>
<!-- End Footer -->
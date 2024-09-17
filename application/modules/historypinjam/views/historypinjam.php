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

          <h4 class="mt-0 header-title">History Pinjam Buku</h4>
          <p class="text-muted m-b-30 font-14">

          </p>

          <?php echo $this->session->flashdata('message'); ?>

          <!-- <a href="#" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-target="#newMenuModal">Tambahkan menu baru</a> -->

          <div class="table-responsive">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                <tr class="text-center sticky-header">
                  <th>#</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Tanggal Pinjam</th>
                  <th>Tanggal Pengembalian</th>
                  <th>Gambar</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_buku as $buku) : ?>
                  <tr class="text-center">
                    <th scope="row"><?php echo $no; ?></th>
                    <td><?php echo $buku['judul']; ?></td>
                    <td><?php echo $buku['penulis']; ?></td>
                    <td>
                      <?php
                      $dateTime = new DateTime($buku['tanggal_pinjam']);
                      $datatanggal_pinjam = $dateTime->format("Y-m-d");
                      ?>
                      <?php echo $datatanggal_pinjam; ?>
                    </td>
                    <td>
                      <?php
                      $dateTime = new DateTime($buku['tanggal_pengembalian']);
                      $datatanggal_pengembalian = $dateTime->format("Y-m-d");
                      ?>
                      <?php echo $datatanggal_pengembalian; ?>
                    </td>
                    <td>
                      <?php if ($buku['image'] != null) : ?>
                        <div class="form-group">
                          <br>
                          <img src="<?php echo base_url('assets/images/buku/') . $buku['image']; ?>" width="200" height="150" alt="Gambar Product">
                        </div>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php
                      $dateString = date('Y-m-d');
                      $tanggal_sekarang = strtotime($dateString);

                      $dateString2 = $buku['tanggal_pengembalian'];
                      $dateTime = new DateTime($dateString2);
                      $formattedDate = $dateTime->format("Y-m-d");
                      $tanggal_pengembalian = strtotime($formattedDate);

                      // var_dump($timestamp);
                      // var_dump($timestamp2);
                      // var_dump($tanggal_pengembalian <= $tanggal_sekarang);
                      ?>
                      <?php if ($tanggal_sekarang  <= $tanggal_pengembalian) : ?>
                        <a href="#">
                          <span class="btn btn-info waves-effect waves-light">Masih Dalam Masa Peminjaman</span>
                        </a>
                      <?php else : ?>
                        <a href="#">
                          <span class="btn btn-danger waves-effect waves-light">Segera Lakukan Pengembalian</span>
                        </a>
                      <?php endif; ?>
                    </td>
                  </tr>
                  <?php $no++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> <!-- end col -->
    <!--====END CONTENT HERE =====-->

  </div> <!-- end container -->
</div>
<!-- end wrapper -->



<!-- Footer -->
<?php $this->load->view('templates/footers/footer'); ?>
<!-- End Footer -->
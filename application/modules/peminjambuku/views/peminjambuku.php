<style>
  /* table th {
        position: sticky;
        top: 0px;

        background-color: teal;
    }

    .table-wrapper {
        max-height: 300px;
        overflow-y: scroll;
    } */

  table {
    overflow: scroll;
    border-collapse: collapse;
    color: black;
  }

  .secondaryContainer {
    overflow: scroll;
    border-collapse: collapse;
    height: 500px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 10px;
  }

  th {
    width: 150px;
    white-space: nowrap;
    height: 30px;
    padding: 15px;
    position: sticky;
    top: 0;
    background-color: white;
  }

  td {
    border-bottom: 1px solid #ddd;
    text-align: center;
    min-width: 200px;
    white-space: nowrap;
    height: 30px;
  }

  tr {
    height: 60px;
  }

  .badge-style-success {
    font-weight: 600;
    line-height: 1.4;
    padding: 3px 6px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
    background-color: #54cc96;
    color: #fff;
  }

  .badge-style-danger {
    font-weight: 600;
    line-height: 1.4;
    padding: 3px 6px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
    background-color: #e7515a;
    color: #fff;
  }

  .btn-style-secondary {
    padding: 0.4375rem 1.25rem;
    text-shadow: none;
    font-size: 14px;
    color: white;
    font-weight: normal;
    white-space: normal;
    word-wrap: break-word;
    transition: .2s ease-out;
    touch-action: manipulation;
    cursor: pointer;
    background-color: #ffc107;
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

          <h4 class="mt-0 header-title">Peminjam buku</h4>
          <p class="text-muted m-b-30 font-14">

          </p>

          <?php echo $this->session->flashdata('message'); ?>

          <!-- <a href="#" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-target="#newMenuModal">Tambahkan menu baru</a> -->

          <div class="table-responsive secondaryContainer">
            <table id="datatable" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                <tr class="text-center">
                  <th style="position:sticky;">#</th>
                  <th style="position:sticky;">Judul</th>
                  <th style="position:sticky;">Penulis</th>
                  <th style="position:sticky;">Tanggal Pinjam</th>
                  <th style="position:sticky;">Tanggal Pengembalian</th>
                  <th style="position:sticky;">Gambar</th>
                  <th style="position:sticky;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_buku as $buku) : ?>
                  <tr class="text-center">
                    <td scope="row"><?php echo $no; ?></td>
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
                        <?php if ($buku['status_pengembalian'] != 0) : ?>
                          <a href="#">
                            <span class="btn btn-success waves-effect waves-light">Selesai Pengembalian</span>
                          </a>
                        <?php else : ?>
                          <a href="#">
                            <span class="btn btn-info waves-effect waves-light">Masih Dalam Masa Peminjaman</span>
                          </a>
                          <br>
                          <a href="#"><span class="badge badge-success waves-effect waves-light mt-3" data-toggle="modal" data-target="#viewModal<?php echo $buku['id_peminjam_buku']; ?>">View</span></a>
                        <?php endif; ?>
                      <?php else : ?>
                        <?php if ($buku['status_pengembalian'] != 0) : ?>
                          <a href="#">
                            <span class="btn-style-secondary">Selesai Pengembalian</span>
                          </a>
                        <?php else : ?>
                          <a href="#">
                            <span class="btn btn-danger waves-effect waves-light">Segera Lakukan Pengembalian</span>
                          </a>
                          <br>
                          <a href="#"><span class="badge badge-success waves-effect waves-light mt-3" data-toggle="modal" data-target="#viewModal<?php echo $buku['id_peminjam_buku']; ?>">View</span></a>
                        <?php endif; ?>
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

<?php foreach ($data_buku as $buku) : ?>
  <div class="modal fade" id="viewModal<?php echo $buku['id_peminjam_buku']; ?>" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewModalLabel">Lihat Peminjam</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php
        $this->db->select('a.*');
        $this->db->where('a.id', $buku['id_user']);
        $this->db->from('user a');

        $data_user = $this->db->get()->row_array();
        ?>
        <form action="<?php echo base_url(); ?>peminjambuku/selesaipinjam" method="POST">
          <input type="hidden" name="id_peminjam_buku" value="<?php echo $buku['id_peminjam_buku']; ?>">
          <input type="hidden" name="id_manajemen_buku" value="<?php echo $buku['id_manajemen_buku']; ?>">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama_peminjam">Nama Peminjam</label>
              <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" autocomplete="off" value="<?php echo $data_user['name']; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="buku">Buku Yang di Pinjam</label>
              <input type="text" class="form-control" id="buku" name="buku" autocomplete="off" value="<?php echo $buku['judul']; ?>" readonly>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Kembalikan Buku</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<!-- END VIEW MENU MODAL -->



<!-- Footer -->
<?php $this->load->view('templates/footers/footer'); ?>
<!-- End Footer -->
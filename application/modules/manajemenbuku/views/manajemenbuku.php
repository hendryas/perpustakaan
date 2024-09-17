<!-- <style>
    table {
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;
    }

    td,
    th {
        padding: 5px;
        min-width: 200px;
        border-right: 1px solid #ccc
    }

    thead tr {
        display: block;
        position: relative;
    }

    tbody {
        display: block;
        height: 200px;
        width: 100%;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script> -->
<!-- <script>
    new DataTable('#example', {
        scrollX: true,
        scrollY: 200
    });
</script> -->
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
        height: 375px;
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

                    <h4 class="mt-0 header-title">Silahkan tambah data anda</h4>
                    <p class="text-muted m-b-30 font-14">
                        <!-- Liat tutorial <a href="#">disini</a>. -->
                    </p>

                    <?php echo $this->session->flashdata('message'); ?>

                    <a href="#" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-target="#newAddModal">Tambahkan Data</a>

                    <div class="table-responsive table-wrapper secondaryContainer">
                        <table id="datatable" class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr class="text-center">
                                    <th class="sticky-header" style="position:sticky;">#</th>
                                    <th class="sticky-header" style="position:sticky;">Judul</th>
                                    <th class="sticky-header" style="position:sticky;">Penulis</th>
                                    <th class="sticky-header" style="position:sticky;">Penerbit</th>
                                    <th class="sticky-header" style="position:sticky;">Tahun Terbit</th>
                                    <th class="sticky-header" style="position:sticky;">Jumlah Kopi</th>
                                    <th class="sticky-header" style="position:sticky;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($data_buku as $m) : ?>
                                    <tr class="text-center">
                                        <td scope="row"><?php echo $no; ?></td>
                                        <td><?php echo $m['judul']; ?></td>
                                        <td><?php echo $m['penulis']; ?></td>
                                        <td><?php echo $m['penerbit']; ?></td>
                                        <td>
                                            <?php
                                            $dateString2 = $m['tahun_terbit'];
                                            $dateTime = new DateTime($dateString2);
                                            $formattedDate = $dateTime->format("d-m-Y");
                                            ?>
                                            <?php echo $formattedDate; ?>
                                        </td>
                                        <td><?php echo $m['jumlah_kopi']; ?></td>
                                        <td>
                                            <a href="#"><span class="badge-style-success" data-toggle="modal" data-target="#newEditModal<?php echo $m['id_manajemen_buku']; ?>">Edit</span></a>

                                            <a class="btn-hapus" href="<?php echo base_url('manajemenbuku/delete/') . encrypt_url($m['id_manajemen_buku']); ?>"><span class="badge-style-danger">Delete</span></a>

                                            <!-- <a href="#"><span class="badge badge-success waves-effect waves-light" data-toggle="modal" data-target="#newEditModal<?php echo $m['id_manajemen_buku']; ?>">Edit</span></a> -->
                                            <!-- <a class="btn-hapus" href="<?php echo base_url('manajemenbuku/delete/') . encrypt_url($m['id_manajemen_buku']); ?>"><span class="badge badge-danger waves-effect waves-light ml-3">Delete</span></a> -->
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

<!-- START TAMBAH MENU MODAL -->
<div class="modal fade" id="newAddModal" tabindex="-1" aria-labelledby="newAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Tambah Data Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url(); ?>manajemenbuku/add" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="tahun_terbit">Tahun Terbit</label>
                        <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_kopi">Jumlah Kopi</label>
                        <input type="text" class="form-control" id="jumlah_kopi" name="jumlah_kopi" placeholder="Jumlah Kopi" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok Buku</label>
                        <input type="text" class="form-control" id="stok" name="stok" placeholder="Stok Buku" autocomplete="off">
                    </div>
                    <div class="form-group mt-3">
                        <label class="control-label">Upload Foto</label>
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">File Upload</h4>
                                <p class="text-muted mb-3">Upload gambar disini</p>
                                <input type="file" id="input-file-now" name="image" class="dropify" required />
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                        <small>Upload Maksimal 3MB</small>
                        <!--end form-group-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END TAMBAH MENU MODAL -->

<!-- START EDIT MENU MODAL -->
<?php
foreach ($data_buku as $m) :  ?>
    <div class="modal fade" id="newEditModal<?php echo $m['id_manajemen_buku']; ?>" tabindex="-1" aria-labelledby="newEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newEditModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url(); ?>manajemenbuku/edit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_manajemen_buku" value="<?php echo $m['id_manajemen_buku']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" value="<?= $m['judul'] ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis" value="<?= $m['penulis'] ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Penerbit" value="<?= $m['penerbit'] ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="tahun_terbit">Tahun Terbit</label>
                            <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?= $m['tahun_terbit'] ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_kopi">Jumlah Kopi</label>
                            <input type="text" class="form-control" id="jumlah_kopi" name="jumlah_kopi" placeholder="Jumlah Kopi" value="<?= $m['jumlah_kopi'] ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok Buku</label>
                            <input type="text" class="form-control" id="stok" name="stok" placeholder="Stok Buku" value="<?= $m['stok'] ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Preview Foto</label>
                            <br>
                            <img src="<?php echo base_url('assets/images/buku/') . $m['image']; ?>" width="200" height="150" alt="Gambar Product">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Upload Foto</label>
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <h4 class="mt-0 header-title">File Upload</h4>
                                    <p class="text-muted mb-3">Upload gambar disini</p>
                                    <input type="file" id="input-file-now" name="image" class="dropify" />
                                </div>
                                <!--end card-body-->
                            </div>
                            <!--end card-->
                            <small>Upload Maksimal 3MB</small>
                            <!--end form-group-->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- END EDIT MENU MODAL -->
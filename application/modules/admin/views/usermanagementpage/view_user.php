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

                    <h4 class="mt-0 header-title">User Management</h4>
                    <p class="text-muted m-b-30 font-14">
                        Liat tutorial <a href="#">disini</a>.
                    </p>

                    <?php echo form_error('user', '<div class="alert alert-danger text-center" role="alert">', '</div>'); ?>

                    <?php echo $this->session->flashdata('message'); ?>

                    <a href="#" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal" data-target="#newTambahData">Tambah User</a>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr class="text-center">

                                    <th>E-mail</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($peserta as $pst) : ?>
                                    <tr class="text-center">

                                        <td><?php echo $pst['email']; ?></td>
                                        <td><?php echo $pst['name']; ?></td>
                                        <td><?php echo $pst['role']; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($pst['date_created'])); ?>
                                            <span class="text-danger"><?php echo date('H:i', strtotime($pst['date_created'])); ?></span>
                                        <td>

                                            <a href="#"><span class="badge badge-success waves-effect waves-light" data-toggle="modal" data-target="#editModal<?php echo $pst['id']; ?>">Edit</span></a>

                                            <a class="btn-hapus" href="<?php echo base_url('admin/deletepeserta/') . $pst['id']; ?>"><span class="badge badge-danger waves-effect waves-light ml-3">Delete</span></a>
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

<!-- START TAMBAH MODAL -->
<div class="modal fade" id="newTambahData" tabindex="-1" aria-labelledby="newTambahDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTambahDataLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo base_url(); ?>admin/adduser" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Akun</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Akun" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" placeholder="Gender" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="phone">No HP</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="No HP" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select name="role_id" id="role_id" class="form-control selectpicker" data-live-search="true" required>
                            <option value="">Select Role</option>
                            <?php foreach ($role as $rl) : ?>
                                <option value="<?php echo $rl['id']; ?>"><?php echo $rl['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_active">Aktif Akun</label>
                        <select name="is_active" id="is_active" class="form-control selectpicker" data-live-search="true" required>
                            <option value="">Select Active</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
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
<!-- END TAMBAH MODAL -->

<!-- START EDIT MODAL -->
<?php
foreach ($peserta as $pst) :  ?>
    <div class="modal fade" id="editModal<?php echo $pst['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Peserta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url(); ?>admin/editpeserta" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_peserta" value="<?php echo $pst['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" autocomplete="off" value="<?php echo $pst['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" autocomplete="off" value="<?php echo $pst['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <select name="role_id" id="role_id" class="form-control selectpicker" data-live-search="true" required>
                                <option value="">Select Role</option>
                                <?php foreach ($role as $rl) : ?>
                                    <option value="<?php echo $rl['id']; ?>"><?php echo $rl['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
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
<!-- END EDIT MODAL -->
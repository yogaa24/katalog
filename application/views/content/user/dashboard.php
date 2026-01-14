<?php $this->load->view('partial/katalog/navbar') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php $this->load->view('content/user/modalAddUser')?>
    <!-- Main content -->
    <div class="content m-2">
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahUser"><i class="fas fa-plus"></i>&nbsp;Tambah User</button>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>KODE USER</th>
                                    <th>Nama Pengguna</th>
                                    <th>Username</th>
                                    <th>Hak Akses</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($user as $u) : ?>
                                    <tr>
                                        <td><?= $u->id_user ?></td>
                                        <td><?= $u->nama_user ?></td>
                                        <td><?= $u->username ?></td>
                                        <td><?= $u->hak_akses ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>KODE USER</th>
                                    <th>Nama Pengguna</th>
                                    <th>Username</th>
                                    <th>Hak Akses</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="https://kiu.co.id">PT.KARISMA INDOARGO UNIVERSAL</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->
<style>
    .img-promo {
        width: 400px;
        height: 600px;
        margin: 5px;
    }

    .content-img {
        margin-bottom: 5px;
        text-align: center;
    }

    .dt-body-center {
        text-align: center;
    }

    .promo-wrapper {
        text-align: center;
    }

    .promo-image {
        max-width: 100%;
        height: auto;
        cursor: pointer;
        border-radius: 6px;
    }

    /* Style untuk tabel pricelist */
    .table-pricelist {
        margin: 30px auto;
        max-width: 900px;
    }

    .table-pricelist th {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }

    .table-pricelist td {
        text-align: center;
        vertical-align: middle;
    }

    .table-pricelist tbody tr:hover {
        background-color: #f5f5f5;
    }
</style>
<?php $this->load->view('partial/katalog/navbar') ?>
<?php $this->load->view('content/pricelist/modalAddImage') ?>
<?php $this->load->view('content/pricelist/editModalSpecial') ?>

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
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content">


            <?php $kodeID = $this->input->get('id'); ?>
            <?php $kodeKD = $this->input->get('kd'); ?>

            <h1 class="text-center">Pricelist - <?php echo $title['kode_barang'] ?></h1>
            <h4 class="text-center" style="margin-top:-5px; font-weight: bold;"><?php echo $title['nama_barang']; ?></h4>
            <h5 class="text-center" style="margin-top:1px; margin-bottom:30px; font-weight: -100;"><?php echo $title['nama_suplier']; ?></h5>
            <center>
                <div class="row justify-content-center mb-3">
                    <div class="col-auto">
                        <a href="#" data-toggle="modal" data-target="#modalGambarProduk" class="text-center btn btn-primary" style="margin-top:-5px; font-weight: bold;">
                            Gambar Produk
                        </a>
                    </div>
                    <?php if ($this->session->userdata('hak_akses') == '1') { ?>
                        <div class="col-auto">
                            <a href="#" data-toggle="modal" data-target="#modalUploadGambar" class="text-center btn btn-success" style="margin-top:-5px; font-weight: bold;">
                                Ganti Gambar Produk
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </center>
            <hr style="margin-left:50px; margin-right:50px; margin-bottom: 30px; border: 0; border-top: 1px solid rgba(0, 0, 0, 0.2);" />

            <!-- GAMBAR PROMO -->
            <div class="row justify-content-center">

                <?php
                $promos = [
                    ['label' => 'PROMO 1', 'key' => 'gbr_promo1', 'modal' => 'edit1'],
                    ['label' => 'PROMO 2', 'key' => 'gbr_promo2', 'modal' => 'edit2'],
                    ['label' => 'PROMO 3', 'key' => 'gbr_promo3', 'modal' => 'edit3']
                ];

                foreach ($promos as $promo) :
                    $img = $title[$promo['key']];
                    $path = FCPATH . 'images/kontrak/' . $img;
                    $hasImage = ($img && $img !== '-' && file_exists($path));
                ?>

                    <div class="col-md-3 promo-wrapper mb-4">

                        <!-- TITLE + BUTTON -->
                        <div class="d-flex justify-content-center align-items-center mb-2">

                            <?php if ($hasImage) : ?>
                                <h4 class="mr-3"><?= $promo['label'] ?></h4>
                            <?php endif; ?>

                            <?php if ($this->session->userdata('hak_akses') == '1') : ?>
                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#<?= $promo['modal'] . $kodeID ?>">
                                    <i class="fa fa-pencil-alt"></i> Edit
                                </a>
                            <?php endif; ?>

                        </div>

                        <!-- IMAGE OR EMPTY STATE -->
                        <?php if ($hasImage) : ?>

                            <a href="<?= base_url('images/kontrak/' . $img) ?>" target="_blank">
                                <img src="<?= base_url('images/kontrak/' . $img) ?>" class="promo-image" alt="Promo Image">
                            </a>

                        <?php else : ?>

                            <div class="alert alert-secondary py-4">
                                <strong>Belum ada kontrak jual</strong>
                            </div>

                        <?php endif; ?>

                    </div>

                <?php endforeach; ?>

            </div>
            <!-- END GAMBAR PROMO -->

            <!-- TABEL PRICELIST -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h3 class="text-center mb-4" style="font-weight: bold;">Daftar Harga</h3>
                        
                        <?php if ($this->session->userdata('hak_akses') == '1' || $this->session->userdata('hak_akses') == '3') { ?>
                            <div class="text-center mb-3">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambahPricelist">
                                    <i class="fa fa-plus"></i> Tambah Pricelist
                                </button>
                            </div>
                        <?php } ?>

                        <div class="table-responsive table-pricelist">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Satuan Barang</th>
                                        <th>R1</th>
                                        <th>R2</th>
                                        <th>Umum</th>
                                        <?php if ($this->session->userdata('hak_akses') == '1' || $this->session->userdata('hak_akses') == '3') { ?>
                                            <th>Aksi</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pricelist_data)) : ?>
                                        <?php foreach ($pricelist_data as $item) : ?>
                                            <tr>
                                                <td><?php echo $item['satuan']; ?></td>
                                                <td><?php echo $item['r1'] ? 'Rp ' . number_format($item['r1'], 0, ',', '.') : '-'; ?></td>
                                                <td><?php echo $item['r2'] ? 'Rp ' . number_format($item['r2'], 0, ',', '.') : '-'; ?></td>
                                                <td><?php echo $item['umum'] ? 'Rp ' . number_format($item['umum'], 0, ',', '.') : '-'; ?></td>
                                                <?php if ($this->session->userdata('hak_akses') == '1' || $this->session->userdata('hak_akses') == '3') { ?>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditPricelist<?php echo $item['id']; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <a href="<?php echo base_url('pricelist/delete/' . $item['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="<?php echo ($this->session->userdata('hak_akses') == '1' || $this->session->userdata('hak_akses') == '3') ? '5' : '4'; ?>" class="text-center">
                                                <div class="alert alert-info mb-0">
                                                    Belum ada data pricelist
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TABEL PRICELIST -->

            <div class="card" hidden>
                <div class="card-body m-2">
                    <?php foreach ($prices as $pl) : ?>
                        <?php foreach ($hargas as $p) : ?>
                            <?php if ($pl->qty_1 > '0' || $pl->qty_2 > '0' || $pl->qty_3 > '0' || $pl->qty_4 > '0') : ?>
                                <div class="col-md">
                                    <?php if ($this->session->userdata('hak_akses') == '1' || $this->session->userdata('hak_akses') == '3') { ?>
                                        <button type="button" data-toggle="modal" data-whatever="<?php echo $title['nama_barang']; ?>" data-target="#modalAddQty" class="btn btn-block mb-2" style=" font-weight:bold;  background-color:#bce3c2">Tambah Pricelist</button>
                                    <?php } ?>
                                    <?php $this->load->view("content/pricelist/modalAddPricelist"); ?>
                                    <?php $this->load->view("content/pricelist/isiTablePrice"); ?>
                                <?php elseif ($p->total_item == 0 && $pl->qty_1 < 1) : ?>
                                    <?php if ($this->session->userdata('hak_akses') == '1' || $this->session->userdata('hak_akses') == '3') { ?>
                                        <button type="button" data-toggle="modal" data-whatever="<?php echo $title['nama_barang']; ?>" data-target="#modalAddQty" class="btn btn-block mb-2" style=" font-weight:bold;  background-color:#bce3c2">Tambah Pricelist</button>
                                    <?php } ?>
                                    <?php $this->load->view("content/pricelist/modalAddPricelist"); ?>
                                <?php endif; ?>
                                </div>
                                <?php if ($p->harga_r1 > '0' || $p->harga_r2 > '0' || $p->harga_program > '0' || $p->harga_online > '0') : ?>
                                    <div class="col-md">
                                        <?php if ($this->session->userdata('hak_akses') == '1' || $this->session->userdata('hak_akses') == '3') { ?>
                                            <button type="button" data-toggle="modal" data-whatever="super**<?php echo $title['nama_barang']; ?>" data-target="#addModalprice" class="btn btn-block mb-2" style="font-weight:bold; background-color:#8db3f0">Tambah Harga Ecer NET</button>
                                        <?php } ?>
                                        <?php $this->load->view("content/pricelist/modalAddSpecial"); ?>
                                        <?php $this->load->view("content/pricelist/isiCardPrice"); ?>
                                    </div>
                                <?php elseif ($pl->total_item == '0' && $p->harga_r1 < 1) : ?>
                                    <?php if ($this->session->userdata('hak_akses') == '1' || $this->session->userdata('hak_akses') == '3') { ?>
                                        <button type="button" data-toggle="modal" data-whatever="super**<?php echo $title['nama_barang']; ?>" data-target="#addModalprice" class="btn btn-block mb-2" style="font-weight:bold; background-color:#8db3f0">Tambah Harga Ecer NET</button>
                                    <?php } ?>
                                    <?php $this->load->view("content/pricelist/modalAddSpecial"); ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                </div>
            </div>

            <!-- MODAL TAMBAH PRICELIST -->
            <div class="modal fade" id="modalTambahPricelist" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Pricelist</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo base_url('pricelist/add'); ?>" method="post">
                            <div class="modal-body">
                                <!-- Gunakan kode_barang, bukan id_barang -->
                                <input type="hidden" name="id_barang" value="<?php echo $title['kode_barang']; ?>">
                                
                                <div class="form-group">
                                    <label>Satuan Barang</label>
                                    <input type="text" class="form-control" name="satuan" placeholder="Contoh: 1 pcs, 1-25 box" required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Harga R1</label>
                                    <input type="number" class="form-control" name="r1" placeholder="Masukkan harga R1">
                                </div>
                                
                                <div class="form-group">
                                    <label>Harga R2</label>
                                    <input type="number" class="form-control" name="r2" placeholder="Masukkan harga R2">
                                </div>
                                
                                <div class="form-group">
                                    <label>Harga Umum</label>
                                    <input type="number" class="form-control" name="umum" placeholder="Masukkan harga umum">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL EDIT PRICELIST -->
            <?php if (!empty($pricelist_data)) : ?>
                <?php foreach ($pricelist_data as $item) : ?>
                    <div class="modal fade" id="modalEditPricelist<?php echo $item['id']; ?>" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Pricelist</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo base_url('pricelist/edit'); ?>" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_pricelist" value="<?php echo $item['id']; ?>">
                                        <input type="hidden" name="id_barang" value="<?php echo $title['id_barang']; ?>">
                                        
                                        <div class="form-group">
                                            <label>Satuan Barang</label>
                                            <input type="text" class="form-control" name="satuan" value="<?php echo $item['satuan']; ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Harga R1</label>
                                            <input type="number" class="form-control" name="r1" value="<?php echo $item['r1']; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Harga R2</label>
                                            <input type="number" class="form-control" name="r2" value="<?php echo $item['r2']; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Harga Umum</label>
                                            <input type="number" class="form-control" name="umum" value="<?php echo $item['umum']; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- MODAL EDIT GAMBAR PRODUK -->
            <!-- MODAL GANTI GAMBAR PRODUK -->
            <div class="modal fade" id="modalUploadGambar" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Ganti Gambar Produk</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <?php echo form_open_multipart('pricelist/gambarproduk_br'); ?>

                            <input type="hidden" name="id_bar" value="<?php echo $title['id_barang']; ?>">
                            <input type="hidden" name="kode_barang_isi" value="<?php echo $title['kode_barang']; ?>">
                            <input type="hidden" name="nama_barang_isi" value="<?php echo $title['nama_barang']; ?>">

                            <!-- Upload -->
                            <label>Upload Gambar Produk Baru</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="gambar_1" name="gambar_1" accept="image/*" required>
                                <label class="custom-file-label" for="gambar_1">Pilih Gambar</label>
                            </div>

                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>

                        </form>

                    </div>
                </div>
            </div>



            <!-- MODAL GAMBAR PRODUK -->
            <div class="modal fade" id="modalGambarProduk" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Gambar Produk</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="modal-body text-center">
                            <img src="<?php echo base_url('images/produk/' . $title['gbr_produk']); ?>" alt="Gambar Produk" class="img-fluid rounded shadow">
                        </div>

                    </div>
                </div>
            </div>


        </div>
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
<style>
    /* Wrapper biar tabel tidak meledak */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 6px;
    }

    /* Tabel lebih stabil */
    .table-responsive table {
        table-layout: auto;
        width: 100%;
    }

    /* Header bersih di mobile */
    thead th {
        background-color: #6096B4;
        color: white;
        padding: 8px;
        font-size: 13px;
        white-space: nowrap;
    }

    /* Row style */
    .table-striped>tbody>tr:nth-child(2n+1)>td {
        background-color: #FFFBF5;
    }

    /* Isi tabel */
    td,
    th {
        text-align: center;
        vertical-align: middle;
        font-size: 13px;
        padding: 8px 6px;
    }

    /* Gambar produk fix */
    td img {
        max-width: 60px;
        height: auto;
        border-radius: 4px;
    }

    /* Tombol aksi friendly mobile */
    .table .btn {
        padding: 6px 8px;
        font-size: 12px;
        border-radius: 6px;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Mobile optimization */
    @media (max-width: 768px) {

        thead th {
            font-size: 11px;
            padding: 6px;
            white-space: normal;
            line-height: 1.2;
        }

        td,
        th {
            padding: 7px 4px;
            font-size: 12px;
        }

        td img {
            max-width: 45px;
        }

        .table .btn {
            padding: 4px 6px;
            font-size: 11px;
        }

        /* Biar tabel tidak terlalu panjang */
        th:nth-child(2),
        th:nth-child(3),
        th:nth-child(4),
        th:nth-child(5),
        th:nth-child(6) {
            white-space: normal;
        }
    }
</style>
<?php $this->load->view('partial/katalog/navbar') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color:#F5F5F5;">

    <div class="content-header">
        <div class="container"></div>
    </div>

    <div class="content px-2" style="margin-top:-10px;">
        <div class="row">
            <div class="col-lg">
                <div class="card shadow-sm" style="border-radius:10px;">
                    <div class="card-body" style="background-color:white; border-radius:10px;">

                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped mt-2">
                                <thead>
                                    <tr>
                                        <th hidden>Kode Barang</th>
                                        <th>Produk Fokus</th>
                                        <th>Nama Barang</th>
                                        <th>Nama Suplier</th>
                                        <th>Kelompok Bahan</th>
                                        <th>Bahan Aktif</th>
                                        <th>Gambar Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="dt-body-center">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
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
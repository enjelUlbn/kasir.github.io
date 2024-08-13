<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php" ; 
require "../config/functions.php";
require "../module/mode-barang.php";

$title="Form Barang - KEI KASIR" ; 
require "../template/header.php" ;
require "../template/navbar.php" ; 
require "../template/sidebar.php" ; 

if (isset($_POST['simpan'])) {
    if (insert($_POST)){
        echo '<script>
        alert("barang baru berhasil ditambahkan ! ");
    </script>';
    }
}
    ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>barang/index.php">Barang</a></li>
                        <li class="breadcrumb-item active">Add Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus fa-sm"></i> Tambah Barang</h3>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i
                                class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i>
                            Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mb-3 pr-3">
                                <div class="form-group">
                                    <label for="kode">Kode Barang</label>
                                    <input type="text" name="kode" class="form-control" id="kode"
                                        value="<?= generateId() ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" name="barcode" class="form-control" id="barcode"
                                        placeholder="barcode" autocomplete="off" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="nama barang" autocomplete="off" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <select name="satuan" id="satuan" class="form-control" required>
                                        <option value="">-- Satuan Barang --</option>
                                        <option value="piece">Piece</option>
                                        <option value="botol">Botol</option>
                                        <option value="kaleng">kaleng</option>
                                        <option value="pouch">Pouch</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli</label>
                                    <input type="number" name="harga_beli" class="form-control" id="harga_beli"
                                        placeholder="Rp 0" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual</label>
                                    <input type="number" name="harga_jual" class="form-control" id="harga_jual"
                                        placeholder="Rp 0" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="stock_minimal">Stock Minimal</label>
                                    <input type="number" name="stock_minimal" class="form-control" id="stock_minimal"
                                        placeholder="0" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center px-3">
                                <img src="<?= $main_url ?>asset/image/barang.png" class="profile-user-img mb-3 mt-4"
                                    alt="">
                                <input type="file" class="form-control" name="image">
                                <span class="text-sm">Type file gambar JPG | PNG | GIF</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>


    <?php  

require "../template/footer.php";


?>
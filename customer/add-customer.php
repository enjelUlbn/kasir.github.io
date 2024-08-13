<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}


require "../config/config.php" ; 
require "../config/functions.php";
require "../module/mode-customer.php";

$title="Tambah Customer - KEI KASIR" ; 
require "../template/header.php" ;
require "../template/navbar.php" ; 
require "../template/sidebar.php" ; 

if (isset($_POST['simpan'])) {
    if (insert($_POST) > 0){
        echo '<script>
        alert("Customer berhasil ditambahkan ");
    </script>';
    }
}
    
    ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>customer/data-customer.php">Customer</a>
                        </li>
                        <li class="breadcrumb-item active">Add Customer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container">
            <div class="card">
                <form action="" method="post">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-plus fa-sm"></i> Add Customer</h3>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i
                                class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i>
                            Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mb-3">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama"
                                        placeholder="Masukan nama customer" autofocus autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="telpon">Telpon</label>
                                    <input type="text" name="telpon" class="form-control" id="telpon"
                                        placeholder="Masukan no telpon customer" pattern="[0-9]{5,}"
                                        title="minimal 5 angka" required>
                                </div>
                                <div class="form-group">
                                    <label for="ketr">Deskripsi</label>
                                    <textarea name="ketr" id="ketr" cols="" rows="1" class="form-control"
                                        placeholder="Keterangan customer" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="" rows="3" class="form-control"
                                        placeholder="Masukan alamat customer" required></textarea>
                                </div>
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
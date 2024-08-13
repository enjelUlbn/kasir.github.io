<?php 

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}


require "../config/config.php" ; 
require "../config/functions.php";
require "../module/mode-customer.php";

$title="Data Customer - KEI KASIR" ; 
require "../template/header.php" ;
require "../template/navbar.php" ; 
require "../template/sidebar.php" ; 

    ?>

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
                        <li class="breadcrumb-item active">Data Customer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i> Data Customer</h3>
                    <div class="card-tools">
                        <a href="<?= $main_url ?>customer/add-customer.php" class="btn btn-sm btn-primary"><i
                                class="fas fa-plus fa-sm"></i> Add Customer</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Telpon</th>
                                <th>Deskripsi</th>
                                <th>Alamat</th>
                                <th style="width: 10%;">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $customers = getData("SELECT * FROM tbl_customer");
                            foreach($customers as $customer) : ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $customer['nama'] ?></td>
                                <td><?= $customer['telpon'] ?></td>
                                <td><?= $customer['alamat'] ?></td>
                                <td><?= $customer['deskripsi'] ?></td>
                                <td>
                                    <a href="edit-customer.php?id=<?= $customer['id_customer'] ?>"
                                        class="btn btn-sm btn-warning" title="edit customer"><i
                                            class="fas fa-pen"></i></a>
                                    <a href="del-customer.php?id=<?= $customer['id_customer'] ?>"
                                        class="btn btn-sm btn-danger" title="hapus customer"
                                        onclick="return confirm ('Anda yakin akan menghapus customer ini ?')"><i
                                            class="fas fa-trash"></i></a>
                                </td>

                            </tr>
                            <?php endforeach ; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

    <?php

require "../template/footer.php";

?>
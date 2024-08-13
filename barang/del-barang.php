<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}


require "../config/config.php";
require "../config/functions.php";
require "../module/mode-barang.php";


$id    = $_GET['id'];
$gbr   = $_GET['gbr'];
if (delete($id, $gbr)) {
    echo 
        "<script>
            alert('Barang berhasil dihapus..'); 
            document.location.href = 'index.php';
        </script> ";
} else {
    echo 
        "<script>
            alert('Barang gagal dihapus..'); 
            document.location.href = 'index.php';
        </script> ";
}

?>
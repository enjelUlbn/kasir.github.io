<?php

function generateNo(){
    global $koneksi;

    $noUrut = 1;
    $maxno = '';

    do {
        $maxno = 'PB-' . sprintf("%04s", $noUrut);
        $queryNo = mysqli_query($koneksi, "SELECT no_beli FROM tbl_beli_head WHERE no_beli = '$maxno'");
        $data = mysqli_fetch_assoc($queryNo);
        if (!$data) {
            break; // Keluar dari loop jika nomor belum ada
        }
        $noUrut++;
    } while (true);

    return $maxno;
}


function totalBeli($noBeli){
    global $koneksi; 
    $totalBeli = mysqli_query($koneksi, "SELECT sum(jml_harga) AS total FROM tbl_beli_detail WHERE no_beli = '$noBeli'");

    $data = mysqli_fetch_assoc($totalBeli);
    $total = $data["total"];

    return $total;
    
}

function insert($data){
    global $koneksi;

    $no = mysqli_real_escape_string($koneksi, $data['noNota']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $kode = mysqli_real_escape_string($koneksi, $data['kodeBrg']);
    $nama = mysqli_real_escape_string($koneksi, $data['namaBrg']);
    $qty = mysqli_real_escape_string($koneksi, $data['qty']);
    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $jmlharga = mysqli_real_escape_string($koneksi, $data['jmlHarga']);

    $cekbrg = mysqli_query($koneksi, "SELECT * FROM tbl_beli_detail WHERE no_beli = '$no' AND kode_brg ='$kode'");
    if (mysqli_num_rows($cekbrg)) {
        echo "<script>
                alert('barang sudah ada, anda harus menghapusnya dulu jika ingin mengubah qty-nya..');
        </script>";
        return false;
    }
    if (empty($qty)) {
    echo "<script>
                alert('Qty barang tidak boleh kosong');
        </script>";
        return false;
} else {
    $sqlbeli = "INSERT INTO tbl_beli_detail VALUES (null, '$no', '$tgl', '$kode', '$nama', $qty, $harga, $jmlharga)";
    mysqli_query($koneksi, $sqlbeli);
}

mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock + $qty WHERE id_barang = '$kode'");

return mysqli_affected_rows($koneksi);
}

function delete($idbrg, $idbeli, $qty){
    global $koneksi;
    $sqlDel = "DELETE FROM tbl_beli_detail WHERE kode_brg = '$idbrg' AND no_beli = '$idbeli'";

    mysqli_query($koneksi, $sqlDel);

    
mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock - $qty WHERE id_barang = '$idbrg'");

return mysqli_affected_rows($koneksi);
}

function simpan($data){
    global $koneksi;

    $noBeli = mysqli_real_escape_string($koneksi, $data['noNota']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglNota']);
    $total = mysqli_real_escape_string($koneksi, $data['total']);
    $suplier = mysqli_real_escape_string($koneksi, $data['suplier']); // Ganti $supplier menjadi $suplier
    $keterangan = mysqli_real_escape_string($koneksi, $data['ketr']);

    $sqlbeli = "INSERT INTO tbl_beli_head (no_beli, tgl_beli, total, suplier, keterangan) 
                VALUES ('$noBeli', '$tgl', '$total', '$suplier', '$keterangan')";

    if (mysqli_query($koneksi, $sqlbeli)) {
        return true;
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $sqlbeli . "<br>" . mysqli_error($koneksi);
        return false;
    }
}

?>
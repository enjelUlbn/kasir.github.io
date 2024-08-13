<?php

function generateNo(){
    global $koneksi;

    $noUrut = 1;
    $maxno = '';

    do {
        $maxno = 'PJ-' . sprintf("%04s", $noUrut);
        $queryNo = mysqli_query($koneksi, "SELECT no_jual FROM tbl_jual_head WHERE no_jual = '$maxno'");
        $data = mysqli_fetch_assoc($queryNo);
        if (!$data) {
            break; // Keluar dari loop jika nomor belum ada
        }
        $noUrut++;
    } while (true);

    return $maxno;
}

function totalJual($noJual){
    global $koneksi; 
    $totalJual = mysqli_query($koneksi, "SELECT sum(jml_harga) AS total FROM tbl_jual_detail WHERE no_jual = '$noJual'");

    $data = mysqli_fetch_assoc($totalJual);
    $total = $data["total"];

    return $total;
    
}

function insert($data){
    global $koneksi;

    $no = mysqli_real_escape_string($koneksi, $data['noJual']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglJual']);
    $kode = mysqli_real_escape_string($koneksi, $data['barcode']);
    $nama = mysqli_real_escape_string($koneksi, $data['namaBrg']);
    $qty = mysqli_real_escape_string($koneksi, $data['qty']);
    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $jmlharga = mysqli_real_escape_string($koneksi, $data['jmlHarga']);
    $stok = mysqli_real_escape_string($koneksi, $data['stok']);

    //cek barang sudah diinput atau belum
    $cekbrg = mysqli_query($koneksi, "SELECT * FROM tbl_jual_detail WHERE no_jual = '$no' AND barcode='$kode'");
    if (mysqli_num_rows($cekbrg)) {
        echo "<script>
                alert('barang sudah ada, anda harus menghapusnya dulu jika ingin mengubah qty-nya..');
        </script>";
        return false;
    }

    //qty tidak boleh kosong
    if (empty($qty)) {
    echo "<script>
                alert('Qty barang tidak boleh kosong');
        </script>";
        return false;
    }else if ($qty > $stok){
        echo "<script>
        alert('stok barang tidak mencukupi');
</script>";

} else {
    $sqlJual = "INSERT INTO tbl_jual_detail VALUES (null, '$no', '$tgl', '$kode', '$nama', $qty, $harga, $jmlharga)";
    mysqli_query($koneksi, $sqlJual);
}

mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock - $qty WHERE barcode = '$kode'");

return mysqli_affected_rows($koneksi);
}

function delete($barcode, $idjual, $qty){
    global $koneksi;
    $sqlDel = "DELETE FROM tbl_jual_detail WHERE barcode = '$barcode' AND no_jual = '$idjual'";

    mysqli_query($koneksi, $sqlDel);

    
mysqli_query($koneksi, "UPDATE tbl_barang SET stock = stock + $qty WHERE barcode = '$barcode'");

return mysqli_affected_rows($koneksi);
}

function simpan($data){
    global $koneksi;

    $noJual = mysqli_real_escape_string($koneksi, $data['noJual']);
    $tgl = mysqli_real_escape_string($koneksi, $data['tglJual']);
    $total = mysqli_real_escape_string($koneksi, $data['total']);
    $customer = mysqli_real_escape_string($koneksi, $data['customer']); 
    $keterangan = mysqli_real_escape_string($koneksi, $data['ketr']);
    $bayar = mysqli_real_escape_string($koneksi, $data['bayar']);
    $kembalian = mysqli_real_escape_string($koneksi, $data['kembalian']);

    $sqljual = "INSERT INTO tbl_jual_head (no_jual, tgl_jual, total, customer, keterangan, jml_bayar, kembalian) 
                VALUES ('$noJual', '$tgl', '$total', '$customer', '$keterangan', $bayar, $kembalian)";

    if (mysqli_query($koneksi, $sqljual)) {
        return true;
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $sqljual . "<br>" . mysqli_error($koneksi);
        return false;
    }
}


?>
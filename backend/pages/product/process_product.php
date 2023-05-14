<?php
require_once '../../../config/connection.php';

$_code = $_POST['code'];
$_name = $_POST['name'];
$_image = $_POST['image'];
$_selling_price = $_POST['selling_price'];
$_purchase_price = $_POST['purchase_price'];
$_stock = $_POST['stock'];
$_minStock = $_POST['min_stock'];
$_categoryProductId = $_POST['category_product_id'];
$_description = $_POST['description'];

$_process = $_POST['process'];

// array data
$ar_data[] = $_code;
$ar_data[] = $_name;
$ar_data[] = $_image;
$ar_data[] = $_selling_price;
$ar_data[] = $_purchase_price;
$ar_data[] = $_stock;
$ar_data[] = $_minStock;
$ar_data[] = $_description;
$ar_data[] = $_categoryProductId;

if ($_process == "Simpan") {
    // data baru
    $sql = "INSERT INTO produk (kode, nama, image, harga_jual, harga_beli, stok, min_stok, deskripsi, kategori_produk_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
} else if ($_process == "Update") {
    $ar_data[] = $_POST['idedit'];
    $sql = "UPDATE produk SET kode=?, nama=?, image=?, harga_jual=?, harga_beli=?, stok=?, min_stok=?, deskripsi=?, kategori_produk_id=? WHERE id=?";
}

if (isset($sql)) {
    $st = $conn->prepare($sql);
    $st->execute($ar_data);
}

header('location:list_product.php');

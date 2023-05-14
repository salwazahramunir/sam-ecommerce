<?php
require_once '../../../config/connection.php';

$_name = $_POST['name'];

$_process = $_POST['process'];

// array data
$ar_data[] = $_name;

// function uploadFile()
// {
//     $_fileName = $_FILES['category_file']['name'];
//     $_fileSize = $_FILES['category_file']['size'];

//     // Mengecek apakah file lebih besar 2 MB atau tidak
//     if ($_fileSize > 2097152) {
//         // Jika File lebih dari 2 MB maka akan gagal mengupload File
//         header("location:form_category.php?pesan=size");
//     } else {
//     }
// }

if ($_process == "Simpan") {
    // data baru
    $sql = "INSERT INTO kategori_produk (nama) VALUES (?)";
} else if ($_process == "Update") {
    $ar_data[] = $_POST['idedit'];
    $sql = "UPDATE kategori_produk SET nama=? WHERE id=?";
}

if (isset($sql)) {
    $st = $conn->prepare($sql);
    $st->execute($ar_data);
}

header('location:list_category.php');

<?php
require_once '../../../config/connection.php';

$delete = $_GET['iddel'];
$sql = "DELETE FROM kategori_produk WHERE id=?";
$st = $conn->prepare($sql);
$st->execute([$delete]);

header('location:list_category.php');

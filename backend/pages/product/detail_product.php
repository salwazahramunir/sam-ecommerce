<?php
include_once('../top.php');
include_once('../navbar.php');
include_once('../sidebar.php');
?>

<?php
require_once '../../../config/connection.php';

$detail = $_GET['iddetail'];
//untuk menampilkan data dengan perintah select
$sql = "SELECT * FROM produk WHERE id=?";
$st = $conn->prepare($sql);
//intruksi untuk menjalankan program 
$st->execute([$detail]);
//untuk menampilkan baris di setiap data 
$row = $st->fetch();

$sqlCat = "SELECT nama FROM kategori_produk WHERE id=?";
$stCat = $conn->prepare($sqlCat);
$stCat->execute([$row["kategori_produk_id"]]);
$category = $stCat->fetch();
?>

<!-- ======= Main ======= -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/ecommerce/backend/pages/index.php">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Product Detail</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row my-4">
            <div class="col-lg-12">
                <div class="card p-2">
                    <div class="card-body">
                        <h5 class="card-title">Product Detail</h5>
                        <hr>

                        <table class="table" width="100%">
                            <tr>
                                <th width="20%">Code</th>
                                <td>:</td>
                                <td><?= $row['kode'] ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>:</td>
                                <td><?= $row['nama'] ?></td>
                            </tr>
                            <tr>
                                <th>Selling Price</th>
                                <td>:</td>
                                <td><?= $row['harga_jual'] ?></td>
                            </tr>
                            <tr>
                                <th>Purchase Price</th>
                                <td>:</td>
                                <td><?= $row['harga_beli'] ?></td>
                            </tr>
                            <tr>
                                <th>Stock</th>
                                <td>:</td>
                                <td><?= $row['stok'] ?></td>
                            </tr>
                            <tr>
                                <th>Min Stock</th>
                                <td>:</td>
                                <td><?= $row['min_stok'] ?></td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>:</td>
                                <td><?= $category['nama'] ?></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>:</td>
                                <td><?= $row['deskripsi'] ?></td>
                            </tr>
                        </table>

                        <a href="list_product.php" class="btn btn-outline-primary btn-sm">Back</a>

                    </div>
                </div>

            </div>
        </div>
    </section>


</main>
<!-- End #main -->

<?php
include_once('../footer.php');
include_once('../bottom.php');
?>
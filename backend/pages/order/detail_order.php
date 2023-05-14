<?php
include_once('../top.php');
include_once('../navbar.php');
include_once('../sidebar.php');
?>

<?php
require_once '../../../config/connection.php';

$detail = $_GET['iddetail'];
//untuk menampilkan data dengan perintah select
$sql = "SELECT ps.*, pr.harga_jual as productSelling, pr.image as productImage, pr.kode, pr.nama as productName, cp.nama as categoryName FROM pesanan ps INNER JOIN produk pr ON ps.produk_id = pr.id INNER JOIN kategori_produk cp ON cp.id = pr.kategori_produk_id WHERE ps.id=?";
// SELECT * FROM Table1 INNER JOIN Table2 ON Condition INNER JOIN Table3 ON Condition;
$st = $conn->prepare($sql);
//intruksi untuk menjalankan program 
$st->execute([$detail]);
//untuk menampilkan baris di setiap data 
$row = $st->fetch();

// $sqlCat = "SELECT nama FROM kategori_produk WHERE id=?";
// $stCat = $conn->prepare($sqlCat);
// $stCat->execute([$row["kategori_produk_id"]]);
// $category = $stCat->fetch();
?>

<!-- ======= Main ======= -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/ecommerce/backend/pages/index.php">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Order Detail</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row my-4">
            <div class="col-lg-12">
                <div class="card p-2">
                    <div class="card-body">
                        <h5 class="card-title">Order Detail</h5>
                        <hr>

                        <div class="table-responsive">
                            <table class="table" width="100%">
                                <tr>
                                    <th width="20%">Customer Name</th>
                                    <td>:</td>
                                    <td><?= $row['nama_pemesan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Purchase Date</th>
                                    <td>:</td>
                                    <td><?= $row['tanggal'] ?></td>
                                </tr>
                                <tr>
                                    <th>Home Address</th>
                                    <td>:</td>
                                    <td><?= $row['alamat_pemesan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>:</td>
                                    <td><?= $row['no_hp'] ?></td>
                                </tr>
                                <tr>
                                    <th>E-mail Address</th>
                                    <td>:</td>
                                    <td><?= $row['email'] ?></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>:</td>
                                    <td><?= $row['deskripsi'] ?></td>
                                </tr>
                            </table>
                        </div>

                        <h5 class="card-title">Product Detail</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <img src="<?= $row['productImage'] ?>" alt="<?= $row['productName'] ?>" width="100%">
                            </div>
                            <div class="col-md-9">
                                <div class="table-responsive">
                                    <table class="table" width="100%">
                                        <tr>
                                            <th width="20%">Code</th>
                                            <td>:</td>
                                            <td><?= $row['kode'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>:</td>
                                            <td><?= $row['productName'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td>:</td>
                                            <td><?= $row['categoryName'] ?></td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td>:</td>
                                            <td>Rp <?= number_format($row['productSelling'], 2, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Order Quantity</th>
                                            <td>:</td>
                                            <td><?= $row['jumlah_pesanan'] ?></td>
                                        </tr>
                                        <?php
                                        $subTotal = $row['productSelling'] * $row['jumlah_pesanan'];
                                        $tax = (5 / 100) * $subTotal;
                                        $totalPrice = $subTotal + $tax;
                                        ?>
                                        <tr>
                                            <th>Sub Total</th>
                                            <td>:</td>
                                            <td>Rp <?= number_format($subTotal, 2, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tax (5%)</th>
                                            <td>:</td>
                                            <td>Rp <?= number_format($tax, 2, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Price</th>
                                            <td>:</td>
                                            <td>Rp <?= number_format($totalPrice, 2, ',', '.') ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <a href="list_order.php" class="btn btn-outline-primary btn-sm mt-4">Back</a>
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
<?php
include_once('top.php');
include_once('navbar.php');
?>

<?php
require_once '../../config/connection.php';

$id = $_GET['iddetail'];
$sqlShowProduct = "SELECT p.*, pc.nama AS category FROM produk p INNER JOIN kategori_produk pc ON p.kategori_produk_id = pc.id WHERE p.id=?";
$rsShowProduct = $conn->prepare($sqlShowProduct);
$rsShowProduct->execute([$id]);
$row = $rsShowProduct->fetch();
?>


<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <img class="img-fluid w-100" src="<?= $row['image'] ?>" alt="<?= $row['nama'] ?>">

        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3 class="mt-4"><?= $row['nama'] ?></h3>
                <p><?= $row['category'] ?></p>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(99 Reviews)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">Rp. <?= number_format($row['harga_jual'], 2, ',', '.') ?></h3>
                <h6 class="my-3">Description</h6>
                <p class="mb-4">
                    <?= $row['deskripsi'] ?>
                </p>
                <div class="d-flex align-items-center mb-4 pt-2" style="position: absolute; bottom: 100px">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary border-0 text-center" value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <a href="cart.php?idproduct=<?= $row['id'] ?>" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->

<?php
include_once('footer.php');
include_once('bottom.php');
?>
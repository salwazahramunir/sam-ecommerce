<?php
include_once('top.php');
include_once('navbar.php');
?>

<?php
require_once '../../config/connection.php';
$idproduct = $_GET['idproduct'];

$sqlShowProduct = "SELECT * FROM produk WHERE id=?";
$rsShowProduct = $conn->prepare($sqlShowProduct);
$rsShowProduct->execute([$idproduct]);
$row = $rsShowProduct->fetch();
?>


<!-- Cart Start -->
<div class="container-fluid">
    <form method="POST" action="process_cart.php" autocomplete="off">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label>Customer Name <small>/ Nama Pemesan</small></label>
                            <input class="form-control" type="text" name="customer_name" autofocus>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Purchase Date <small>/ Tanggal Pembelian</small></label>
                            <input class="form-control" type="date" name="purchase_date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label>Phone Number <small>/ Nomor Telepon</small></label>
                            <input class="form-control" type="number" name="phone_number">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>E-mail Address <small>/ Alamat E-mail</small></label>
                            <input class="form-control" type="email" name="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label>Description <small>/ Deskripsi</small></label>
                            <textarea name="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Home Address <small>/ Alamat Rumah</small></label>
                            <textarea name="address" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;"> <?= $row['nama'] ?></td>
                            <input type="hidden" id="price" value="<?= $row['harga_jual'] ?>">
                            <td class="align-middle">Rp. <?= number_format($row['harga_jual'], 2, ',', '.') ?></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-minus" id="btnMinus" onclick="min()">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" id="numqty" name="order_quantity" class="form-control form-control-sm bg-secondary border-0 text-center">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-plus" onclick="plus()">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="totalPrice"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal"></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax <small style="margin-left: 5px"> (5%)</small></h6>
                            <h6 class="font-weight-medium" id="tax"></h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="total"></h5>
                        </div>
                        <input type="submit" name="process" type="submit" class="btn btn-block btn-primary font-weight-bold my-3 py-3" value="Checkout" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Cart End -->

<?php
include_once('footer.php');
?>
<script>
    document.getElementById('numqty').value = 1; // set value input numqty
    let qty = document.getElementById('numqty').value; // get value numqty
    let price = document.getElementById('price').value // get value price
    calculateTotalPrice()

    if (qty == 1) {
        document.getElementById('btnMinus').disabled = true
    }

    function plus() {
        qty++

        if (qty > 1) {
            document.getElementById('btnMinus').disabled = false
        }
        calculateTotalPrice()
    }

    function min() {
        if (qty == 2) {
            qty = 1
            document.getElementById('btnMinus').disabled = true
        } else {
            qty--
        }
        calculateTotalPrice()
    }

    function formatRupiah(money) {
        let rupiahFormat = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        }).format(money);

        return rupiahFormat
    }

    function calculateTotalPrice() {
        let totalPrice = price * qty
        let tax = Math.ceil((5 / 100) * totalPrice)
        document.getElementById('totalPrice').innerText = formatRupiah(totalPrice)
        document.getElementById('subTotal').innerText = formatRupiah(totalPrice)
        document.getElementById('tax').innerText = formatRupiah(tax)
        document.getElementById('total').innerText = formatRupiah(tax + totalPrice)
    }
</script>
<?php
include_once('bottom.php');
?>
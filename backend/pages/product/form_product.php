<?php
include_once('../top.php');
include_once('../navbar.php');
include_once('../sidebar.php');
?>


<?php
require_once '../../../config/connection.php';

//membuat kondisi untuk mengedit data category 
if (!empty($_GET['idedit'])) {
    $edit = $_GET['idedit'];
    //untuk menampilkan data dengan perintah select
    $sql = "SELECT * FROM produk WHERE id=?";
    $st = $conn->prepare($sql);
    //intruksi untuk menjalankan program 
    $st->execute([$edit]);
    //untuk menampilkan baris di setiap data 
    $row = $st->fetch();
} else {
    //untuk membuat data baru 
    $row = [];
};
?>

<!-- ======= Main ======= -->
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/ecommerce/backend/pages/index.php">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Product</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row my-4">
            <div class="col-lg-12">
                <div class="card p-2">
                    <div class="card-body">
                        <?php
                        //melakukan validasi form 
                        // $button = (empty($edit)) ? "Simpan" : "Update";
                        ?>
                        <h5 class="card-title">Create New Product</h5>
                        <hr>
                        <form action="process_product.php" method="POST" autocomplete="off">
                            <div class="row mb-3">
                                <label for="code" class="col-sm-3 col-form-label">Code <small>/ Kode</small></label>
                                <div class="col-sm-9">
                                    <input type="text" name="code" id="code" class="form-control" value="<?= (!empty($edit)) ? $row["kode"] : "" ?>" autofocus>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-3 col-form-label">Name <small>/ Nama</small></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" class="form-control" value="<?= (!empty($edit)) ? $row["nama"] : "" ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-sm-3 col-form-label">Image URL <small>/ URL Gambar</small></label>
                                <div class="col-sm-9">
                                    <input type="text" name="image" id="image" class="form-control" value="<?= (!empty($edit)) ? $row["image"] : "" ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="selling_price" class="col-sm-3 col-form-label">Selling Price <small>/ Harga Jual</small></label>
                                <div class="col-sm-9">
                                    <input type="number" name="selling_price" id="selling_price" class="form-control" value="<?= (!empty($edit)) ? $row["harga_jual"] : "" ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="purchase_price" class="col-sm-3 col-form-label">Purchase Price <small>/ Harga Beli</small></label>
                                <div class="col-sm-9">
                                    <input type="number" name="purchase_price" id="purchase_price" class="form-control" value="<?= (!empty($edit)) ? $row["harga_beli"] : "" ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="stock" class="col-sm-3 col-form-label">Stock <small>/ Stok</small></label>
                                <div class="col-sm-9">
                                    <input type="number" name="stock" id="stock" class="form-control" value="<?= (!empty($edit)) ? $row["stok"] : "" ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="min_stock" class="col-sm-3 col-form-label">Min Stock <small>/ Min Stok</small></label>
                                <div class="col-sm-9">
                                    <input type="number" name="min_stock" id="min_stock" class="form-control" value="<?= (!empty($edit)) ? $row["min_stok"] : "" ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <?php
                                $sqlCategory = "SELECT * FROM kategori_produk";
                                $rsCategory = $conn->query($sqlCategory);
                                ?>
                                <label for="category_product_id" class="col-sm-3 col-form-label">Category ID <small>/ ID Kategori</small></label>
                                <div class="col-sm-9">
                                    <select id="category_product_id" name="category_product_id" class="form-control">
                                        <option value="" disabled selected>--- Select One ---</option>
                                        <?php
                                        foreach ($rsCategory as $rowCategory) {
                                        ?>
                                            <option value="<?= $rowCategory['id'] ?>" <?= ($row ? ($rowCategory['id'] == $row['kategori_produk_id']) ? 'selected' : "" : "") ?>><?= $rowCategory['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-sm-3 col-form-label">Description <small>/ Deskripsi</small></label>
                                <div class="col-sm-9">
                                    <textarea name="description" id="description" cols="20" rows="5" class="form-control"><?= (!empty($edit)) ? $row["deskripsi"] : "" ?></textarea>
                                </div>
                            </div>
                            <div class="row mb-3 mt-4">
                                <div class="col-sm-12">
                                    <?php
                                    //melakukan validasi form 
                                    $button = (empty($edit)) ? "Simpan" : "Update";
                                    ?>
                                    <a href="list_product.php" class="btn btn-outline-primary btn-sm">Back</a>
                                    <input type="submit" name="process" type="submit" class="btn btn-primary btn-sm float-end" value="<?= $button ?>" />
                                    <input type="hidden" name="idedit" value="<?= $edit ?>">
                                </div>
                            </div>
                        </form>
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
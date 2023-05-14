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
    $sql = "SELECT * FROM kategori_produk WHERE id=?";
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
        <h1>Product Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/ecommerce/backend/pages/index.php">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Product Category</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row my-4">
            <div class="col-lg-12">
                <div class="card p-2">
                    <div class="card-body">
                        <h5 class="card-title">Create New Product Category</h5>
                        <hr>
                        <form action="process_category.php" method="POST" autocomplete="off">
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Name <small>/ Nama</small></label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="nama" class="form-control" value="<?= (!empty($edit)) ? $row["nama"] : "" ?>" autofocus>
                                </div>
                            </div>
                            <!-- <div class="row mb-3">
                                <label for="category_file" class="col-sm-2 col-form-label">Image <small>/ Gambar</small></label>
                                <div class="col-sm-10">
                                    <input type="file" name="category_file" id="category_file" class="form-control" value="<?= (!empty($edit)) ? $row["nama"] : "" ?>" autofocus>
                                </div>
                            </div> -->
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <?php
                                    //melakukan validasi form 
                                    $button = (empty($edit)) ? "Simpan" : "Update";
                                    ?>
                                    <input type="submit" name="process" type="submit" class="btn btn-primary btn-sm" value="<?= $button ?>" />
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
<?php
include_once('top.php');
include_once('navbar.php');
include_once('sidebar.php');
?>

<!-- ======= Main ======= -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Home</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product Category (4)</h5>
                        <p><a href="./category/list_category.php">See List<i class='bx bx-right-arrow-alt'></i></a></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product (10)</h5>
                        <p><a href="./product/list_product.php">See List<i class='bx bx-right-arrow-alt'></i></a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order (2)</h5>
                        <p><a href="./order/list_order.php">See List<i class='bx bx-right-arrow-alt'></i></a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->

<?php
include_once('footer.php');
include_once('bottom.php');
?>
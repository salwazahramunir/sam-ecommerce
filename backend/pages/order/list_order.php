<?php
include_once('../top.php');
include_once('../navbar.php');
include_once('../sidebar.php');
?>


<?php
require_once '../../../config/connection.php';

$sql = "SELECT * FROM pesanan ORDER BY id DESC";
$rs = $conn->query($sql);
?>

<!-- ======= Main ======= -->
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/ecommerce/backend/pages/index.php">Home</a></li>
                <li class="breadcrumb-item">Pages</li>
                <li class="breadcrumb-item active">Order</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row my-4">
            <div class="col-lg-12">
                <div class="card p-2">
                    <div class="card-body">
                        <h5 class="card-title">Order List</h5>
                        <hr>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Purchase Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor  = 1;
                                foreach ($rs as $row) {
                                ?>
                                    <tr>
                                        <td><?= $nomor ?></td>
                                        <td><?= $row['nama_pemesan'] ?></td>
                                        <td><?= $row['tanggal'] ?></td>
                                        <td>
                                            <a class="btn btn-outline-info btn-sm" href="detail_order.php?iddetail=<?= $row['id'] ?>"><i class='bx bx-show-alt'></i>Show</a>
                                            <a class="btn btn-outline-danger btn-sm" href="delete_order.php?iddel=<?= $row['id'] ?>" onclick="if(!confirm('Are You Sure Delete Order <?= $row['nama_pemesan'] ?>?')) {return false}"><i class='bx bx-trash'></i>Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                    $nomor++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

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
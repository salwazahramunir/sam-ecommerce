 <?php
   require_once '../../config/connection.php';

   $_date = $_POST['purchase_date'];
   $_customer_name = $_POST['customer_name'];
   $_address = $_POST['address'];
   $_phone_number = $_POST['phone_number'];
   $_email = $_POST['email'];
   $_order_quantity = $_POST['order_quantity'];
   $_description = $_POST['description'];
   $_product_id = $_POST['product_id'];

   $_process = $_POST['process'];

   // array data
   $ar_data = [
      $_date,
      $_customer_name,
      $_address,
      $_phone_number,
      $_email,
      $_order_quantity,
      $_description,
      $_product_id
   ];

   if ($_process == "Checkout") {
      // data baru
      $sql = "INSERT INTO pesanan (tanggal, nama_pemesan, alamat_pemesan, no_hp, email, jumlah_pesanan, deskripsi, produk_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
   }

   if (isset($sql)) {
      $st = $conn->prepare($sql);
      $st->execute($ar_data);
   }

   header('location:success_checkout.php');
   ?>
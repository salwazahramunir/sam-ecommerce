<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Buat Koneksi DB
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

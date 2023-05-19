<?php
// Membuat variabel, ubah sesuai dengan nama host dan database pada hosting 
$host = "localhost:3306";
$user = "psait11";
$pass = "psait11";
$db   = "psait11";
 
//Menggunakan objek mysqli untuk membuat koneksi dan menyimpan nya dalam variabel $mysqli 
$mysqli = new mysqli($host, $user, $pass, $db);
 
?>
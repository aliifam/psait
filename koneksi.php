<?php
// Membuat variabel, ubah sesuai dengan nama host dan database pada hosting 
$host = "localhost";
$user = "psait_11";
$pass = "psait_11";
$db   = "db_psait_11";
 
//Menggunakan objek mysqli untuk membuat koneksi dan menyimpan nya dalam variabel $mysqli 
$mysqli = new mysqli($host, $user, $pass, $db);
 
?>
<?php
/**
 * using mysqli_connect for database connection
 */
 
$databaseHost = 'localhost:3306';
$databaseName = 'psait_db';
$databaseUsername = 'root';
$databasePassword = 'password';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

 
?>
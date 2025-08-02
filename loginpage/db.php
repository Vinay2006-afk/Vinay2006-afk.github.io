<?php
$host = "localhost";        // or 127.0.0.1
$user = "root";             // your MySQL username
$pass = "root";                 // your MySQL password (empty by default on XAMPP/MAMP)
$dbname = "my_website";     // your database name

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

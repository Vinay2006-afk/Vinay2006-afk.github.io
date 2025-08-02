<?php
session_start();
include("db.php");

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

$sql = "SELECT * FROM login_details WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if ($password === $row['password']) {
        $_SESSION['username'] = $username;
        header("Location: codezone.php");
        exit();
    } else {
        echo "<script>alert('Wrong password'); window.location.href = 'login.html';</script>";
    }
} else {
    echo "<script>alert('User not found'); window.location.href = 'login.html';</script>";
}
?>

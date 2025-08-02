<?php
include("db.php");

$username = $_POST['username'] ?? '';
$mail_id = $_POST['mail_id'] ?? '';
$password = $_POST['password'] ?? '';

// Escape input
$username = mysqli_real_escape_string($conn, $username);
$mail_id = mysqli_real_escape_string($conn, $mail_id);
$password = mysqli_real_escape_string($conn, $password);

// Check if username already exists
$check = mysqli_query($conn, "SELECT * FROM login_details WHERE username='$username'");
if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('Username already exists! ❌'); window.history.back();</script>";
    exit();
}

// Insert new user
$sql = "INSERT INTO login_details (username, mail_id, password) VALUES ('$username', '$mail_id', '$password')";
if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registered Successfully! 🎉'); window.location.href='login.html';</script>";
} else {
    $error = addslashes(mysqli_error($conn)); // escape potential quote issues
    echo "<script>alert('Error while registering: $error'); window.history.back();</script>";
}

mysqli_close($conn);
?>

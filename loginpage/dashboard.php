<?php
session_start();

if (!isset($_SESSION['username'])) {
    // User is not logged in
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <div class="login-wrapper">
    <div class="login-container">
      <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
      <p>You’ve successfully logged in 🎉</p>
      <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
      </form>
    </div>
  </div>

</body>
</html>

<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $users_file = 'users.txt';

  if (file_exists($users_file)) {
    $users = file($users_file, FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
      list($stored_user, $stored_hash) = explode(':', $user);
      if ($stored_user === $username && password_verify($password, $stored_hash)) {
        $_SESSION['username'] = $username;
        header('Location: mode.php');
        exit;
      }
    }
  }
  echo "<p style='color:red;'>Invalid username or password.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="emoji-bg">
  <span style="top: 10%; left: 15%;">🐍</span>
  <span style="top: 30%; left: 40%;">🪜</span>
  <span style="top: 50%; left: 60%;">🐍</span>
  <span style="top: 70%; left: 80%;">🪜</span>
  <span style="top: 20%; left: 75%;">🐍</span>
  <span style="top: 60%; left: 25%;">🪜</span>
  <span style="top: 35%; left: 5%;">🐍</span>
  <span style="top: 85%; left: 50%;">🪜</span>
  <span style="top: 40%; left: 90%;">🐍</span>
  <span style="top: 75%; left: 10%;">🪜</span>
</div>

  <div class="container">
    <h2>Login</h2>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" class="btn" value="Login">
    </form>
  </div>
</body>
</html>
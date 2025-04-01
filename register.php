<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $users_file = 'users.txt';

  // Prevent duplicate usernames
  $users = file_exists($users_file) ? file($users_file, FILE_IGNORE_NEW_LINES) : [];
  foreach ($users as $user) {
    list($existing_user,) = explode(':', $user);
    if ($existing_user === $username) {
      echo "<p style='color:red;'>Username already exists. Please try another.</p>";
      $username = '';
      break;
    }
  }

  if (!empty($username)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    file_put_contents($users_file, "$username:$hashed\n", FILE_APPEND);
    $_SESSION['username'] = $username;
    header('Location: mode.php');
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Register</h2>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" class="btn" value="Register">
    </form>
  </div>
</body>
</html>
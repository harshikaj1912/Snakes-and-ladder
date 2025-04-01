<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Homepage</title>
  <link rel="stylesheet" href="style.css">
  <a href="rules.php" class="btn">Game Rules</a>
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
    <h2>Welcome to Adventures of the Dice!</h2>
    <p>Please login or register to begin.</p>

    <form method="get">
      <input type="submit" class="btn" value="Login" formaction="login.php">
      <input type="submit" class="btn" value="Register" formaction="register.php">
    </form>
  </div>
</body>
</html>

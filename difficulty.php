<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_SESSION['difficulty'] = $_POST['difficulty'];
  header('Location: game.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select Difficulty</title>
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
    <h2>Select Difficulty Level</h2>
    <form method="post">
      <button class="btn" name="difficulty" value="easy">Easy (50 Squares)</button>
      <button class="btn" name="difficulty" value="medium">Medium (100 Squares)</button>
      <button class="btn" name="difficulty" value="hard">Hard (200 Squares)</button>
    </form>
  </div>
</body>
</html>
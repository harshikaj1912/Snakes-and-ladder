<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

// Clean only previous game-related session data (keep username)
unset(
  $_SESSION['mode'],
  $_SESSION['player_names'],
  $_SESSION['player_colors'],
  $_SESSION['player_types'],
  $_SESSION['positions'],
  $_SESSION['turn'],
  $_SESSION['last_roll'],
  $_SESSION['move_message'],
  $_SESSION['winner'],
  $_SESSION['difficulty'],
  $_SESSION['player_form_count']
);

// Handle game mode selection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['game_mode'])) {
    $_SESSION['mode'] = $_POST['game_mode'];

    if ($_POST['game_mode'] === 'single') {
      $_SESSION['player_names'] = ['You'];
      $_SESSION['player_colors'] = ['green'];
      $_SESSION['player_types'] = ['human', 'ai'];
      header('Location: difficulty.php');
      exit;
    } else {
      $_SESSION['player_form_count'] = 2; // multiplayer starts with 2 forms
      header('Location: player_setup.php');
      exit;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select Game Mode</title>
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
    <h2>Choose Game Type</h2>
    <form method="post">
      <label><input type="radio" name="game_mode" value="single" required> Single Player</label>
      <label><input type="radio" name="game_mode" value="multi"> Multiplayer</label>
      <input type="submit" class="btn" value="Continue">
    </form>
  </div>
</body>
</html>

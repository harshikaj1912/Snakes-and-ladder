<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Single Player Setup</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Single Player Setup</h2>
  <form method="post" action="ai_select.php">

    <!-- Human Player -->
    <div class="player-config">
      <label>Player Name:</label>
      <input type="text" name="player_names[0]" value="You" required>

      <label>Token Color:</label>
      <select name="player_colors[0]" required>
        <option value="green">Green</option>
        <option value="blue">Blue</option>
        <option value="orange">Orange</option>
        <option value="red">Red</option>
      </select>

      <input type="hidden" name="player_types[0]" value="human">
    </div>

    <!-- AI Opponent -->
    <div class="player-config">
      <label>AI Opponent:</label>
      <input type="text" value="Computer" readonly>
      <input type="hidden" name="player_names[1]" value="Computer">

      <label>AI Token Color:</label>
      <select name="player_colors[1]">
        <option value="red">Red</option>
        <option value="blue">Blue</option>
        <option value="green">Green</option>
        <option value="orange">Orange</option>
      </select>

      <input type="hidden" name="player_types[1]" value="ai">
    </div>

    <input type="submit" class="btn" value="Continue to Difficulty">
  </form>
</div>
</body>
</html>

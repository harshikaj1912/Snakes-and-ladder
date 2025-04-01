<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

if (!isset($_SESSION['player_form_count'])) {
  $_SESSION['player_form_count'] = 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_player'])) {
    $_SESSION['player_form_count']++;
  } elseif (isset($_POST['continue'])) {
    $_SESSION['player_names'] = $_POST['player_names'];
    $_SESSION['player_colors'] = $_POST['player_colors'];
    $_SESSION['player_types'] = $_POST['player_types'];
    header('Location: difficulty.php');
    exit;
  }
}

$playerCount = $_SESSION['player_form_count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Player Setup</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Multiplayer Setup</h2>
  <form method="post">
    <?php for ($i = 0; $i < $playerCount; $i++): ?>
      <div class="player-config">
        <label>Player <?php echo $i + 1; ?> Name:</label>
        <input type="text" name="player_names[]" value="<?php echo isset($_POST['player_names'][$i]) ? htmlspecialchars($_POST['player_names'][$i]) : 'Player ' . ($i + 1); ?>" required>

        <label>Color:</label>
        <select name="player_colors[]">
          <option value="green">Green</option>
          <option value="red">Red</option>
          <option value="blue">Blue</option>
          <option value="orange">Orange</option>
        </select>

        <label>Type:</label>
        <select name="player_types[]">
          <option value="human">Human</option>
          <option value="ai">AI</option>
        </select>
      </div>
    <?php endfor; ?>

    <button type="submit" name="add_player" class="btn">+ Add Another Player</button>
    <button type="submit" name="continue" class="btn">Continue</button>
  </form>
</div>
</body>
</html>

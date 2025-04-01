<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $player_names = $_POST['player_names'];
  $player_colors = $_POST['player_colors'];
  $player_types = $_POST['player_types'];

  $valid_players = [];
  $valid_colors = [];
  $valid_types = [];

  for ($i = 0; $i < count($player_names); $i++) {
    $name = trim($player_names[$i]);

    // Only include players with non-empty names and a selected color
    if (!empty($name) && !empty($player_colors[$i])) {
      $valid_players[] = $name;
      $valid_colors[] = $player_colors[$i];
      $valid_types[] = $player_types[$i];
    }
  }

  // Require at least 1 player to proceed
  if (count($valid_players) === 0) {
    echo "<p style='color:red;'>Please enter at least one player to start the game.</p>";
    echo "<p><a href='setup_multi.php'>Go back</a></p>";
    exit;
  }

  $_SESSION['player_names'] = $valid_players;
  $_SESSION['player_colors'] = $valid_colors;
  $_SESSION['player_types'] = $valid_types;

  $_SESSION['ai_players'] = 0;
  foreach ($valid_types as $type) {
    if ($type === 'ai') {
      $_SESSION['ai_players']++;
    }
  }

  $_SESSION['total_players'] = count($valid_players);

  header('Location: difficulty.php');
  exit;
} else {
  echo "<p style='color:red;'>Invalid access method. Please start from the mode selection page.</p>";
}
?>

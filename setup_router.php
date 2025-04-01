<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['game_mode'])) {
    $_SESSION['game_mode'] = $_POST['game_mode'];

    if ($_POST['game_mode'] === 'single') {
      header('Location: setup_single.php');
    } elseif ($_POST['game_mode'] === 'multi') {
      header('Location: setup_multi.php');
    } else {
      echo "<p style='color:red;'>Invalid selection. Please go back and try again.</p>";
    }

    exit;
  } else {
    echo "<p style='color:red;'>Game mode not selected.</p>";
  }
} else {
  echo "<p style='color:red;'>Invalid access method.</p>";
}
?>

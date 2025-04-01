<?php
session_start();

// Ensure required data exists
if (!isset($_SESSION['winner'], $_SESSION['player_names'], $_SESSION['positions'], $_SESSION['player_types'])) {
  header('Location: mode.php');
  exit;
}

$winnerIndex = $_SESSION['winner'];
$names = $_SESSION['player_names'];
$positions = $_SESSION['positions'];
$types = $_SESSION['player_types'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leaderboard</title>
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
  <h2>🏁 Game Over</h2>
  <p class="winner" style="font-size: 22px; font-weight: bold; color: green;">
    🎉 Congratulations <span style="color: darkblue;"><?php echo htmlspecialchars($names[$winnerIndex]); ?></span>! You won the game!
  </p>

  <h3>📊 Leaderboard</h3>
  <table>
    <tr>
      <th>Player</th>
      <th>Type</th>
      <th>Final Position</th>
    </tr>
    <?php foreach ($names as $i => $name): ?>
      <tr>
        <td><?php echo htmlspecialchars($name); ?></td>
        <td><?php echo ucfirst($types[$i]); ?></td>
        <td><?php echo $positions[$i]; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <div style="margin-top: 30px;">
    <form action="mode.php" method="post" style="display: inline;">
      <button class="btn">🔁 Play Again</button>
    </form>
    <form action="logout.php" method="post" style="display: inline; margin-left: 10px;">
      <button class="btn">🚪 Logout</button>
    </form>
  </div>
</div>
</body>
</html>

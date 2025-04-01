<?php
session_start();

if (!isset($_SESSION['player_names'], $_SESSION['player_colors'], $_SESSION['player_types'], $_SESSION['difficulty'])) {
  header('Location: login.php');
  exit;
}

$names  = $_SESSION['player_names'];
$colors = $_SESSION['player_colors'];
$types  = $_SESSION['player_types'];
$playerCount = count($names);

switch ($_SESSION['difficulty']) {
  case 'easy': $totalSquares = 50; break;
  case 'medium': $totalSquares = 100; break;
  case 'hard': $totalSquares = 200; break;
  default: $totalSquares = 50;
}

if (!isset($_SESSION['positions'])) {
  $_SESSION['positions'] = array_fill(0, $playerCount, 1);
  $_SESSION['turn'] = 0;
  $_SESSION['last_roll'] = '-';
  $_SESSION['move_message'] = '';
}

$positions = $_SESSION['positions'];
$turn = $_SESSION['turn'];
$last_roll = $_SESSION['last_roll'];

$board_map = [
  14 => 4, 22 => 8, 47 => 15,
  5 => 25, 12 => 35, 34 => 50,
  65 => 45, 87 => 20, 99 => 55,
  102 => 75, 150 => 120
];

function movePlayer($i, $roll, $map, $limit) {
  $new = $_SESSION['positions'][$i] + $roll;
  $from = $new;

  if (isset($map[$new])) {
    $new = $map[$new];
    $type = ($new < $from) ? "bitten by a snake 🐍" : "climbed a ladder 🪜";
    $_SESSION['move_message'] = $_SESSION['player_names'][$i] . " $type: $from → $new";
  } else {
    $_SESSION['move_message'] = $_SESSION['player_names'][$i] . " moved to $new";
  }

  if ($new <= $limit) $_SESSION['positions'][$i] = $new;

  if ($new == $limit) {
    $_SESSION['winner'] = $i;
    header("Location: leaderboard.php?winner=$i");
    exit;
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $current = $_SESSION['turn'];
  $roll = rand(1, 6);
  $_SESSION['last_roll'] = $roll;

  movePlayer($current, $roll, $board_map, $totalSquares);

  $_SESSION['turn'] = ($current + 1) % $playerCount;

  while ($_SESSION['player_types'][$_SESSION['turn']] === 'ai') {
    $ai = $_SESSION['turn'];
    $roll = rand(1, 6);
    $_SESSION['last_roll'] = $roll;
    movePlayer($ai, $roll, $board_map, $totalSquares);
    $_SESSION['turn'] = ($ai + 1) % $playerCount;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Snakes & Ladders - <?php echo ucfirst($_SESSION['difficulty']); ?></title>
  <link rel="stylesheet" href="style.css">
  <style>
    <?php foreach ($colors as $i => $color): ?>
    .player.p<?php echo $i; ?> { background-color: <?php echo $color; ?>; }
    <?php endforeach; ?>
  </style>
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
  <h2>Snakes & Ladders (<?php echo ucfirst($_SESSION['difficulty']); ?> - <?php echo $totalSquares; ?> Squares)</h2>

  <?php if (!empty($_SESSION['move_message'])): ?>
    <div class="move-message">🎯 <?php echo $_SESSION['move_message']; ?></div>
  <?php endif; ?>

  <div class="dice-roll">
    🎲 Last Roll: <?php echo $last_roll; ?> — 
    <?php echo isset($names[$turn]) ? htmlspecialchars($names[$turn]) : "Player " . ($turn + 1); ?>'s Turn
  </div>

  <div class="board">
    <?php
    $rows = ceil($totalSquares / 10);
    for ($r = $rows; $r > 0; $r--) {
      $start = ($r - 1) * 10 + 1;
      $end = min($r * 10, $totalSquares);
      $range = $r % 2 === 0 ? range($end, $start) : range($start, $end);

      foreach ($range as $i) {
        $class = 'cell';
        $content = $i;

        if (isset($board_map[$i])) {
          $icon = $board_map[$i] < $i ? '🐍' : '🪜';
          $class .= $board_map[$i] < $i ? ' snake' : ' ladder';
          $content .= "<div class='icon'>$icon<br><small>$i → {$board_map[$i]}</small></div>";
        }

        $playersOnSquare = '';
        foreach ($positions as $pid => $pos) {
          if ($pos == $i) {
            $playersOnSquare .= "<div class='player p$pid'>P" . ($pid + 1) . "</div>";
          }
        }
        $content .= $playersOnSquare;

        echo "<div class='$class'>$content</div>";
      }
    }
    ?>
  </div>

  <?php if ($types[$turn] === 'human'): ?>
    <form method="post">
      <button class="btn" type="submit">🎲 Roll Dice</button>
    </form>
  <?php else: ?>
    <p>⌛ <?php echo isset($names[$turn]) ? htmlspecialchars($names[$turn]) : "Player " . ($turn + 1); ?> (AI) is playing...</p>
    <meta http-equiv="refresh" content="2">
  <?php endif; ?>

  <hr>
  <div class="legend">
    <h3>📜 Legend</h3>
    <ul>
      <?php foreach ($board_map as $from => $to): ?>
        <li><?php echo ($to > $from ? "🪜" : "🐍") . " $from → $to"; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="player-stats">
    <h3>📊 Player Stats</h3>
    <ul>
      <?php foreach ($positions as $pid => $pos): ?>
        <li>
          <?php
            $playerName = isset($names[$pid]) ? htmlspecialchars($names[$pid]) : "Player " . ($pid + 1);
            echo "$playerName: Square $pos";
          ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <form method="post" action="logout.php">
    <input type="submit" class="btn" value="Reset & Logout">
  </form>
</div>
</body>
</html>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Multiplayer Setup</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Multiplayer Setup (Optional Players)</h2>
  <form method="post" action="ai_select.php">

    <?php for ($i = 0; $i < 4; $i++): ?>
      <fieldset class="player-config">
        <legend>Player <?php echo $i + 1; ?></legend>

        <label>Name (leave blank to skip):</label>
        <input type="text" name="player_names[<?php echo $i; ?>]" placeholder="Player <?php echo $i + 1; ?>">

        <label>Token Color:</label>
        <select name="player_colors[<?php echo $i; ?>]">
          <option value="">--Choose--</option>
          <option value="green">Green</option>
          <option value="red">Red</option>
          <option value="blue">Blue</option>
          <option value="orange">Orange</option>
        </select>

        <label>Type:</label>
        <select name="player_types[<?php echo $i; ?>]">
          <option value="human">Human</option>
          <option value="ai">AI</option>
        </select>
      </fieldset>
    <?php endfor; ?>

    <p><strong>Tip:</strong> Leave any player blank to skip them.</p>

    <input type="submit" class="btn" value="Continue to Difficulty">
  </form>
</div>
</body>
</html>

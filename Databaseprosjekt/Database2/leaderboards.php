<?php $tilkobling=mysqli_connect("localhost","marit","marit","Leaderboard");
$sql="SELECT Player.id, Player.gamertag, Player.prestige, spill.game, spill.score, spill.timeplayed FROM Player, spill WHERE Player.id=spill.id ORDER BY spill.score DESC"; $datasett=$tilkobling->query($sql);

$sql2="SELECT Player.id, Player.gamertag, (score/timeplayed) as sumn FROM Player, spill WHERE Player.id=spill.id ORDER BY sumn DESC LIMIT 3";
$datasett2=$tilkobling->query($sql2);

$sql3="SELECT gamertag, prestige, id FROM Player";
$datasett3=$tilkobling->query($sql3);
if(isset($_POST["submit"]))
{
  $sql3=sprintf("INSERT INTO Player(gamertag, prestige) VALUES('%s', %s)",
    $tilkobling->real_escape_string($_POST["txtTekst"]),
    $tilkobling->real_escape_string($_POST["txtText"])
    );
  $tilkobling->query($sql3);
  header("location: addscore.php");
}
?>
<!doctype html>
<html>
<head>
<title>Leaderboards</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="lead.css">

</head>

<body>
<header id="menyen">
<ul>
        <li class="lit"> <a href="index.html">Home</a></li>
        <li class="lit"> <a href="news.html">News</a></li>
        <li class="lit"> <a href="leaderboards.php">Leaderboards</a></li>
        <li class="lit"> <a href="treyarch.html">Treyarch</a></li>
    </ul>
</header>

  <h1>Black Ops III Leaderboard</h1>

      <table id="lead">
      <tr class="h">

        <th scope="col">Gamertag</th>
        <th scope="col">Prestige</th>
        <th scope="col">Game</th>
        <th scope="col">Score</th>
        <th scope="col">Time Played</th>
       </tr>
      <?php while($rad=mysqli_fetch_array($datasett)) { ?>
      <tr class="h">

        <td class="i"><?php echo($rad["gamertag"]) ?></td>
        <td class="i"><?php echo($rad["prestige"]) ?></td>
        <td class="i"><?php echo($rad["game"]) ?></td>
        <td class="i"><?php echo($rad["score"]) ?></td>
        <td class="i"><?php echo($rad["timeplayed"]) ?> Minutes</td>
       </tr>
       <?php } ?>
  </table>

<h3>Top 3 score per minute</h3>
<?php while($rad=mysqli_fetch_array($datasett2)) { ?>
<p><?php echo($rad["gamertag"]) ?> has
<?php echo($rad["sumn"]) ?> score per minute.</p>
<?php } ?>
<br/>
<h3>Add your stats</h3>
<table id="list" align="center">
<form method="post">
<tr class="pop">
<td class="bla"><label for="txtTekst">Gamertag:</label>
<input type="text" name="txtTekst" id="txtTekst" /></td>
</tr>
<tr class="pop">
<td class="bla"><label for="txtTekst">Prestige:</label>
<input type="text" name="txtText" id="txtText" /></td>
</tr>
</table>
<br />
<div id="mim">
<button type="submit" name="submit" align="center">Add player</button>
</div>
</form>
</table>
</body>
</html>
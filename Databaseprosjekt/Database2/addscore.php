<?php 
$tilkobling=mysqli_connect("localhost","lead","lead","Leaderboard");

$sql="SELECT gamertag, id FROM Player";
$datasett=$tilkobling->query($sql);
if(isset($_POST["submit"]))
{
  $sql=sprintf("INSERT INTO spill(game, score, timeplayed, id)
  	VALUES('%s', %s, %s, '%s')",
    $tilkobling->real_escape_string($_POST["txtTekst"]),
    $tilkobling->real_escape_string($_POST["txtText"]),
    $tilkobling->real_escape_string($_POST["txtTexxt"]),
    $tilkobling->real_escape_string($_POST["selid"])
    );
  $tilkobling->query($sql); 
  header("location: leaderboards.php");
}  	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add score</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="add.css">
</head>
<body>
<h3>Add your stats</h3>
<form method="post">
<table align="center">
<tr>
<td class="a"><label for="txtTekst">Game (Ex: BO3): </label>
<input type="text" name="txtTekst" id="txtTekst" /></td>
</tr>
<tr>
<td class="a"><label for="txtText">Score: </label>
<input type="text" name="txtText" id="txtText" /></td>
</tr>
<tr>
<td class="a"><label for="txtTexxt">Time played (minutes): </label>
<input type="text" name="txtTexxt" id="txtTexxt" /></td>
</tr>
<tr>
<td class="b"><select name="selid" id="selid">
<?php while($rad = mysqli_fetch_array($datasett)) {?>
<option value="<?php echo $rad["id"]; ?>">
<?php echo $rad["gamertag"]; ?>
</option>
<?php } ?>
</select>
</td>
</tr>
</table>
<button type="submit" name="submit">Add stats</button>
</form>
</body>
</html>
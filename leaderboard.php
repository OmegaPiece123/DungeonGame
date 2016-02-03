<!DOCTYPE HTML>
<!-- QIXIN CHEN -->
<html>
	<head>
		<title>
			Leaderboard
		</title>
		<?php
			$conn = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1713632_project','a1713632_project','ihateoracle123');
			$cmd = "SELECT score FROM alldata ORDER BY score DESC";
			$statement = $conn->prepare($cmd);
			$statement->execute();
			$data1 = $statement->fetchAll();
			$cmd1 = "SELECT nname FROM alldata WHERE score > 0 ORDER BY score DESC";
			$statement = $conn->prepare($cmd1);
			$statement->execute();
			$data2 = $statement->fetchAll();
			
		?>
		<link rel= "stylesheet" href= "stylepage.css">
		<script>
		</script>
	</head>
	
	
	<body>
		<h1>Score Board</h1>
		<h2>*Hover over the snowflakes to see where to navigate*</h2>
		<h3>Here shows the top 5 players and their high scores</h3>
		<div id = "lPage">
			<table border = "1"; style = "width:100%;" >
				<tr>
					<th>Player Nickname</th>
					<th>Score</th>
				</tr>
				<tr>
					<td> <?php echo($data2[0][nname]) ?></td>
					<td> <?php echo($data1[0][score]) ?></td>
				</tr>
				<tr>
					<td> <?php echo($data2[1][nname]) ?></td>
					<td> <?php echo($data1[1][score]) ?></td>
				</tr>
				<tr>
					<td> <?php echo($data2[2][nname]) ?></td>
					<td> <?php echo($data1[2][score]) ?></td>
				</tr>
				<tr>
					<td> <?php echo($data2[3][nname]) ?></td>
					<td> <?php echo($data1[3][score]) ?></td>
				</tr>
				<tr>
					<td> <?php echo($data2[4][nname]) ?></td>
					<td> <?php echo($data1[4][score]) ?></td>
				</tr>
			</table>
			<br />
		</div>
		<a href = "index.html"><img id = "snow1" src = "sprite/snow.png" title = "Home"/></a>
		<a href = "signup.html"><img id = "snow2" src = "sprite/snow.png" title = "Signup/Play" /></a>
		<a href = "leaderboard.php"><img id = "snow3" src = "sprite/snow.png" title = "Scoreboard" /></a>
		<a href = "login.php"><img id = "snow4" src = "sprite/snow.png" title = "Login" /></a>
	</body>

</html>
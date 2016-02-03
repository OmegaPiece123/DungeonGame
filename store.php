<!DOCTYPE HTML>
<!-- QIXIN CHEN -->
<html>
	<head>
		<title>
			Score Data
		</title>
		<?php
			$score = $_POST['score'];
			$uname = $_POST['uname'];
			$conn = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1713632_project','a1713632_project','ihateoracle123');
			$cmd = "UPDATE alldata
					SET score = '$score'
					WHERE uname= '$uname';";
			$statement = $conn->prepare($cmd);
			$statement->execute();
			
		?>
		<link rel= "stylesheet" href= "stylepage.css">
		<script>
		</script>
	</head>
	
	
	<body>
		<h1>Login to play here</h1>
		<h2>*Hover over the snowflakes to see where to navigate*</h2>
		<div id = "lPage">
			<?php
				echo("Data stored.");
				echo("<form action = 'leaderboard.php' method = 'post'>
						<input name = 'uname' type = 'hidden' value = '".$uname."' />
						<input value = 'Visit ScoreBoard' type = 'submit' />
						</form>"
						);			
			?>
		</div>
		<a href = "index.html"><img id = "snow1" src = "sprite/snow.png" title = "Home"/></a>
		<a href = "signup.html"><img id = "snow2" src = "sprite/snow.png" title = "Signup/Play" /></a>
		<a href = "leaderboard.php"><img id = "snow3" src = "sprite/snow.png" title = "Scoreboard" /></a>
		<a href = "login.php"><img id = "snow4" src = "sprite/snow.png" title = "Login" /></a>
	</body>

</html>
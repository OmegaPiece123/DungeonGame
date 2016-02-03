<!DOCTYPE HTML>
<!-- QIXIN CHEN -->
<html>
	<head>
		<title>
			Check Login
		</title>
		<?php
			$uname = $_POST['uname'];
			$pword = $_POST['pword'];
			$br = "<br />";
			$link = "<a href = 'login.php'>Go back</a>";
			$conn = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1713632_project','a1713632_project','ihateoracle123');
			$cmd = "SELECT * FROM alldata WHERE `uname` = '$uname' AND `pword` = '$pword'";
			$statement = $conn->prepare($cmd);
			$statement->execute();
		   	$data = $statement->fetch();
			
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
				if($data[uname] == $uname && $uname != "" && $data[pword] == $pword && $pword != "" )
				{
					echo("Congratulations you have successfully logged in");
					echo($br);
					echo("<form method = 'post' action = 'gamepg.php'>
						<input name = 'uname' type = 'hidden' value = '".$uname."' />
						<input name = 'pword' type = 'hidden' value = '".$pword."' />
						<input value = 'Play' type = 'submit' />
						</form>"
						);
				}
				else
				{
					echo("Username or Password is correct.");
					echo($br);
					echo($link);
				}	
			?>
			
		</div>
		<a href = "index.html"><img id = "snow1" src = "sprite/snow.png" title = "Home"/></a>
		<a href = "signup.html"><img id = "snow2" src = "sprite/snow.png" title = "Signup/Play" /></a>
		<a href = "leaderboard.php"><img id = "snow3" src = "sprite/snow.png" title = "Scoreboard" /></a>
		<a href = "login.php"><img id = "snow4" src = "sprite/snow.png" title = "Login" /></a>
	</body>

</html>
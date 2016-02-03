<!DOCTYPE HTML>
<!-- QIXIN CHEN -->
<html>
	<head>
		<title>
			reCheck
		</title>
		<?php
			$uname = $_POST['uname'];
			$pword = $_POST['pword'];
			$nname = $_POST['nname'];
			$cpword = $_POST['cpword'];
			$score = 0;
			$br = "<br />";
			$link = "<a href = 'signup.html'>Go back</a>";
			$conn = new PDO('mysql:host=mysql2.000webhost.com;dbname=a1713632_project','a1713632_project','ihateoracle123');
			$cmd1 = "SELECT uname FROM alldata WHERE uname='".$uname."'";
			$result1 = $conn->prepare($cmd1);
			$result1 ->execute();
			$info1 = $result1->fetch();
			$cmd2 = "SELECT nname FROM alldata WHERE nname='".$nname."'";
			$result2 = $conn->prepare($cmd2);
			$result2->execute();
			$info2 = $result2->fetch();
			$determine = true;
		?>
		<link rel= "stylesheet" href= "stylepage.css">
		<script>
		</script>
	</head>
	
	
	<body>
		<h1>Sign up and login to play here</h1>
		<h2>*Hover over the snowflakes to see where to navigate*</h2>
		<div id = "lPage">
			<?php
				if($uname == "" || $pword == "" || $nname == "")
				{
					echo("Some of the fields are empty");
					echo($br);
					echo($link);
					echo($br);
					$determine = false;
				}
				if($cpword != $pword)
				{
					echo("Confirm password and password for register does not match");
					echo($br);
					echo($link);
					echo($br);
					$determine = false;
				}
				if(isset($info1) && $info1[0] == $uname && $uname != "")
				{
					echo("The username is taken");
					echo($br);
					echo($link);
					echo($br);
					$determine = false;
				}
				if(isset($info2) && $info2[0] == $nname && $nname != "")
				{
					echo("The nickname is taken");
					echo($br);
					echo($link);
					echo($br);
					$determine = false;
				}
				if($determine)
				{
					$sql = "INSERT INTO `alldata` (`nname`, `uname`, `pword`,`score`) VALUES ('$nname','$uname','$pword','$score')";
					$statement = $conn->prepare($sql);
					$statement->execute();
					echo("Congratulations you have successfully signed up");
					echo($br);
					echo("Now, let's login to your account");
					echo($br);
					echo("<a href = 'login.php'>Login</a>");
				}
				
			?>
		</div>
		<a href = "index.html"><img id = "snow1" src = "sprite/snow.png" title = "Home"/></a>
		<a href = "signup.html"><img id = "snow2" src = "sprite/snow.png" title = "Signup/Play" /></a>
		<a href = "leaderboard.php"><img id = "snow3" src = "sprite/snow.png" title = "Scoreboard" /></a>
		<a href = "login.php"><img id = "snow4" src = "sprite/snow.png" title = "Login" /></a>
	</body>

</html>
<!DOCTYPE HTML>
<!-- QIXIN CHEN -->
<html>
	<head>
		<title>
			Login
		</title>
		<link rel= "stylesheet" href= "stylepage.css">
		<script>
		</script>
	</head>
	
	
	<body>
		<h1>Login to play here</h1>
		<h2>*Hover over the snowflakes to see where to navigate*</h2>
		<div id = "lPage">
			<form method = "post" action = "check.php">
				Username: <input name = "uname" type = "text" /><br /><br />
				Password: <input name = "pword" type = "password" /><br /><br />
				<input value = "Login" type = "submit" />
			</form>
			<br />
			<br />
			
		</div>
		<a href = "index.html"><img id = "snow1" src = "sprite/snow.png" title = "Home"/></a>
		<a href = "signup.html"><img id = "snow2" src = "sprite/snow.png" title = "Signup/Play" /></a>
		<a href = "leaderboard.php"><img id = "snow3" src = "sprite/snow.png" title = "Scoreboard" /></a>
		<a href = "login.php"><img id = "snow4" src = "sprite/snow.png" title = "Login" /></a>
	</body>

</html>
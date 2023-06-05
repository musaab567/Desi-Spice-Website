<?php
@session_start();
if (isset($_SESSION['username'])) {
	echo '<!doctype html>
	<html lang = "en">
		<head>
			<meta charset = "UTF-8">
			<title>Desi Spice</title>
			<link rel = "stylesheet" href= "../css/style.css">
		</head>
			
		<body>
			<div class = "wrapper">
				<nav class = "navbar">
					<img class = "logo" src = "../images/logo1.jpg">
					<ul>
						<li><a class = "active" href = "index.html">Home</a></li>
						<li><a href = "About us.html">About us</a></li>
						<li><a href = "Prices.html">Prices</a></li>
						<li><a href = "Contact.html">Contact</a></li>
						<li><a href = "../php/logout_user.php">Logout</a></li>
					</ul>
				</nav>
				<div class = "center">
					<h1><span>Welcome to Desi Spice!</h1></span>
					<h2><span>You tried the rest now come try the best!</h2>
				</div>
			</div>
		</body>
	</html>';
}else{
	include_once('../html/login_form.html');
}

?>
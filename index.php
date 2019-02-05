<?php

	// session_start();
	
	// if ((isset($_SESSION['logged_in'])) && ($_SESSION['logged_in']==true))
	// {
	// 	header('Location: main.php');
	// 	exit();
	// }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="DC - Heroes">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" href="img/dc_heroes_logo.png" type="image/gif">
	<title>DC Heroes</title>
</head>
<body>
	<header>
        <img src="img/dc_heroes_logo.png" height="100" width="100"/>
        Heroes
	</header>
	<div id="container">
        <div id="teams">
            <p>Teams</p>
            <p class="team">
            <span>Justice League</span>
            <span>Info - 1</span>
            <span>Info - 2</span>
            <span>Info - 3</span>
            <div class="show-team-button">A</div>
            </p>
            <p class="team">
            <span>Flash Family</span>
            <span>Info - 1</span>
            <span>Info - 2</span>
            <span>Info - 3</span>
            <div class="show-team-button">A</div>
            </p>
            <p class="team">
            <span>Batman & Robin</span>
            <span>Info - 1</span>
            <span>Info - 2</span>
            <span>Info - 3</span>
            <div class="show-team-button">A</div>
            </p>
            <p class="team">
            <span>Teen Titans</span>
            <span>Info - 1</span>
            <span>Info - 2</span>
            <span>Info - 3</span>
            <div class="show-team-button">A</div>
            </p>
        </div>
        <div class="line"></div>
        <div id="heroes">
        </div>
        <div class="line"></div>
        <div id="rating">
        </div>
	</div>
</body>
</html>
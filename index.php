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
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link rel="icon" href="img/dc_heroes_logo.png" type="image/gif">
	<title>DC Heroes</title>
</head>
<body>
	<header>
        <a href="index.php"><img src="img/dc_heroes_logo.png" height="100" width="100"/>Heroes</a>
        <input id="pass-input" type="password" name="pass" style="display: none;" onkeypress="Check(event)"/>
	</header>
	<div id="container">
        <nav id="teams">
            <p>Teams</p>
            <ul>
            <li>
                <p class="team" teamID="1">
                    <i class="icon-right-open selector"></i>
                    <span>Justice League</span>
                    <span>Info - 1</span>
                    <span>Info - 2</span>
                    <span>Info - 3</span>
                </p>
            </li>
            <li>
                <p class="team" teamID="2">
                    <i class="icon-right-open selector"></i>
                    <span>Flash Family</span>
                    <span>Info - 1</span>
                    <span>Info - 2</span>
                    <span>Info - 3</span>
                </p>
            </li>
            <li>
                <p class="team" teamID="3">
                    <i class="icon-right-open selector"></i>
                    <span>Batman & Robin</span>  
                    <span>Info - 1</span>
                    <span>Info - 2</span>
                    <span>Info - 3</span>
                </p>
            </li>
            <li>
                <p class="team" teamID="4">
                    <i class="icon-right-open selector"></i>
                    <span>Teen Titans</span>
                    <span>Info - 1</span>
                    <span>Info - 2</span>
                    <span>Info - 3</span>
                </p>
            </li>
            <li>
                <p class="team" teamID="5">
                    <i class="icon-right-open selector"></i>
                    <span>Superman Family</span>
                    <span>Info - 1</span>
                    <span>Info - 2</span>
                    <span>Info - 3</span>
                </p>
            </li>
            </ul>
        </nav>
        <div class="line"></div>
        <div id="heroes">
        </div>
        <div class="line"></div>
        <div id="rating">
            <div class="show-hero">
            </div>
        </div>
    </div>
    <script src="js/main.js"></script>
    <script src="js/rating.js"></script>
</body>
</html>
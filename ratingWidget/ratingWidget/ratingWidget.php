<?php
function myDump($var)
{
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
	
}

// connect to database server
$host 		= "localhost";
$user 		= "root";
$pass 		= "root";
$database 	= "dc-heroes";
$connect 	= mysqli_connect($host, $user, $pass, $database) or die (mysqli_error($connect));

$returnMessage = "";
// START POST SECTION
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(!isset($_POST['rating']))
	{
		$returnMessage = "You haven't rated!";
	}
	else
	{		
		// define SQL string
		$insertSQL = 
		"INSERT INTO
		`rating_new`
		(
		`ratingId`,
		`heroId`,
		`rating`,
		`ratingDate`,
		`ratingReview`
		)
		VALUES
		(
		null,
		'" . $_POST['heroId'] . "',
		'" . $_POST['rating'] . "',
		" . time() . ",
		'" . $_POST['myMessage'] . "'
		)
		";
		
		// show SQL string
		// myDump($insertSQL);exit;
		
		
		// run query
		$resource = mysqli_query($connect, $insertSQL) or die (mysqli_error($connect));
		
		if(!$resource)
		{
			$returnMessage = "<h1>Something went wrong!</h1>";
		}
		else
		{
			$returnMessage = "<h14>You have rated " . ($_POST['rating']/2) ." stars!!!</h4>";
			$returnMessage .= "<h4>Rating and Review inserted in the database!!!</h4>";
		}
	}
}
// END POST SECTION

// SQL to get heroes from the database
$selectHeroesSQL = "SELECT * FROM `hero`";

// heroId as parameter in the URL?
if(isset($_GET['heroId']))
{
	$heroId = $_GET['heroId'];
	// extend the SQL
	$selectHeroesSQL .= " WHERE `heroId` = " . $heroId;
}

// extend the SQL
$selectHeroesSQL .= " ORDER BY RAND() LIMIT 1";

// run the query / send to database server
$resource = mysqli_query($connect, $selectHeroesSQL) or die (mysqli_error($connect));

// get number of rows that matches the query
$rowcount = mysqli_num_rows($resource);

// empty array of heroes
$heroes = array();

// loop through the resource and return a row of an associative array of each hero
if($rowcount > 0)
{
	while($row 	= mysqli_fetch_assoc($resource))
	{
		// add heroes to the array heroes
		$hero = $row;
	}
}

// get reviews (if not empty) from hero
$selectReviewsQuery = "SELECT * FROM `rating_new` WHERE `ratingReview` != '' AND `heroId` = " . $hero['heroId'];

$reviews 	= array();
$resource 	= mysqli_query($connect, $selectReviewsQuery) or die (mysqli_error($connect));
while($row 	= mysqli_fetch_assoc($resource))
{
	// add items to the array
	$reviews[] = $row;
}

// now get the average rating of hero
$selectAVGQuery =
"SELECT (AVG(`rating`) / 2) as heroRating FROM `rating_new` WHERE `heroId` = " . $hero["heroId"];

$resource 	= mysqli_query($connect, $selectAVGQuery) or die (mysqli_error($connect));
$rating 	= mysqli_fetch_assoc($resource);

?>
<html>
	<head>
		<title>Rating Widget, to be used for DC-heroes..</title>
		<link href="css/web-fonts-with-css/css/fontawesome-all.css" rel="stylesheet" type="text/css"/>
		<link href="css/default.css" rel="stylesheet" type="text/css" />
		<meta name="author" content="Peter Nocker"/>
		<meta name="author" content="Benjamin Porobic"/>
		<meta name="keywords" content="css, html, forms, radiobuttons"/>
	</head>
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?heroId=<?php echo $hero["heroId"]; ?>" method="POST" class="frmRate">
			<fieldset>
				<legend>Rate a hero!</legend>
				<div>
					<img src="img/heroes/<?php echo $hero["heroImage"]; ?>" width="150"/>
					<h3><?php echo $hero["heroName"]; ?></h3>
					<h3>Rating : <?php echo $rating['heroRating']; ?></h3>
					<?php
					if($returnMessage != "")
					{
						?>
						<h3><?php echo $returnMessage; ?></h3>
						<?php
					}
					?>
				</div>
				<div class="rate">
					<input type="radio" id="rating10" name="rating" value="10" /><label class="lblRating" for="rating10" title="5 stars"></label>
				    <input type="radio" id="rating9" name="rating" value="9" /><label class="lblRating half" for="rating9" title="4 1/2 stars"></label>
				    <input type="radio" id="rating8" name="rating" value="8" /><label class="lblRating" for="rating8" title="4 stars"></label>
				    <input type="radio" id="rating7" name="rating" value="7" /><label class="lblRating half" for="rating7" title="3 1/2 stars"></label>
				    <input type="radio" id="rating6" name="rating" value="6" /><label class="lblRating" for="rating6" title="3 stars"></label>
				    <input type="radio" id="rating5" name="rating" value="5" /><label class="lblRating half" for="rating5" title="2 1/2 stars"></label>
				    <input type="radio" id="rating4" name="rating" value="4" /><label class="lblRating" for="rating4" title="2 stars"></label>
				    <input type="radio" id="rating3" name="rating" value="3" /><label class="lblRating half" for="rating3" title="1 1/2 stars"></label>
				    <input type="radio" id="rating2" name="rating" value="2" /><label class="lblRating" for="rating2" title="1 star"></label>
				    <input type="radio" id="rating1" name="rating" value="1" /><label class="lblRating half" for="rating1" title="1/2 star"></label>
				    <input type="radio" id="rating0" name="rating" value="0" /><label class="lblRating" for="rating0" title="No star"></label>
				</div>
				<div class="divMessage">
					<h3>Review</h3>
					<textarea name="myMessage"></textarea>
				</div>
				<div class="divSubmit">
					<input type="submit" name="submitRating" value="Review!"/>
					<input type="hidden" name="heroId" value="<?php echo $hero["heroId"]; ?>"/>
				</div>
			</fieldset>
		</form>
		<h3 class="reviewTable"><i class="far fa-comments"></i>&nbsp;Comments</h3>
		<?php
		if(!empty($reviews))
		{
			// print table 
			echo "<table class=\"reviewTable\">";
			foreach($reviews as $heroReview)
			{
				?>
				<tr>
					<td><i class="far fa-calendar" style="font-size:24px; color: #0282f9;"></i></td>
					<td><?php echo strftime("%d %B %Y",$heroReview['ratingDate']); ?></td>
					<td><i class="far fa-clock" style="font-size:24px; color: #0282f9;"></i></td>
					<td><?php echo strftime("%H:%M:%S",$heroReview['ratingDate']); ?></td>
				</tr>
				<tr><td colspan="4"><?php echo nl2br($heroReview['ratingReview']); ?></td></tr>
				<tr><td colspan="4"><hr /></td></tr>
				<?php
			}
			echo "</table>";
		}
		else
		{
			?>
			<h5 class="reviewTable"><i class="fas fa-info-circle"></i>&nbsp;No comments yet..</h5>
			<?php
		}
		?>
	</body>
</html>
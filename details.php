<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Most Popular Destinations</title>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/search.css">
  <link rel="stylesheet" type="text/css" href="css/autocomplete.css">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/flexslider.css" rel="stylesheet">
  <link href="css/travel-style.css" rel="stylesheet">
 </head>

<body class="travel-gray-bg">

	<?php
		include('header.php');
	?>

	<?php
	include 'restConsumer.php';
	include 'connectionToDatabase.php';
	include 'common.php';

	$country = "";
	$errors = array();

	if ($_SERVER["REQUEST_METHOD"] == "GET") {

		if (array_key_exists('country', $_GET))
		{
			$country = $_GET['country'];
		}

		if (empty($country))
		{
			 array_push($errors, "Error occured. There is no country code passed.");
			echo "<div class='missing-country'>Error occured. There is no country code passed.</div>";
		}
		else{

				$result = CallAPI("GET", "https://restcountries.eu/rest/v1/alpha/{$country}");
			  // echo $result["capital"];
				// var_dump($result);
				$borders = $result['borders'];

				$conn = CreateConnectionToDatabase();
				$sql = "CALL update_counters(:code)";
				$query = $conn->prepare($sql);
				$query->bindParam(':code', $country);
				try {
					$query->execute();
				} catch (PDOException $e) {
					$conn = null;
					die('Query failed: ' . $e->getMessage());
				}
				$conn = null;
		}
	}
	// echo count($errors);
	// $countErrors = count($errors);
	// $b = ($countErrors == 0);
	?>

	<?php if(count($errors) == 0): ?>

	<section class="container travel-home-section-1 details-zindex" id="more">
		<div class="row">
			<div class="flexslider flexslider-about effect2">
			  <ul class="slides">
			    <li>
			      <img src="<?php echo image_exists("img/Countries/".$country.".jpg") ?>" alt="image" />
			      <div class="flex-caption">
			      	<h2 class="slider-title"><?php echo $result['name']; ?></h2>
			      	<h3 class="slider-subtitle">Capital: <?php echo $result['capital']; ?></h3>
			      	<p class="slider-description"><?php echo $result['name']; ?> is in region <?php echo $result['region']; ?>
								and in the subregion of the <?php echo $result['subregion']; ?>. <br><br>
							</p>
			      	<div class="slider-social">
			      		<a class="travel-social-icon"><i class="fa fa-twitter"></i></a>
			      		<a class="travel-social-icon"><i class="fa fa-facebook"></i></a>
			      		<a class="travel-social-icon"><i class="fa fa-pinterest"></i></a>
			      		<a class="travel-social-icon"><i class="fa fa-google-plus"></i></a>
			      	</div>
			      </div>
			    </li>
			    <li>
			      <img src="<?php echo image_exists("img/Countries/".$country.".jpg") ?>" alt="image" />
			      <div class="flex-caption">
			      	<h2 class="slider-title">Interesting Facts</h2>
			      	<!-- <h3 class="slider-subtitle"></h3> -->
			      	<p class="slider-description">The Population of <?php echo $result['name']; ?> is <?php echo $result['population']; ?>. <br/><br/>
                    The demonym for the natives is <?php echo $result['demonym']; ?>. </p>
			      	<div class="slider-social">
			      		<a class="travel-social-icon"><i class="fa fa-twitter"></i></a>
			      		<a class="travel-social-icon"><i class="fa fa-facebook"></i></a>
			      		<a class="travel-social-icon"><i class="fa fa-pinterest"></i></a>
			      		<a class="travel-social-icon"><i class="fa fa-google-plus"></i></a>
			      	</div>
			      </div>
			    </li>
			    <li>
			      <img src="<?php echo image_exists("img/Countries/".$country.".jpg") ?>" alt="image" />
			      <div class="flex-caption">
			      	<h2 class="slider-title">More</h2>
			      	<!-- <h3 class="slider-subtitle"></h3> -->
			      	<p class="slider-description">The TimeZone of <?php echo $result['name']; ?> is <?php echo "'".$result['timezones'][0]."'"; ?>. <br/><br/>
							The borders are:
							<?php
								$counter = 1;
								foreach($borders as $border)
								{
										if ($counter == count($borders))
										{
											echo "'".$border."'.";
										}
										else {
											echo "'".$border."', ";
										}
										$counter++;
								}
								?> <br/><br/>
							The currency code of <?php echo $result['name']; ?> is <?php echo $result['currencies'][0]; ?>. </p>
			      	<div class="slider-social">
			      		<a class="travel-social-icon"><i class="fa fa-twitter"></i></a>
			      		<a class="travel-social-icon"><i class="fa fa-facebook"></i></a>
			      		<a class="travel-social-icon"><i class="fa fa-pinterest"></i></a>
			      		<a class="travel-social-icon"><i class="fa fa-google-plus"></i></a>
			      	</div>
			      </div>
			    </li>
			  </ul>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
    include('footer.php');
   ?>

		<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      		<!-- jQuery -->
  	<script type="text/javascript" src="js/bootstrap.min.js"></script>					<!-- bootstrap js -->
  	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>			<!-- flexslider js -->
  	<script type="text/javascript" src="js/travel-script.js"></script>      		<!-- travel Script -->
		<script type="text/javascript" src="js/http-helper.js"></script>
		<script type="text/javascript" src="js/search.js"></script>

	<script>

		$(window).load(function(){
			// Flexsliders
		  	$('.flexslider.flexslider-banner').flexslider({
			    controlNav: false
		    });
		  	$('.flexslider').flexslider({
		    	animation: "slide",
		    	directionNav: false,
		    	slideshow: false
		  	});
		});
	</script>

</body>
</html>

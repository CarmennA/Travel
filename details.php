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
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="css/flexslider.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">
 </head>

<body class="tm-gray-bg">

	<!-- Header -->
  	<div class="tm-header">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-4 col-md-4 col-sm-3 tm-site-name-container">
  					<a href="#" class="tm-site-name">Holiday</a>
  				</div>
	  			<div class="col-lg-8 col-md-8 col-sm-9">
	  				<div class="mobile-menu-icon">
		              <i class="fa fa-bars"></i>
		            </div>
	  				<nav class="tm-nav">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="popular.php?country='Anguilla'">Most Popular</a></li>
							<li><a href="tours.html">Our Tours</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</nav>
	  			</div>
  			</div>
  		</div>
  	</div>

		<!-- Banner -->
				<section class="tm-banner">
					<!-- Flexslider -->
					<div class="flexslider flexslider-banner">
					  <ul class="slides">
					    <li>
						    <div class="tm-banner-inner">
								<h1 class="tm-banner-title"><span class="tm-yellow-text">Tour</span> Packages</h1>
								<p class="tm-banner-subtitle">For Your Vacations</p>
							</div>
					      <img src="img/banner-3.jpg" alt="Image" />
					    </li>
					    <li>
						    <div class="tm-banner-inner">
								<h1 class="tm-banner-title">Lorem <span class="tm-yellow-text">Ipsum</span> Dolor</h1>
								<p class="tm-banner-subtitle">Wonderful Destinations</p>
							</div>
					      <img src="img/banner-2.jpg" alt="Image" />
					    </li>
					    <li>
						    <div class="tm-banner-inner">
								<h1 class="tm-banner-title">Proin <span class="tm-yellow-text">Gravida</span> Nibhvell</h1>
								<p class="tm-banner-subtitle">Velit Auctor</p>
							</div>
					      <img src="img/banner-1.jpg" alt="Image" />
					    </li>
					  </ul>
					</div>
				</section>

				<div class="container search-container">
					<div class="row search-row">
						<div class="col-md-12">
							<div class="custom-search-input">
								<div class="input-group col-md-12">
									<input id="searchField" type="text" class="form-control input-lg" placeholder="Enter country name" onkeyup="AutocompleteSearch.updateList(this.value);" />
									<span class="input-group-btn">
										<button class="btn btn-lg" type="button" onclick="AutocompleteSearch.search();">
											<i class="glyphicon glyphicon-search"></i>
										</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="dropdown">
			  		<div id="myDropdown" class="dropdown-content">
						</div>
					</div>
				</div>

	<?php
	include 'restConsumer.php';
	include 'connectionToDatabase.php';

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
				var_dump($result);

				$conn = CreateConnectionToDatabase();
				$sql = "UPDATE s
						SET s.Searches = s.Searches + 1, s.Order = (
							CASE
									WHEN 
										EXISTS(SELECT NULL FROM searches innerS WHERE innerS.Searches = s.Searches + 1)
										THEN 
											(SELECT innerS.Order + 1 
											FROM searches innerS 
											WHERE innerS.Searches = s.Searches + 1 
											ORDER BY innerS.Order DESC 
											LIMIT 1)
									ELSE 1
							END)
						FROM searches s
						WHERE s.CountryCode = :code";
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

			<!-- gray bg -->
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			<!-- slider -->
			<div class="flexslider flexslider-about effect2">
			  <ul class="slides">
			    <li>
			      <img src="img/about-1.jpg" alt="image" />
			      <div class="flex-caption">
			      	<h2 class="slider-title">Welcome To Holiday</h2>
			      	<h3 class="slider-subtitle">Gravida nibh vel velit auctor aliquet enean sollicitudin lorem quis auctor</h3>
			      	<p class="slider-description">Holiday is free Bootstrap v3.3.5 responsive template for tour and travel websites. You can download and use this layout for any purpose. You do not need to provide a credit link to us. If you have any question, feel free to <a href="http://www.facebook.com/templatemo" target="_parent">contact us</a>. <br><br>
                    Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum.</p>
			      	<div class="slider-social">
			      		<a href="#" class="tm-social-icon"><i class="fa fa-twitter"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-facebook"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-pinterest"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-google-plus"></i></a>
			      	</div>
			      </div>
			    </li>
			    <li>
			      <img src="img/about-1.jpg" alt="image" />
			      <div class="flex-caption">
			      	<h2 class="slider-title">Thank you for choosing us!</h2>
			      	<h3 class="slider-subtitle">Gravida nibh vel velit auctor aliquet enean sollicitudin lorem quis auctor, nisi elit consequat ipsum</h3>
			      	<p class="slider-description">Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.<br><br>
                    Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris gestas quam, ut aliquam massa nisi.</p>
			      	<div class="slider-social">
			      		<a href="#" class="tm-social-icon"><i class="fa fa-twitter"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-facebook"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-pinterest"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-google-plus"></i></a>
			      	</div>
			      </div>
			    </li>
			    <li>
			      <img src="img/about-1.jpg" alt="image" />
			      <div class="flex-caption">
			      	<h2 class="slider-title">More Programs to come</h2>
			      	<h3 class="slider-subtitle">Gravida nibh vel velit auctor aliquet enean sollicitudin lorem quis auctor, nisi elit consequat ipsum</h3>
			      	<p class="slider-description">Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris gestas quam, ut aliquam massa nisi.</p>
			      	<div class="slider-social">
			      		<a href="#" class="tm-social-icon"><i class="fa fa-twitter"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-facebook"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-pinterest"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-google-plus"></i></a>
			      	</div>
			      </div>
			    </li>
			    <li>
			      <img src="img/about-1.jpg" alt="image" />
			      <div class="flex-caption">
			      	<h2 class="slider-title">Tour and Travel</h2>
			      	<h3 class="slider-subtitle">Gravida nibh vel velit auctor aliquet enean sollicitudin lorem quis auctor, nisi elit consequat ipsum</h3>
			      	<p class="slider-description">Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris gestas quam, ut aliquam massa nisi.</p>
			      	<div class="slider-social">
			      		<a href="#" class="tm-social-icon"><i class="fa fa-twitter"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-facebook"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-pinterest"></i></a>
			      		<a href="#" class="tm-social-icon"><i class="fa fa-google-plus"></i></a>
			      	</div>
			      </div>
			    </li>
			  </ul>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<footer class="tm-black-bg">
		<div class="container">
			<div class="row">
				<p class="tm-copyright-text">Copyright &copy; 2017</p>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      		<!-- jQuery -->
  	<script type="text/javascript" src="js/bootstrap.min.js"></script>					<!-- bootstrap js -->
  	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>			<!-- flexslider js -->
  	<script type="text/javascript" src="js/templatemo-script.js"></script>      		<!-- Templatemo Script -->
		<script type="text/javascript" src="js/http-helper.js"></script>
		<script type="text/javascript" src="js/search.js"></script>

	<script>
		$(function() {

			// https://css-tricks.com/snippets/jquery/smooth-scrolling/
		  	$('a[href*=#]:not([href=#])').click(function() {
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			      var target = $(this.hash);
			      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			      if (target.length) {
			        $('html,body').animate({
			          scrollTop: target.offset().top
			        }, 1000);
			        return false;
			      }
			    }
		  	});
		});
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

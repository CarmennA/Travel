<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Travel</title>
  
  
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
  	<div class="tm-header">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-6 col-md-4 col-sm-3 tm-site-name-container">
  					<a href="#" class="tm-site-name">Holiday</a>
  				</div>
	  			<div class="col-lg-6 col-md-8 col-sm-9">
	  				<div class="mobile-menu-icon">
		        	<i class="fa fa-bars"></i>
		        </div>
	  				<nav class="tm-nav">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="popular.php" class="active">Popular</a></li>
							<li><a href="tours.html">Our Tours</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</nav>
	  		</div>
  		</div>
  	</div>

	<section class="tm-banner">
		<div class="flexslider flexslider-banner">
			<ul class="slides">
				<li>
					<div class="tm-banner-inner">
						<h1 class="tm-banner-title">Find <span class="tm-yellow-text">The Best</span> Place</h1>
						<p class="tm-banner-subtitle">For Your Holidays</p>
					</div>
					<img src="img/banner-1.jpg" alt="Image" />
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
					<img src="img/banner-3.jpg" alt="Image" />
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
		
		
		
	?>
	
	<form met>
	

	<footer class="tm-black-bg">
		<div class="container">
			<div class="row">
				<p class="tm-copyright-text">Copyright &copy; 2017</p>
			</div>
		</div>
	</footer>

	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/moment.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>

	<script type="text/javascript" src="js/templatemo-script.js"></script>

	<script type="text/javascript" src="js/http-helper.js"></script>
	<script type="text/javascript" src="js/search.js"></script>

	<script>
		$(window).load(function() {
				$('.flexslider').flexslider({
					controlNav: false
				});
		});
	</script>
</body>
</html>
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

		include 'connectionToDatabase.php';

		$conn = CreateConnectionToDatabase();
		$sql = 'SELECT c.Name, c.Code, s.Searches, s.Order FROM countries c JOIN searches s ON s.CountryCode = c.Code ORDER BY s.Searches, s.ORDER DESC LIMIT 10';
		$results = $conn->query($sql);
		$topCountries = [];
		while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
				array_push($topCountries, $row);
		}

		?>

		<section class="container tm-home-section-1" id="more">
			<div class="section-margin-top">
				<div class="row">				
					<div class="tm-section-header">
						<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
						<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Most popular</h2></div>
						<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
					</div>
				</div>
				<div class="row">
					<?php foreach($topCountries as $country): ?>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="tm-tours-box-1">
								<img src="img/tours-03.jpg" alt="image" class="img-responsive">
								<div class="tm-tours-box-1-info">
									<div class="tm-tours-box-1-info-left">
										<p class="text-uppercase margin-bottom-20"><?php echo $country['Name']; ?></p>
									</div>
									<div class="tm-tours-box-1-info-right">
										<button class="gray-text tours-1-description" onclick="viewDetails('<?php echo $country['Code']; ?>');">View</button>	
									</div>							
								</div>
								<div class="tm-tours-box-1-link">
									<div class="tm-tours-box-1-link-left">
										Searches:
									</div>
									<a href="#" class="tm-tours-box-1-link-right">
										<?php echo $country['Searches']; ?>								
									</a>							
								</div>
							</div>					
						</div>
					<?php endforeach; ?>
				</div>		
			</div>
		</section>	

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
			function viewDetails(selectedCode) {
					location.href = "http://localhost:7080/PROJECT_FOLDER/Travel/details.php?country=" + selectedCode;
			}

			$(window).load(function() {
					$('.flexslider').flexslider({
						controlNav: false
					});
			});
		</script>
</body>
</html>

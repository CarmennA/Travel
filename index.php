<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Travel - Home</title>

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
			include 'common.php';
			include 'connectionToDatabase.php';

			$cookie_val = $_COOKIE['user'];
      $vals = explode('_', $cookie_val);

			$conn = CreateConnectionToDatabase();
			$sql = 'SELECT c.Name, c.Code FROM countries c
							JOIN countries_filters cf ON cf.CountryCode = c.Code
							JOIN users_filters uf ON uf.FilterId = cf.FilterId
							WHERE uf.UserId = :userId
							GROUP BY c.Name, c.Code
							ORDER BY COUNT(*) DESC';
			$query = $conn->prepare($sql);
      $query->bindParam(':userId', $vals[1]);
      $query->execute();

      $results = [];
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          array_push($results, $row);
      }
      $conn = null;

			$left = 3 - count($results);

			if ($left > 0) {
					$usedIds = "(";
					$i = 0;
					foreach ($results as $country) {
							if ($i > 0) {
									$usedIds = $usedIds . ", ";
							}
							$usedIds = $usedIds . "'" . $country['Code'] . "'";
							$i++;
					}
					$usedIds = $usedIds . ")";

					$conn = CreateConnectionToDatabase();
					$sql = "SELECT c.Name, c.Code 
									FROM countries c 
									JOIN searches s ON s.CountryCode = c.Code";

					if ($left < 3) {
							$sql = $sql . "
									WHERE c.Code NOT IN " . $usedIds;
					}
									
					$sql = $sql . "
									ORDER BY s.Searches DESC, s.Order ASC 
									LIMIT :left";

					$query = $conn->prepare($sql);
					$query->bindParam(':left', $left, PDO::PARAM_INT);
					$query->execute();
					while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
							array_push($results, $row);
					}
					$conn = null;
			}

		?>

	<section class="container travel-home-section-1" style="margin-top: 100px; z-index: 0;" id="more">
		<div class="section-margin-top">
			<div class="row">
				<div class="travel-section-header">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="travel-section-title">Recommended locations</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
				</div>
			</div>
      <div class="row">
				<?php foreach($results as $country): ?>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="travel-home-box-1 travel-home-box-1-2 travel-home-box-1-right">
							<img src="<?php echo image_exists("img/Countries/" . $country['Code'] . ".jpg"); ?>" alt="image" class="img-responsive" style="height: 347px; width: 347px;">
							<a href="details.php?country=<?php echo $country['Code']; ?>">
								<div class="travel-red-gradient-bg travel-city-price-container">
									<span><?php echo $country['Name']; ?></span>
								</div>
							</a>
						</div>
  				</div>
				<?php endforeach; ?>
  		</div>
		</div>
	</section>

	<section class="travel-white-bg section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="travel-section-header section-margin-top">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="travel-section-title">Most Popular Cities</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
				</div>
				<div class="col-lg-6">
					<div class="travel-home-box-3">
						<div class="travel-home-box-3-img-container">
							<img src="img/index-07.jpg" alt="image" class="img-responsive">
						</div>
						<div class="travel-home-box-3-info">
							<p class="travel-home-box-3-description">Located at the mouth of the Hudson River in southeastern New York state, New York is one of the world's great cities. It is unrivaled in the diversity of its neighborhoods...</p>
					        <div class="travel-home-box-2-container">
							<a class="travel-home-box-2-link"><i class="fa fa-heart travel-home-box-2-icon border-right"></i></a>
							<span class="travel-home-box-2-description box-3">New York</span>
							<a class="travel-home-box-2-link"><i class="fa fa-edit travel-home-box-2-icon border-left"></i></a>
						</div>
						</div>
					</div>
			     </div>
			     <div class="col-lg-6">
			        <div class="travel-home-box-3">
						<div class="travel-home-box-3-img-container">
							<img src="img/index-08.jpg" alt="image" class="img-responsive">
						</div>
						<div class="travel-home-box-3-info">
							<p class="travel-home-box-3-description">Paris is the city of love, inspiration, art and fashion. The night scene, the Eiffel tower and the warm atmosphere will make you feel directly at home...</p>
					        <div class="travel-home-box-2-container">
							<a class="travel-home-box-2-link"><i class="fa fa-heart travel-home-box-2-icon border-right"></i></a>
							<span class="travel-home-box-2-description box-3">Paris</span>
							<a class="travel-home-box-2-link"><i class="fa fa-edit travel-home-box-2-icon border-left"></i></a>
						</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
				    <div class="travel-home-box-3">
						<div class="travel-home-box-3-img-container">
							<img src="img/index-09.jpg" alt="image" class="img-responsive">
						</div>
						<div class="travel-home-box-3-info">
							<p class="travel-home-box-3-description">London is the largest city in Europe and located astride the famous river of Thames. London is considered as a safe tourist destination, visited by millions of people annually...</p>
					        <div class="travel-home-box-2-container">
							<a class="travel-home-box-2-link"><i class="fa fa-heart travel-home-box-2-icon border-right"></i></a>
							<span class="travel-home-box-2-description box-3">London</span>
							<a class="travel-home-box-2-link"><i class="fa fa-edit travel-home-box-2-icon border-left"></i></a>
						</div>
						</div>
					</div>
			    </div>
			    <div class="col-lg-6">
			        <div class="travel-home-box-3">
						<div class="travel-home-box-3-img-container">
							<img src="img/index-10.jpg" alt="image" class="img-responsive">
						</div>
						<div class="travel-home-box-3-info">
							<p class="travel-home-box-3-description">Greater Tokyo is the world's most populous metropolitan area and is the center of Japanese culture, finance, and government - a real bustling cosmopolitan city...</p>
					        <div class="travel-home-box-2-container">
							<a class="travel-home-box-2-link"><i class="fa fa-heart travel-home-box-2-icon border-right"></i></a>
							<span class="travel-home-box-2-description box-3">Tokio</span>
							<a class="travel-home-box-2-link"><i class="fa fa-edit travel-home-box-2-icon border-left"></i></a>
						</div>
						</div>
					</div>
			   	</div>
			</div>
		</div>
	</section>
	<?php
    include('footer.php');
  ?>

	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>      		<!-- jQuery -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>					<!-- bootstrap js -->
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
  <script type="text/javascript" src="js/travel-script.js"></script>

	<script type="text/javascript" src="js/http-helper.js"></script>
	<script type="text/javascript" src="js/search.js"></script>

	<script>

		// Load Flexslider when everything is loaded.
		$(window).load(function() {
      //	For images only
		    $('.flexslider').flexslider({
			    controlNav: false
		    });
	  	});
	</script>
 </body>
 </html>

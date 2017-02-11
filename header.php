<?php
	function set_profile_name() {
		if(!isset($_COOKIE['user'])) {
            echo 'Profile';
        } else {
            $cookie_val = $_COOKIE['user'];
            $vals = explode('_', $cookie_val);
			echo $vals[0];
		}
	}

	function endsWith($haystack, $needle)
	{
	    $length = strlen($needle);
	    if ($length == 0) {
	        return true;
	    }

	    return (substr($haystack, -$length) === $needle);
	}

	function set_active($page)
	{
		// echo $_SERVER['PHP_SELF'];
		if (endsWith($_SERVER['PHP_SELF'], $page))
		{
			echo 'class="active"';
		}
	}
?>

<!-- Header -->
<div class="travel-header">
	<div class="container">
  		<div class="row">
  			<div class="col-lg-6 col-md-4 col-sm-3 travel-site-name-container">
  				<a href="index.php" class="travel-site-name">Travel</a>
  			</div>
  			<div class="col-lg-6 col-md-8 col-sm-9">
  				<div class="mobile-menu-icon">
					<i class="fa fa-bars"></i>
				</div>
  				<nav class="travel-nav">
					<ul>
						<li><a href="index.php" <?php set_active('index.php'); ?>>Home</a></li>
						<li><a href="popular.php" <?php set_active('popular.php'); ?>>Most Popular</a></li>
						<li><a href="profile.php" <?php set_active('profile.php'); ?>><?php set_profile_name(); ?></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
 </div>

<!-- Slider -->
<section class="travel-banner">
	<div class="flexslider flexslider-banner">
		<ul class="slides">
			<li>
				<div class="travel-banner-inner">
					<h1 class="travel-banner-title">Find <span class="travel-yellow-text">The Best</span> Place</h1>
					<p class="travel-banner-subtitle">For Your Holidays</p>
				</div>
				<img src="img/banner-1.jpg" alt="Image" />
			</li>
			<li>
				<div class="travel-banner-inner">
					<h1 class="travel-banner-title">Travel <span class="travel-yellow-text">to exciting</span> locations</h1>
					<p class="travel-banner-subtitle">all around the world</p>
				</div>
				<img src="img/banner-2.jpg" alt="Image" />
			</li>
			<li>
				<div class="travel-banner-inner">
					<h1 class="travel-banner-title">Discover <span class="travel-yellow-text">an unique</span> opportunity</h1>
					<p class="travel-banner-subtitle">to expand your boundaries</p>
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

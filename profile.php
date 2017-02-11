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
  <link rel="stylesheet" type="text/css" href="css/profile.css">
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

		include 'connectionToDatabase.php';

        if(!isset($_COOKIE['user'])) {
            header('Location:login.php');
        }

        $cookie_val = $_COOKIE['user'];
        $vals = explode('_', $cookie_val);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $conn = CreateConnectionToDatabase();
            $sql = 'DELETE FROM users_filters WHERE UserId = :userId;
                    INSERT INTO users_filters(UserId, FilterId) SELECT :userId, Id FROM filters WHERE Id IN ('.implode(',', $_POST['check_list']).')';

            $query = $conn->prepare($sql);
            $query->bindParam(':userId', $vals[1]);
            $query->execute();
            $conn = null;
        }

        $conn = CreateConnectionToDatabase();
        $sql = 'SELECT f.Id, f.Name, f.Description, (CASE WHEN EXISTS(SELECT NULL FROM users_filters uf WHERE uf.FilterId = f.Id AND uf.UserId = :userId) THEN 1 ELSE 0 END) AS Selected FROM filters f;';
        $query = $conn->prepare($sql);
        $query->bindParam(':userId', $vals[1]);
        $query->execute();

        $results = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            array_push($results, $row);
        }
        $conn = null;
	?>

    <form class="filter-form" action="profile.php" method="post">
        <div class="col-lg-12 col-mg-12 col-sm-12">
            <?php foreach($results as $filter): ?>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <label class="form-label" style="margin-right: 0px !important;" for="filter_<?php echo $filter['Id']; ?>"><?php echo $filter['Name']; ?></label>
                    <input class="right-separator" id="filter_<?php echo $filter['Id']; ?>" name="check_list[]" type="checkbox" <?php if ($filter['Selected'] == 1) echo 'checked'; ?> value="<?php echo $filter['Id']; ?>" />
                </div>
            <?php endforeach; ?>
        </div>
            <input class="form-button-second" style="margin-left: 20px;" type="submit" value="Update" />
    </form>

    <?php
        include('footer.php');
    ?>

	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>

	<script type="text/javascript" src="js/travel-script.js"></script>

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

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
  <link href="css/flexslider.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">

  </head>

  <body class="tm-gray-bg">
    <?php
      include('header.php');
    ?>

	<?php

		include 'connectionToDatabase.php';

		$username = '';

		function modify_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		function login($name, $pass) {
			$conn = CreateConnectionToDatabase();
			$sql = "SELECT Id FROM users WHERE Username = :username AND Password = :password";
			$query = $conn->prepare($sql);
			$query->bindParam(':username', $name);
			$query->bindParam(':password', $pass);
			try {
				$query->execute();
				if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
					return $row['Id'];
				}
			} catch (PDOException $e) {
				$conn = null;
				die('Query failed: ' . $e->getMessage());
			}
			$conn = null;
			return -1;
		}

		$errors = [];

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$username = modify_input($_POST['username']);
			$password = modify_input($_POST['password']);

			if (strlen($username) < 4) {
				array_push($errors, 'Username must be at least 4 symbols.');
			}

			if (strlen($username) > 50) {
				array_push($errors, 'Username must be no more than 50 symbols.');
			}
			
			$id = login($username, $password);
			if ($id == -1) {
				array_push($errors, "Username already used.");
			}

			if (count($errors) > 0) {
				echo '<ul style="color: red">';
				foreach ($errors as $err) {
					echo '<li>' . $err . '</li>';
				}
				echo '</ul>';
			} else {

				echo $id;

				$cookie_name = "user";
				$cookie_value = $username . '_' . $id;
				setcookie($cookie_name, $cookie_value, time() + (86400), "/"); // 86400 = 1 day
				
				//header('Location:index.php');
			}
		}

	?>

	<form style="margin: 150px auto; width: 50%;" method="post" action="login.php">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" value="<?php echo $username; ?>" />
		<br/>
		<br/>
		<label for="password">Password:</label>
		<input type="password" id="password" />
		<input type="hidden" name="password" id="passwordEnc"/>
    	<input style="display: block;" type="submit" name="submitType" value="Login" onclick="encryptPass();"/>
	</form>

	<footer class="tm-black-bg">
		<div class="container">
			<div class="row">
				<p class="tm-copyright-text">Copyright &copy; 2017</p>
			</div>
		</div>
	</footer>

	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>

	<script type="text/javascript" src="js/templatemo-script.js"></script>

	<script type="text/javascript" src="js/http-helper.js"></script>
	<script type="text/javascript" src="js/search.js"></script>
	<script type="text/javascript" src="js/sha3.js"></script>

	<script>
		$(window).load(function() {
				$('.flexslider').flexslider({
					controlNav: false
				});
		});

		function encryptPass() {
			var passField = document.getElementById("password");
			var encPassField = document.getElementById("passwordEnc");
			encPassField.value = CryptoJS.SHA3(passField.value, { outputLength: 512 });
			return true; // submit form
		}
	</script>
</body>
</html>

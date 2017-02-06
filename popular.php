<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Popular Destinations</title>
	<style>
	.error {color: #FF0000;}
	.table-electives {width: 30%;}
	.table-electives-th {text-align: left;}
	</style>

</head>

<body>

	<?php
	include 'connectionToDatabase.php';
	include 'restConsumer.php';

	$country = "";

	if ($_SERVER["REQUEST_METHOD"] == "GET") {

		$connection = CreateConnectionToDatabase();
		if (array_key_exists('country', $_GET))
		{
			$country = $_GET['country'];
		}

		if (empty($country))
		{
			echo "<div>Error.</div>";
		}
		else{
			$sql = "SELECT `Code` FROM `travel_db`.`countries` WHERE Name = {$country}";
			$query = $connection->query($sql) or die("failed!");


			if ($row = $query->fetch(PDO::FETCH_ASSOC))
			{
				$countryCode = $row['Code'];

				$result = CallAPI("GET", "https://restcountries.eu/rest/v1/alpha/{$countryCode}");
			  echo $result["capital"];

				// $result = "<div>List with the elective disciplines with lecturer {$teacher} </div>";
				// $result .= "<table class='table-electives'><tr>";
				// $result .= "<th class='table-electives-th'>Title</th><th>Description</th></tr>";
				// echo $result;
				// do
				// {
				// 	$subjectName = $row['title'];
				// 	$description = $row['description'];
				//
				// 	echo "<tr>";
				// 		echo "<td>$subjectName</td>";
				// 		echo "<td>$description</td>";
				// 	echo "</tr>";
				// }while($row= $query->fetch(PDO::FETCH_ASSOC));
				// echo "</table>";

			}
			else
			{
				echo "<div>Error. Doesn't exist such Country!</div>";
			}

			$connection = null;
		}
	}

	function modify_input($input) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);

		return $input;
	}
	?>

</body>
</html>

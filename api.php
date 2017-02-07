<?php

include 'connectionToDatabase.php';

function get_all_countries()
{
	$connection = CreateConnectionToDatabase();

	$sql = "SELECT `Name`, `Code` FROM `travel_db`.`countries`";
	$query = $connection->query($sql) or die("failed!");
	
	$results = array();
	
	while ($row = $query->fetch(PDO::FETCH_ASSOC))
	{
		array_push($results, array('name' => $row['Name'], 'code' => $row['Code']));
	}
	return $results;
}

$possible_url = array("get_all_countries");

$value = "An error has occurred";

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
{
	switch ($_GET["action"])
    {
		case "get_all_countries":
			$value = get_all_countries();
			break;
    }
}

exit(json_encode($value));

?>
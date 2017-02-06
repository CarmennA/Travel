<?php
	function CreateConnectionToDatabase()
	{
		$servername = "eu-cdbr-azure-north-e.cloudapp.net:3306";
		$username = "bf9a15681bbb0b";
		$password = "26c8b49a";
		$dbname = "travel_db";
	
		$conn = null;
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		} catch (PDOException $e){
			die('Connection failed: ' . $e->getMessage());
		}
		return $conn;
	}
?>
<?php 
	$host="localhost";
	$database="generated_pin";
	$user="root";
	$password="";

	//global PATH_TO_FUNCTIONS;
	//define("PATH_TO_FUNCTIONS", "includes/functions.php");
	//connect
	$connect= new mysqli($host, $user, $password, $database) or die("could not establish database connection". $connect->connect_error);
	session_start();

 ?>
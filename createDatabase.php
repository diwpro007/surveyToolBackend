<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Create database
	$sql = "CREATE DATABASE SurveyDatabase";
	if (mysqli_query($conn, $sql)) {
	    echo "Database created successfully";
	} else {
	    echo "Error creating database: " . mysqli_error($conn);
	}

	mysqli_close($conn);


	$conn = mysqli_connect($servername , $username , $password , 'SurveyDatabase');

	if(!$conn)
		die("Connection failed".mysqli_connect_error());

	$sql = "CREATE TABLE SURVEY (
		Survey_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Survey_Name VARCHAR(50) NOT NULL
		)";

	if(mysqli_query($conn , $sql)){
		echo "<br/>SURVEY table successfully created in the database";
	}
	else
		echo"<br/>SURVEY table creation error ".mysqli_error($conn);

	$sql = "CREATE TABLE QUESTIONS (
			Survey_ID INT(6) UNSIGNED,
			Question_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			Question_Name VARCHAR(200) NOT NULL,
			Ans_type VARCHAR(1) NOT NULL,
			Ans_IP_type VARCHAR(1) NOT NULL,
			MANDATORY VARCHAR(1) NOT NULL
		)";
	

	if(mysqli_query($conn , $sql)){
		echo "<br/>QUESTIONS table successfully created in the database";
	}
	else
		echo"<br/>QUESTIONS table creation error ".mysqli_error($conn);


	$sql = "CREATE TABLE OPTIONS (
			Question_ID INT(6) UNSIGNED,
			Option_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			Option_Name VARCHAR(30) NOT NULL
		)";

	
	if(mysqli_query($conn , $sql)){
		echo "<br/>OPTIONS table successfully created in the database";
	}
	else
		echo"<br/>OPTIONS table creation error ".mysqli_error($conn);


	$sql = "CREATE TABLE ANSWER (
			Question_ID INT(6) UNSIGNED,
			Answer_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			IS_SINGLE VARCHAR(1) NOT NULL,
			Answer_Val VARCHAR(100),
			Answer_Option VARCHAR(1)
		)";

	if(mysqli_query($conn , $sql)){
		echo "<br/>ANSWER table successfully created in the database";
	}
	else
		echo"<br/>ANSWER table creation error ".mysqli_error($conn);

	mysqli_close($conn);
?>
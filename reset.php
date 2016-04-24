<?php
    
    $conn = mysqli_connect("localhost" , "root" , "" , "SurveyDatabase") or die();

    $query = "DROP TABLE answer , options, survey , questions";
    
    if(!mysqli_query($conn , $query))
        die("Error");
    
    
	$dir = "uploads";

	foreach(scandir($dir) as $files){
		if('.' === $files || '..' === $files) continue;
		unlink("$dir/$files");
	}

	rmdir($dir);
    mkdir($dir);
    require_once "resetCounter.php";
    require_once "createDatabase.php";
    
    
?>
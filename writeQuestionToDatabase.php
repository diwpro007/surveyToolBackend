<?php
	
	require_once 'Excel/reader.php';

	$conn = mysqli_connect("localhost" , "root", "" , "SurveyDatabase");
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}


	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('CP1251');

	$file = fopen("Counter/counter.txt" , "r");
	$cnt = intval(fgets($file));
	fclose($file);

	$fileToRetrieve = "upload".$cnt.".xls";
    $cntX = $cnt + 1;
    
	$file = fopen("Counter/counter.txt" , "w");
	fwrite($file , $cntX);
	fclose($file);

	$data->read('uploads/'.$fileToRetrieve);

	$rows =  $data->sheets[0]['numRows']; 
	$cols =  $data->sheets[0]['numCols'];
	

	$file = fopen("Counter/surveyCounter.txt" , "r");
	$surveyCount = intval(fgets($file));
	fclose($file);

	$file = fopen("Counter/questionCounter.txt" , "r");
	$questionCount = intval(fgets($file));
	fclose($file);

	$file = fopen("Counter/optionCounter.txt" , "r");
	$optionCount = intval(fgets($file));
	fclose($file);

	$surveyName = $_POST["surveyName"];

	$query = "INSERT INTO SURVEY(Survey_ID , Survey_Name)
	VALUES (null,'".$surveyName."')";

	if(!mysqli_query($conn , $query));
		echo mysqli_error($conn) . '<br/>';


	for($i = 2 ; $i <= $rows ; $i ++){
		$var = array();
		$var['Survey_Name'] = $surveyName;
		$var['Answer_Type'] = $data->sheets[0]['cells'][$i][1];

		//echo $data->sheets[0]['cells'][$i][1];

		$var['Answer_IP_Type'] = $data->sheets[0]['cells'][$i][2];
		$var['Mandatory'] = $data->sheets[0]['cells'][$i][3];
		$var['Question_Name'] = $data->sheets[0]['cells'][$i][4];
		$opCount = 0;

		if($var['Answer_IP_Type'] == 'm'){
			while(isset($data->sheets[0]['cells'][$i][5 + $opCount]) && !empty($data->sheets[0]['cells'][$i][5 + $opCount])){

				$var['o'.$opCount] = $data->sheets[0]['cells'][$i][5 + $opCount];
				$opCount ++;

			}

		}
			
//		var_dump($var);
//		echo '<br/><br/>'.$opCount.'<br/><br/>';	

		$query = "INSERT INTO QUESTIONS(Survey_ID , Question_ID , Question_Name , Ans_Type , Ans_IP_Type , Mandatory)
		VALUES ('".($surveyCount + 1)."',null,'".$var['Question_Name']."','".$var['Answer_Type']."','".$var['Answer_IP_Type']."','".$var['Mandatory']."')";

		if(!mysqli_query($conn , $query));
			echo mysqli_error($conn) . '<br/>';


		for($j = 0 ; $j < $opCount ; $j ++){
			$query = "INSERT INTO OPTIONS(Question_ID , Option_ID , Option_Name)
			VALUES ('".($questionCount + 1)."',null,'".$var['o'.$j]."')";
			if(!mysqli_query($conn , $query));
				echo mysqli_error($conn) . '<br/>';

		} 

		$questionCount ++;

	}

	$surveyCount ++;

	$file = fopen("Counter/surveyCounter.txt" , "w");
	fwrite($file , $surveyCount ++);
	fclose($file);

	$file = fopen("Counter/questionCounter.txt" , "w");
	fwrite($file , $questionCount ++);
	fclose($file);

	$file = fopen("Counter/optionCounter.txt" , "w");
	fwrite($file , $optionCount ++);
	fclose($file);

?>
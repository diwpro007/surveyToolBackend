<?php
	
	$conn = mysqli_connect("localhost" , "root" , "" , "surveydatabase") or die();

	$returnSurvey = array();

	if(isset($_GET['surveyNumber']) && !empty($_GET['surveyNumber'])){

		$query = "SELECT * FROM SURVEY WHERE Survey_ID = '".$_GET['surveyNumber']."'";

		$result = mysqli_query($conn , $query);

		$numSurvey = mysqli_num_rows($result);

		$returnSurvey["Survey"] = array();


		for($i = 0 ; $i < $numSurvey ; $i ++){
			$returnSurvey["Survey"]["Name"] = $rows["Survey_Name"];

			$query = "SELECT * FROM QUESTIONS WHERE SurveyID = '".($i + 1)."'";

			$resultQe = mysqli_query($conn , $query);

			$numQuestion = mysqli_num_rows($resultQe);

			$returnSurvey["Survey"]["Questions"] = array();

			for($j = 0 ; $j < $numQuestion ; $j ++){
				$rows = mysqli_fetch_assoc($resultQe);
				$returnSurvey["Survey"]["Questions"][$j]["Question_ID"] = $rows["Question_ID"];			
				$returnSurvey["Survey"]["Questions"][$j]["Question_Name"] = $rows["Question_Name"];
				$returnSurvey["Survey"]["Questions"][$j]["Answer_Type"] = $rows["Ans_type"];
				$returnSurvey["Survey"]["Questions"][$j]["Answer_IP_Type"] = $rows["Ans_IP_type"];
				$returnSurvey["Survey"]["Questions"][$j]["Mandatory"] = $rows["MANDATORY"];

				if($rows["Ans_IP_Type"] == "m"){

					$returnSurvey["Survey"]["Questions"][$j]["Options"] = array();
					$query = "SELECT * FROM OPTIONS WHERE Question_ID = '".$rows["Question_ID"]."'";

					$resultOp = mysqli_query($conn , $query);
					$numOptions = mysqli_num_rows($resultOp);

					for($k = 0 ; $k < $numOptions ; $k ++){
						$rowOp = mysqli_fetch_assoc($resultOp);
						$returnSurvey["Survey"]["Questions"][$j]["Options"][$k] = $rowOp["Option_Name"];
					}
				}
			}

		}

		echo json_encode($returnSurvey);
		mysqli_close($conn);


	}
	else{

		$query = "SELECT * FROM SURVEY";

		$result = mysqli_query($conn , $query);

		$numSurvey = mysqli_num_rows($result);

		//echo $numSurvey;
		$returnSurvey["Survey"] = array();


		for($i = 0 ; $i < $numSurvey ; $i ++){
			$returnSurvey["Survey"][$i] = array();

			$rws = mysqli_fetch_assoc($result);

			$returnSurvey["Survey"][$i]["Name"] = $rws['Survey_Name'];
            $returnSurvey["Survey"][$i]["ID"] = $rws['Survey_ID'];

			$query = "SELECT * FROM QUESTIONS WHERE Survey_ID = ".($i + 1);

			$resultQe = mysqli_query($conn , $query);

			$numQuestion = mysqli_num_rows($resultQe);
			
			$returnSurvey["Survey"][$i]["Questions"] = array();

			for($j = 0 ; $j < $numQuestion ; $j ++){
				$rows = mysqli_fetch_assoc($resultQe);

				$returnSurvey["Survey"][$i]["Questions"][$j] = array();

				$returnSurvey["Survey"][$i]["Questions"][$j]["Question_ID"] = $rows["Question_ID"];			
				$returnSurvey["Survey"][$i]["Questions"][$j]["Question_Name"] = $rows["Question_Name"];
				$returnSurvey["Survey"][$i]["Questions"][$j]["Answer_Type"] = $rows["Ans_type"];
				$returnSurvey["Survey"][$i]["Questions"][$j]["Answer_IP_Type"] = $rows["Ans_IP_type"];
				$returnSurvey["Survey"][$i]["Questions"][$j]["Mandatory"] = $rows["MANDATORY"];

				if($rows["Ans_IP_type"] == "m"){

					$returnSurvey["Survey"][$i]["Questions"][$j]["Options"] = array();
					$query = "SELECT * FROM OPTIONS WHERE Question_ID = '".$rows["Question_ID"]."'";

					$resultOp = mysqli_query($conn , $query);
					$numOptions = mysqli_num_rows($resultOp);

					for($k = 0 ; $k < $numOptions ; $k ++){
						$rowOp = mysqli_fetch_assoc($resultOp);
						$returnSurvey["Survey"][$i]["Questions"][$j]["Options"][$k] = $rowOp["Option_Name"];
					}
				}
			}

		}

		echo json_encode($returnSurvey);
		mysqli_close($conn);


	}

?>
<?php

	if(isset($_POST['response']) && !empty($_POST['response'])){

		$conn = mysqli_connect("localhost" , "root" , "" , "SurveyDatabase") or die();
		$jsonObj = json_decode($_POST['response']);

		$count = count($jsonObj);
		//NUMBER OF SURVEY ANSWERS

		for($i = 0 ; $i < $count ; $i ++){
			$nCount = count($jsonObj[$i]);
			for($j = 0 ; $j < $nCount ; $j ++){

				$question_id = $jsonObj[$i][$j]->questionID;
				$issingle = $jsonObj[$i][$j]->is_single;
				$answer_val = $jsonObj[$i][$j]->answerValue;
				$answer_option = "a";
				
				$query = "INSERT INTO ANSWER(Question_ID , Answer_ID , IS_SINGLE , Answer_Val , Answer_Option) VALUES('".$question_id."' , null , '".$issingle."' , '".$answer_val."' , '".$answer_option."')";
				if(!mysqli_query($conn , $query))
					die("Error");
				else
					echo "Success";
			}
		}
	}
	else{
		
		$string = '[{
					        "question_id": 1,
					        "is_single": "n",
					        "answer_value": "2",
					        "answer_option": "y"
					                },
					    {
					        "question_id": 2,
					        "is_single": "n",
					        "answer_value": "Diwakar",
					        "answer_option": "n"
					                },
					    {
					        "question_id": 3,
					        "is_single": "n",
					        "answer_value": "Diwakar",
					        "answer_option": "n"
					                },
					    {
					        "question_id": 4,
					        "is_single": "n",
					        "answer_value": "Diwakar",
					        "answer_option": "n"
					                }
					]';


		$conn = mysqli_connect("localhost" , "root" , "" , "SurveyDatabase") or die();
		$jsonObj = json_decode($string);

		$count = count($jsonObj);

		for($i = 0 ; $i < $count ; $i ++){
			$question_id = $jsonObj[$i]->question_id;
			$issingle = $jsonObj[$i]->is_single;
			$answer_val = $jsonObj[$i]->answer_value;
			$answer_option = $jsonObj[$i]->answer_option;

			$query = "INSERT INTO ANSWER(Question_ID , Answer_ID , IS_SINGLE , Answer_Val , Answer_Option) VALUES('".$question_id."' , null , '".$issingle."' , '".$answer_val."' , '".$answer_option."')";
			if(!mysqli_query($conn , $query))
				die("Error");
			else
				echo "Success Tero bau";

		}


	}

?>
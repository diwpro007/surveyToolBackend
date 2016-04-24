<?php
	
	if(isset($_GET['survey_no']) && !empty($_GET['survey_no'])){
		$survey_no = $_GET['survey_no'];

		$conn = mysqli_connect("localhost" , "root" , "" , "SurveyDatabase");

		$query = "SELECT Question_ID FROM questions WHERE Survey_ID='".$survey_no."'";

		$result = mysqli_query($conn , $query);

		if(!$result)
			die("Error Q");

		$noQues = mysqli_num_rows($result);
		//echo $noQues;
		$toSend = array();
		
		for($i = 0 ; $i < $noQues ; $i ++){
			
			$toSend[$i] = array();

			$row = mysqli_fetch_assoc($result);
			//echo $row["Question_ID"]."<br/>";
			//echo $row["Question_ID"]."<br/>";
			$query = "SELECT * FROM answer WHERE Question_ID='". $row["Question_ID"] . "'";

			$res = mysqli_query($conn , $query);

			if(!$res)
				die("Error a");


			$nCount = mysqli_num_rows($res);
			//echo $nCount."<br/>";
			for($j = 0 ; $j < $nCount ; $j ++){
				$row = mysqli_fetch_assoc($res);
				$toSend[$i][$j] = array();
				$toSend[$i][$j]["answer_id"] = $row["Answer_ID"];
				$toSend[$i][$j]["question_id"] = $row["Question_ID"];
				$toSend[$i][$j]["is_single"] = $row["IS_SINGLE"];
				$toSend[$i][$j]["answer_val"] = $row["Answer_Val"];
				$toSend[$i][$j]["answer_option"] = $row["Answer_Option"];
			}
		}

		echo json_encode($toSend);

	}

?>
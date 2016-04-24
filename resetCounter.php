<?php

    $file = fopen("Counter/counter.txt" , "w");
    fwrite($file , "0");
    fclose($file);


    $file = fopen("Counter/answerCounter.txt" , "w");
    fwrite($file , "0");
    fclose($file);


    
    $file = fopen("Counter/questionCounter.txt" , "w");
    fwrite($file , "0");
    fclose($file);


    $file = fopen("Counter/surveyCounter.txt" , "w");
    fwrite($file , "0");
    fclose($file);
?>
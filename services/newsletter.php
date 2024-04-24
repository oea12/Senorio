<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once ('utils/dbFunctions.php');
    include_once ('utils/parametersFunctions.php');
    $newsletterData = getNewsletterParams();
    if($newsletterData->status->error=="0"){
        addNewsletterInfo($newsletterData->email);
        $status->error = "0";
        $status->message = "Gracias por registrarte a nuestro newsletter.";
        echo json_encode($status);
    } else {
        echo json_encode($newsletterData->status);    
    }
?>
<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    include_once ('utils/dbFunctions.php');
    include_once ('utils/parametersFunctions.php');
    $contactData = getContactParams();
    if($contactData->status->error=="0"){
        addContactInfo($contactData->fullname, $contactData->email, $contactData->phone, $contactData->message);
        $status->error = "0";
        $status->message = "Gracias por compartirnos tus datos, en breve nos pondremos en contacto contigo.";
        echo json_encode($status);
    } else {
        echo json_encode($contactData->status);    
    }
?>
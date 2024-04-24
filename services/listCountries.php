<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ('utils/fillDataFunctions.php');
    include_once ('utils/validateFunctions.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $language = $_GET["language"];
        $validStatus = validString($language, 128);
        if (empty($language) || $validStatus != NULL) {
            $language = "mx";                           
        }
    
        $countries = getStoreCountries($language);
        
        echo json_encode($countries);
    } else {
        $status = new stdClass();
        $status->error = "405";
        $status->message = "No se recibieron los parámetros";
        echo json_encode($status->message);
    }
?>
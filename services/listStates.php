<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once ('utils/dbFunctions.php');
    include_once ('utils/validateFunctions.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $language = $_GET["language"];
        $validStatus = validString($language, 128);
        if (empty($language) || $validStatus != NULL) {
            $language = "es";                           
        }
    
        $states = getStoreStates($language);
        
        echo json_encode($states);
    } else {
        $status = new stdClass();
        $status->error = "405";
        $status->message = "No se recibieron los parámetros";
        echo json_encode($status->message);
    }
?>
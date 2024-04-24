<?php

    include_once ('validateFunctions.php');

    function getContactParams(){
        $contactData = new stdClass();
        $validationInfo = new stdClass();
        $status = new stdClass();
        $fieldProblems = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $status->error = "0";
            $status->message = "Gracias por compartirnos tus datos, en breve nos pondremos en contacto contigo.";
            $fullname = $_POST["fullname"];
            if (empty($fullname)) {
                $fieldErrors['fullname'] = "Recuerda que debes ingresar tu nombre completo.";
                $fieldProblems = true;
            } else {
                $validStatus = validString($fullname,256);
                if ($validStatus != NULL) {
                    $fieldErrors['fullname'] = $validStatus;
                    $fieldProblems = true;
                    $fullname = NULL;
                }
            }
            $email = $_POST["email"];
            if (empty($email)) {
                $fieldErrors['email'] = "Recuerda que debes ingresar tu correo electrónico.";
                $fieldProblems = true;
            } else {
                $validStatus = validEmail($email);
                if ($validStatus != NULL) {
                    $fieldErrors['email'] = $validStatus;
                    $fieldProblems = true;
                    $email = NULL;
                }
            }
            $phone = $_POST["phone"];
            if (empty($phone)) {
                $fieldErrors['phone'] = "Recuerda que debes ingresar tu teléfono.";
                $fieldProblems = true;
            } else {
                $validStatus = validPhone($phone);
                if ($validStatus != NULL) {
                    $fieldErrors['phone'] = $validStatus;
                    $fieldProblems = true;
                    $phone = NULL;
                }
            }
            $message = $_POST["message"];
            if (empty($message)) {
                $fieldErrors['message'] = "Recuerda que debes ingresar tu correo electrónico.";
                $fieldProblems = true;
            } else {
                $validStatus = validString($message,1024);
                if ($validStatus != NULL) {
                    $fieldErrors['message'] = $validStatus;
                    $fieldProblems = true;
                    $message = NULL;
                }
            }
            if ($fieldProblems){
                $status->error = "68";
                $status->message = "Errores en los parámetros";
                $status->fieldErrors = $fieldErrors;
                $contactData->status=$status;
            } else {
                $contactData->fullname=$fullname;
                $contactData->email=$email;
                $contactData->phone=$phone;
                $contactData->message=$message;
                $contactData->status=$status;
            }
        } else {
            $status->error = "405";
            $status->message = "No se recibieron los parámetros por POST";
            $status->fieldErrors = [];
            $contactData->status=$status;
        }
        return $contactData;
    }

    function getNewsletterParams(){
        $newsletterData = new stdClass();
        $validationInfo = new stdClass();
        $status = new stdClass();
        $fieldProblems = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $status->error = "0";
            $status->message = "Gracias por compartirnos tus datos, ya estás inscrito a nuestro Newsletter.";
            $email = $_POST["email"];
            if (empty($email)) {
                $fieldErrors['email'] = "Recuerda que debes ingresar tu correo electrónico.";
                $fieldProblems = true;
            } else {
                $validStatus = validEmail($email);
                if ($validStatus != NULL) {
                    $fieldErrors['email'] = $validStatus;
                    $fieldProblems = true;
                    $email = NULL;
                }
            }
            if ($fieldProblems){
                $status->error = "68";
                $status->message = "Errores en los parámetros";
                $status->fieldErrors = $fieldErrors;
                $newsletterData->status=$status;
            } else {
                $newsletterData->email=$email;
                $newsletterData->status=$status;
            }
        } else {
            $status->error = "405";
            $status->message = "No se recibieron los parámetros por POST";
            $status->fieldErrors = [];
            $newsletterData->status=$status;
        }
        return $newsletterData;
    }

    function getListStoresParams(){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST["name"];
            $validStatus = validString($name, 128);
            if (empty($name) || $validStatus != NULL) {
                $name = NULL;                           
            }
            $state = $_POST["state"];
            $validStatus = validString($state, 128);
            if (empty($state) || $validStatus != NULL) {
                $state = NULL;                           
            }
            $city = $_POST["city"];
            $validStatus = validString($city, 128);
            if (empty($city) || $validStatus != NULL) {
                $city = NULL;                           
            }
            $lattitude = $_POST["lattitude"];
            $validStatus = validString($lattitude, 32);
            if (empty($lattitude) || $validStatus != NULL) {
                $lattitude = NULL;                           
            }
            $longitude = $_POST["longitude"];
            $validStatus = validString($longitude, 32);
            if (empty($longitude) || $validStatus != NULL) {
                $longitude = NULL;                           
            }
            $joven = $_POST["joven"];
            $validStatus = validString($joven, 2);
            if (empty($joven) || $validStatus != NULL) {
                $joven = NULL;                           
            }
            $reposado = $_POST["reposado"];
            $validStatus = validString($reposado, 2);
            if (empty($reposado) || $validStatus != NULL) {
                $reposado = NULL;                           
            }
            $añejo = $_POST["añejo"];
            $validStatus = validString($añejo, 2);
            if (empty($añejo) || $validStatus != NULL) {
                $añejo = NULL;                           
            }
            $language = $_POST["language"];
            $validStatus = validString($language, 2);
            if (empty($language) || $validStatus != NULL) {
                $language = "es";                           
            }
	    $resultType = $_POST["resultType"];
            $validStatus = validString($resultType, 16);
            if (empty($resultType) || $validStatus != NULL) {
                $resultType = NULL;                           
            }
            $page = $_POST["page"];
            $validStatus = validString($page, 2);
            if (empty($page) || $validStatus != NULL) {
                $page = NULL;                           
            }
        }
        $filter = new stdClass();
        $filter->name = $name;
        $filter->state = $state;
        $filter->city = $city;
        $filter->lattitude = $lattitude;
        $filter->longitude = $longitude;
        $filter->joven = $joven;
        $filter->reposado = $reposado;
        $filter->añejo = $añejo;
        $filter->language = $language;
	$filter->resultType = $resultType;
        $filter->page = $page;
        return $filter;
    }
?>
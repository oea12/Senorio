<?php

    date_default_timezone_set('America/Mexico_City');



    include_once("fillDataFunctions.php");



    function dbConnection(){



        $server = "localhost";



        $user = "senorio";



        $password = "hRIool5KirAg}PD#R70>IJ8?j|5KmbOG";



        $db = "senoriodb";



        $mysqli = mysqli_connect($server, $user, $password, $db);



        if (mysqli_connect_errno()) {



            echo "Error: MySQL connection fail due to: \n";



            echo "Errno: " . mysqli_connect_errno() . "\n";



            echo "ErrorMessage: " . mysqli_connect_error() . "\n";



            exit;



        }



        mysqli_query($mysqli, "USE my_database");



        mysqli_set_charset($mysqli,'utf8');



        mysqli_query($mysqli, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");



        return $mysqli;



   }



   function addContactInfo($fullname, $email, $phone, $message){

        $mysqli = dbConnection();

        $stmt = $mysqli->prepare("INSERT INTO t_contact (fullname, email, phone, message) VALUES (?, ?, ?, ?)");

        $stmt->bind_param("ssss", $fullname, $email, $phone, $message);

        $stmt->execute();

        $stmt->close();

        $mysqli->close();

    }



    function addNewsletterInfo($email){

        $mysqli = dbConnection();

        $stmt = $mysqli->prepare("INSERT INTO t_newsletter (email) VALUES (?)");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->close();

        $mysqli->close();

    }



    function getStoreStates($language){

        $mysqli = dbConnection();

        $sqlQuery = "SELECT distinct(state) from t_stores where language = ? order by state";

        $stmt = $mysqli->prepare($sqlQuery);

        $stmt->bind_param("s", $language);

        $stmt->execute();

        $stmt->bind_result($state);

        $states = [];

        while ($stmt->fetch()) {

          array_push($states, $state);

        }

        return $states;

    }



    function getStoreCities($language, $state){

        $mysqli = dbConnection();

        $sqlQuery = "SELECT distinct(city) from t_stores where language = ? and state = ? order by city";

        $stmt = $mysqli->prepare($sqlQuery);

        $stmt->bind_param("ss", $language, $state);

        $stmt->execute();

        $stmt->bind_result($city);

        $cities = [];

        while ($stmt->fetch()) {

             array_push($cities, $city);

        }

        return $cities;

   }

   function searchStores($sqlQuery){
          $mysqli = dbConnection();
          $stmt = $mysqli->prepare($sqlQuery);
          $stmt->execute();
          $stmt->bind_result($name, $address, $lattitude, $longitude, $resultType, $joven, $reposado, $añejo, $distance);
          $stores = [];
          while ($stmt->fetch()) {
            $store = getStoreBasicData($name, $address, $lattitude, $longitude, $resultType, $joven, $reposado, $añejo, $distance);
            array_push($stores, $store);
          }
          return $stores;
    }


    function countStores($countQuery){

        $mysqli = dbConnection();

        $stmt = $mysqli->prepare($countQuery);

        $stmt->execute();

	$stmt->bind_result($storesCount);

	$stmt->fetch();

	$stmt->close();
	
	$mysqli->close();

        return $storesCount;

    }

?>
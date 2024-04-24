<?php

    function getStoreBasicData($name, $address, $lattitude, $longitude, $resultType, $joven, $reposado, $añejo, $distance){
        $store = new stdClass();
        $store->name = $name;
        $store->address = $address;
        $store->location = $lattitude.",".$longitude;
        $store->resultType = $resultType;
        $store->joven = $joven;
        $store->añejo = $añejo;
        $store->reposado = $reposado;
        return $store;
    }

    function getStoreCountries($language){
        if ($language == "en"){
            $countryOptions = array(array("mx","Mexico"),array("us","United States"),array("pa","Panama"),array("cr","Costa Rica"),array("sv","El Salvador"));
        } else {
            $countryOptions = array(array("mx","México"),array("us","Estados Unidos"),array("pa","Panamá"),array("cr","Costa Rica"),array("sv","El Salvador"));
        }
        return $countryOptions;      
    }
?>
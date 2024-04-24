<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once ('utils/dbFunctions.php');
    include_once ('utils/parametersFunctions.php');
    include_once ('utils/filterFunctions.php');

    $filter = getListStoresParams();
    $filterQueries = getSearchStoresQuery($filter);
    $searchData = new stdClass();
    //echo "searchQuery ->".$filterQueries->searchQuery."<br/><br/>";
    //echo "countQuery ->".$filterQueries->countQuery."<br/><br/>";
    $storeList = searchStores($filterQueries->searchQuery);
    $searchData->storeList = $storeList;
    $storesCount = countStores($filterQueries->countQuery);
    $pages = ceil($storesCount/12);
    $searchData->stores = $storesCount;
    $searchData->pages = $pages;
    echo json_encode($searchData);
?>
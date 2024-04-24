<?php
    function getSearchStoresQuery($filter){
        $countQuery = "SELECT count(name) as storesCount FROM t_stores WHERE status = '1'";
        $searchQuery = "SELECT name, address, lattitude, longitude, store_type, joven, añejo, reposado, 0 as distance FROM t_stores WHERE status = '1'";
        if ($filter->name != NULL){
            $searchQuery = $searchQuery." and name like '%".$filter->name."%'";
            $countQuery = $countQuery." and name like '%".$filter->name."%'";
        }
        if ($filter->state != NULL){
            $searchQuery = $searchQuery." and state = '".$filter->state."'";
            $countQuery = $countQuery." and state = '".$filter->state."'";
        }
        if ($filter->city != NULL){
            $searchQuery = $searchQuery." and city = '".$filter->city."'";
            $countQuery = $countQuery." and city = '".$filter->city."'";
        }
        if ($filter->joven != NULL){
            $searchQuery = $searchQuery." and joven = '1'";
            $countQuery = $countQuery." and joven = '1'";
        }
        if ($filter->añejo != NULL){
            $searchQuery = $searchQuery." and añejo = '1'";
            $countQuery = $countQuery." and añejo = '1'";
        }
        if ($filter->reposado != NULL){
            $searchQuery = $searchQuery." and reposado = '1'";
            $countQuery = $countQuery." and reposado = '1'";
        }
        if ($filter->language != NULL){
            $searchQuery = $searchQuery." and language = '".$filter->language."'";
            $distanceQuery = " and language = '".$filter->language."'";
            $countQuery = $countQuery." and language = '".$filter->language."'";
        }
        if ($filter->resultType != NULL){
            $searchQuery = $searchQuery." and store_type = '".$filter->resultType."'";
            $distanceQuery = $distanceQuery." and store_type = '".$filter->resultType."'";
            $countQuery = $countQuery." and store_type = '".$filter->resultType."'";
        }
        if ($filter->lattitude != NULL && $filter->longitude != NULL){
            $searchQuery = "SELECT name, address, lattitude, longitude, store_type, joven, reposado, añejo, (6371 * 2 * ASIN(SQRT( POWER(SIN(( ".$filter->lattitude." - lattitude) *  pi()/180 / 2), 2) +COS( ".$filter->lattitude." * pi()/180) * COS(lattitude * pi()/180) * POWER(SIN(( ".$filter->longitude." - longitude) * pi()/180 / 2), 2) ))) as distance  from t_stores WHERE status = '1' ".$distanceQuery." having distance <= 10 order by distance";
            $countQuery = "SELECT count(*) from (SELECT name, (6371 * 2 * ASIN(SQRT( POWER(SIN(( ".$filter->lattitude." - lattitude) *  pi()/180 / 2), 2) +COS( ".$filter->lattitude." * pi()/180) * COS(lattitude * pi()/180) * POWER(SIN(( ".$filter->longitude." - longitude) * pi()/180 / 2), 2) ))) as distance  from t_stores WHERE status = '1' ".$distanceQuery." having distance <= 10) as storesCount";
        }
        if ($filter->page != NULL){
            $recordIndex = ($filter->page-1)*12;
        } else {
            $recordIndex = 0;
        }
        $searchQuery = $searchQuery." limit ".abs($recordIndex).", 12";
        $filterQueries = new stdClass();
        $filterQueries->searchQuery = $searchQuery;
        $filterQueries->countQuery = $countQuery;
        return $filterQueries;
    }
?>
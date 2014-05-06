<?php

$path = dirname(dirname(__FILE__));

require_once $path . '/inc/sql.php';
connect_valid();

$cities = $districts = $legislator_election_districts = $district2city = array();

$data = array(
    'cities' => array(),
);

$result = mysql_query('SELECT * FROM city_list');
while($r = mysql_fetch_assoc($result)) {
    $cities[$r['city_id']] = $r;
}

$result = mysql_query('SELECT * FROM district_list');
while($r = mysql_fetch_assoc($result)) {
    $districts[$r['district_id']] = $r;
    $district2city[$r['district_id']] = $r['city_id'];
}

$result = mysql_query('SELECT * FROM legislator_election_district_list');
while($r = mysql_fetch_assoc($result)) {
    $legislator_election_districts[$r['legislator_election_district_id']] = $r;
}

$result = mysql_query('SELECT * FROM village_list ORDER BY legislator_election_district_id ASC, district_id ASC');
while($r = mysql_fetch_assoc($result)) {
    $cityId = $district2city[$r['district_id']];
    
    if(!isset($data['cities'][$cityId])) {
        $data['cities'][$cityId] = array(
            'name' => $cities[$cityId]['city_name'],
            'type' => $cities[$cityId]['city_type'],
            'legislator_election_districts' => array(),
        );
    }
    
    if(!isset($data['cities'][$cityId]['legislator_election_districts'][$r['legislator_election_district_id']])) {
        if(empty($r['legislator_election_district_id'])) {
            //file_put_contents($path . '/error.list', print_r($r, true), FILE_APPEND);
            continue;
        }
        $data['cities'][$cityId]['legislator_election_districts'][$r['legislator_election_district_id']] = array(
            'name' => $legislator_election_districts[$r['legislator_election_district_id']]['legislator_election_district_name'],
            'sequence' => $legislator_election_districts[$r['legislator_election_district_id']]['sequence'],
            'villages' => array(),
        );
    }
    
    $data['cities'][$cityId]['legislator_election_districts'][$r['legislator_election_district_id']]['villages'][$r['village_id']] = array(
        'name' => $r['village_name'],
        'district' => array(
            'name' => $districts[$r['district_id']]['district_name'],
            'district_id' => $r['district_id'],
        ),
    );
}

ksort($data['cities']);

file_put_contents($path . '/json/data/legislator_election_district_list.json', json_encode($data));
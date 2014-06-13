<?php

$path = dirname(dirname(__FILE__));

require_once $path . '/inc/sql.php';
connect_valid();

$representatives = array();

$result = mysql_query('SELECT * FROM local_representative_list AS R'
        . ' LEFT JOIN local_representative_election_district_list AS D ON D.local_rep_elect_dist_id = R.local_rep_elect_dist_id'
        . ' LEFT JOIN city_list AS C ON C.city_id = R.region_id'
        . ' LEFT JOIN party_list AS PT ON PT.party_id = R.party_id'
        . ' LEFT JOIN position_list AS P ON P.position_id = R.position_id'
        . ' WHERE R.position_id IN (6,7,8)'
        . ' ORDER BY R.position_id ASC');
while($r = mysql_fetch_assoc($result)) {
    $representatives[] = $r;
}

file_put_contents($path . '/json/data/local_representative_list.json', json_encode($representatives));
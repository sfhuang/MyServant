<?php

require_once "inc/sql.php";
connect_valid();

$QUERY_STRING = "SELECT * FROM local_representative_election_district_list AS LREDL, DISTRICT_LIST AS DL WHERE LREDL.REGION_ID=DL.CITY_ID AND LREDL.LOCAL_REP_ELECT_DIST_ID='" . $_GET[ELEDISTID] . "'";
$NO_OF_DATA = MYSQL_NUM_ROWS($RESULT = db_query($QUERY_STRING));
IF ($NO_OF_DATA > 0) {
    ECHO "<SELECT NAME=DISTID>";
    FOR ($SEED = 0; $SEED < $NO_OF_DATA; $SEED++) {
        $DATA = MYSQL_FETCH_ARRAY($RESULT);
        ECHO "<OPTION VALUE='" . $DATA[district_id] . "'>" . $DATA[district_name] . "</OPTION>";
    }
    ECHO "</SELECT>";
}
?>
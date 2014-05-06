<?php

require_once "inc/sql.php";
connect_valid();

IF (isset($_GET['CID']) && $_GET['CID'] != "") {
    $QUERY_STRING = "SELECT * FROM district_list WHERE CITY_ID='" . $_GET['CID'] . "'";
    $NO_OF_DATA = MYSQL_NUM_ROWS($RESULT = db_query($QUERY_STRING));
    ECHO "<OPTION VALUE=0>請選擇</OPTION>";
    FOR ($SEED = 0; $SEED < $NO_OF_DATA; $SEED++) {
        $DATA = MYSQL_FETCH_ARRAY($RESULT);
        ECHO "<OPTION VALUE='" . $DATA['district_id'] . "'>" . $DATA['district_name'] . "</OPTION>";
    }
} ELSE IF (isset($_GET['DISTID']) && $_GET['DISTID'] != "") {
    $QUERY_STRING = "SELECT * FROM village_list WHERE DISTRICT_ID='" . $_GET['DISTID'] . "'";
    $NO_OF_DATA = MYSQL_NUM_ROWS($RESULT = db_query($QUERY_STRING));
    ECHO "<OPTION VALUE=0>請選擇</OPTION>";
    FOR ($SEED = 0; $SEED < $NO_OF_DATA; $SEED++) {
        $DATA = MYSQL_FETCH_ARRAY($RESULT);
        ECHO "<OPTION VALUE='" . $DATA['village_id'] . "'>" . $DATA['village_name'] . "</OPTION>";
    }
}
?>
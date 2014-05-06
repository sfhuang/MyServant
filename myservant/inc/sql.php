<?php

#connect_to_db()	建立資料庫連線
#connect_valid()	檢驗連線是否正常

#----------------------------------------------------------------------------------------------------------------------------
//建立資料庫連線//
#----------------------------------------------------------------------------------------------------------------------------
function connect_to_db()
{
	$USERNAME="";
	$PASSWORD="";
	$DATABASE_NAME="gov_rep_contactbook";
	if($link = mysql_pconnect("localhost", $USERNAME,$PASSWORD))
	{
		mysql_query("SET NAMES 'utf8'");
		if(mysql_select_db($DATABASE_NAME, $link))
			return true;
		else
			return false;
	}
}

#----------------------------------------------------------------------------------------------------------------------------
//檢驗連線是否正常
#----------------------------------------------------------------------------------------------------------------------------
function connect_valid()
{

	if(connect_to_db())
		return true;
	else
	{
		echo "<font color=red>Connection Abnormal!";
		return false;
	}

}

function db_query($sql) {
    $result = mysql_query($sql);
    if(false === $result) {
        die(mysql_error());
    } else {
        return $result;
    }
}
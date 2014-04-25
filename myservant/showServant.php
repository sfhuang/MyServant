<?php
	require_once "inc/sql.php";
	connect_valid();



	IF($_GET[LV]=="CITY")
	{
		$QUERY_STRING="SELECT * FROM CITY_LIST WHERE CITY_ID='".$_GET[CID]."'";
	}
	ELSE IF($_GET[LV]=="DIST")
	{
		$QUERY_STRING="SELECT * FROM GOVERNOR_LIST WHERE GOVERNOR_TYPE='DISTRICT' AND REGION_ID='".$_GET[DISTID]."'";
	}
	ELSE IF($_GET[LV]=="VILLAGE")
	{
		$QUERY_STRING="SELECT * FROM GOVERNOR_LIST WHERE GOVERNOR_TYPE='VILLAGE' AND REGION_ID='".$_GET[VILLAGEID]."' AND (POSITION_ID=18 OR POSITION_ID=19)";
	}
	ELSE IF($_GET[LV]=="VILLAGEWK")
	{
		$QUERY_STRING="SELECT * FROM GOVERNOR_LIST WHERE GOVERNOR_TYPE='VILLAGE_ASSISTANT' AND REGION_ID='".$_GET[VILLAGEID]."' AND (POSITION_ID=20 OR POSITION_ID=21)";
	}
	ELSE IF($_GET[LV]=="LEGIST")
	{
		IF($_GET[NATIVE]==1)
		{
			IF($_GET[NATIVETYPE]==0)
				$QUERY_STRING="SELECT * FROM LEGISLATOR_LIST WHERE LEGISLATOR_ELECTION_DISTRICT_ID='6666'";
			ELSE
				$QUERY_STRING="SELECT * FROM LEGISLATOR_LIST WHERE LEGISLATOR_ELECTION_DISTRICT_ID='7777'";
		}
		ELSE
		{
			$QUERY_STRING="SELECT * FROM VILLAGE_LEGISLATOR2 WHERE VILLAGE_ID='".$_GET[VILLAGEID]."'";
		}
	}
	ELSE IF($_GET[LV]=="LEGISTCONT")
	{
		$QUERY_STRING="SELECT * FROM VILLAGE_LEGISLATOR2 AS VL, LEGISLATOR_CONTACT_SPOT AS LCS WHERE VILLAGE_ID='".$_GET[VILLAGEID]."' AND VL.LEGISLATOR_ID=LCS.LEGISLATOR_ID";
	}
	ELSE IF($_GET[LV]=="CITYREP")
	{
		IF($_GET[NATIVE]==1)
		{
			IF($_GET[NATIVETYPE]==0)
			{
				$QUERY_STRING="SELECT CITY_LEVEL_REP_ELECT_PNA_DIST_ID AS ELEDID,local_rep_elect_dist_name AS LREDNAME FROM VILLAGE_LIST AS VL,local_representative_election_district_list AS LREDL WHERE VILLAGE_ID='".$_GET[VILLAGEID]."' AND LREDL.local_rep_elect_dist_id=VL.CITY_LEVEL_REP_ELECT_PNA_DIST_ID";
			}
			ELSE
			{
				$QUERY_STRING="SELECT CITY_LEVEL_REP_ELECT_MNA_DIST_ID AS ELEDID,local_rep_elect_dist_name AS LREDNAME FROM VILLAGE_LIST AS VL,local_representative_election_district_list AS LREDL WHERE VILLAGE_ID='".$_GET[VILLAGEID]."' AND LREDL.local_rep_elect_dist_id=VL.CITY_LEVEL_REP_ELECT_MNA_DIST_ID";
			}
		}
		ELSE
		{
			$QUERY_STRING="SELECT CITY_LEVEL_REP_ELECT_N_DIST_ID AS ELEDID,local_rep_elect_dist_name AS LREDNAME FROM VILLAGE_LIST AS VL,local_representative_election_district_list AS LREDL WHERE VILLAGE_ID='".$_GET[VILLAGEID]."' AND LREDL.local_rep_elect_dist_id=VL.CITY_LEVEL_REP_ELECT_N_DIST_ID";
		}
		IF(MYSQL_NUM_ROWS($RESULT=MYSQL_QUERY($QUERY_STRING))==1)
		{
			$ELEDISTDATA=MYSQL_FETCH_ARRAY($RESULT);
			$ELEDISTNAME=$ELEDISTDATA[LREDNAME];
			IF($_GET[CID]<6)
			{
				$QUERY_STRING="SELECT * FROM LOCAL_REPRESENTATIVE_LIST WHERE LOCAL_REPRESENTATIVE_LEVEL='DIRECT_CITY' AND LOCAL_REP_ELECT_DIST_ID='".$ELEDISTDATA[ELEDID]."'";
			}
			ELSE
			{
				$QUERY_STRING="SELECT * FROM LOCAL_REPRESENTATIVE_LIST WHERE LOCAL_REPRESENTATIVE_LEVEL='CITY' AND LOCAL_REP_ELECT_DIST_ID='".$ELEDISTDATA[ELEDID]."'";
			}
		}
	}
	
	IF($QUERY_STRING!="")
	{
		IF($RESULT=MYSQL_QUERY($QUERY_STRING))
		{
			IF($_GET[LV]=="CITYREP")
			{
				$NO_OF_DATA=MYSQL_NUM_ROWS($RESULT);
				IF($NO_OF_DATA>0)
				{
					ECHO "<SPAN STYLE='COLOR:RED;'>(".$ELEDISTNAME.")</SPAN><BR>";
					ECHO "<TABLE BORDER=0 WIDTH=100%>";
					FOR($SEED=0;$SEED<$NO_OF_DATA;$SEED++)
					{
						IF($SEED%2==0)
						{
							ECHO "<TR STYLE='BACKGROUND-COLOR:#CCCCCC'>";
						}
						ELSE
							ECHO "<TR>";
						$DATA=MYSQL_FETCH_ARRAY($RESULT);
						ECHO "<TD ALIGN=CENTER>";
						displayParty($DATA[party_id]);
						ECHO "<BR>".$DATA[local_representative_name];
						ECHO "</TD><TD>
						．".$DATA[office_address]."<BR>．".$DATA[office_main_tel]."
						</TD></TR>";
					}
					ECHO "</TABLE>";
				}
			}
			ELSE IF($_GET[LV]=="LEGISTCONT")
			{
				$NO_OF_DATA=MYSQL_NUM_ROWS($RESULT);
				IF($NO_OF_DATA>0)
				{
					FOR($SEED=0;$SEED<$NO_OF_DATA;$SEED++)
					{
						$DATA=MYSQL_FETCH_ARRAY($RESULT);
						ECHO "<SPAN STYLE='COLOR:BLUE;'><B>".$DATA[contact_spot_name]."</B></SPAN><BR>";
						ECHO "<SPAN STYLE='COLOR:#666666;'>．".$DATA[contact_spot_main_address]."</SPAN><BR>";
						ECHO "<SPAN STYLE='COLOR:#666666;'>．TEL：".$DATA[contact_spot_main_tel]."</SPAN><BR>
							<SPAN STYLE='COLOR:#666666;'>．FAX：".$DATA[contact_spot_main_tel]."</SPAN><BR>";
						ECHO $DATA[LOCAL_REPRESENTATIVE_NAME];
					}
				}
			}
			ELSE
			{
				IF($_GET[LV]=="LEGIST")
				{
						$NO_OF_DATA=MYSQL_NUM_ROWS($RESULT);
						FOR($SEED=0;$SEED<$NO_OF_DATA;$SEED++)
						{
							$DATA=MYSQL_FETCH_ARRAY($RESULT);
							IF($SEED==0)
							{
								IF($DATA[legislator_election_district_name]!="")
									ECHO "<SPAN STYLE='COLOR:RED;FONT-SIZE:14'>(".$DATA[legislator_election_district_name].")</SPAN><BR>";
								ELSE IF($_GET[NATIVE]==1)
								{
									IF($_GET[NATIVETYPE]==0)
										ECHO "<SPAN STYLE='COLOR:RED;FONT-SIZE:14'>(平地原住民)</SPAN><BR>";
									ELSE IF($_GET[NATIVETYPE]==1)
										ECHO "<SPAN STYLE='COLOR:RED;FONT-SIZE:14'>(山地原住民)</SPAN><BR>";
								}
								ECHO "<TABLE BORDER=0 WIDTH=100%>";
							}
							IF(($SEED%2)==0)
							{
								ECHO "<TR STYLE='BACKGROUND-COLOR:#DDDDDD'>";
							}
							ELSE
							{
								ECHO "<TR>";
							}
							ECHO "<TD ALIGN=CENTER STYLE='WIDTH:80'>";
							displayParty($DATA[party_id]);
							ECHO "<BR>".$DATA[legislator_name];
							ECHO "</TD><TD>";
							$QUERY_STRING="SELECT * FROM LEGISLATOR_CONTACT_SPOT AS LCS WHERE LCS.LEGISLATOR_ID='".$DATA[legislator_id]."'";
							$NO_OF_SPOT=MYSQL_NUM_ROWS($SPOT_RESULT=MYSQL_QUERY($QUERY_STRING));
							FOR($SPOT_SEED=0;$SPOT_SEED<$NO_OF_SPOT;$SPOT_SEED++)
							{
								$SPOT_DATA=MYSQL_FETCH_ARRAY($SPOT_RESULT);
								ECHO "<SPAN STYLE='COLOR:BLUE;'><B>".$SPOT_DATA[contact_spot_name]."</B></SPAN><BR>";
								ECHO "<SPAN STYLE='COLOR:#666666;'>．".$SPOT_DATA[contact_spot_main_address]."</SPAN><BR>";
								ECHO "<SPAN STYLE='COLOR:#666666;'>．TEL：".$SPOT_DATA[contact_spot_main_tel]."</SPAN><BR>
									<SPAN STYLE='COLOR:#666666;'>．FAX：".$SPOT_DATA[contact_spot_main_tel]."</SPAN><BR>";
							}
							ECHO "</TD></TR>";
						}
				}
				ELSE IF($_GET[LV]=="CITY")
				{
					$DATA=MYSQL_FETCH_ARRAY($RESULT);
					displayParty($DATA[mayor_party_id]);
					ECHO "&nbsp;".$DATA[governor_name];
				}
				ELSE
				{
					$DATA=MYSQL_FETCH_ARRAY($RESULT);
					ECHO "<TABLE BORDER=0 WIDTH=100%>";
					ECHO "<TR>";
					ECHO "<TD ALIGN=CENTER STYLE='WIDTH:80' ROWSPAN=2>";
					IF($_GET[LV]!="VILLAGEWK"&&$_GET[LV]!="DIST")
					{
						displayParty($DATA[party_id]);
						ECHO "<BR>";
					}
					ECHO $DATA[governor_name];
					ECHO "</TD><TD>";
					
					IF($DATA[office_address]!="")
					{
						$OFFICE_ADD=EXPLODE("．",$DATA[office_address]);
						$OFFICE_TEL=EXPLODE("．",$DATA[office_main_tel]);
						ECHO "．".$OFFICE_ADD[0]."<BR>．".$OFFICE_TEL[0]."</TD></TR>";
						IF($OFFICE_ADD[1]!="")
						{
							ECHO "<TR><TD STYLE='BACKGROUND-COLOR:#CCCCCC'>．".$OFFICE_ADD[1]."<BR>．".$OFFICE_TEL[1]."</TD></TR>";
						}
					}
					ECHO "</TD></TR>";
					ECHO "</TABLE>";
				}
			}
		}
	}

	FUNCTION displayParty($PARTY_ID)
	{
			$PARTY_ARRAY[0][C]="#000000";$PARTY_ARRAY[0][W]="[無黨]";$PARTY_ARRAY[0][D]="無黨籍";
			$PARTY_ARRAY[1][C]="#0000FF";$PARTY_ARRAY[1][W]="[國民]";$PARTY_ARRAY[1][D]="中國國民黨";
			$PARTY_ARRAY[2][C]="GREEN";$PARTY_ARRAY[2][W]="[民進]";$PARTY_ARRAY[2][D]="民主進步黨";
			$PARTY_ARRAY[3][C]="BROWN";$PARTY_ARRAY[3][W]="[台聯]";$PARTY_ARRAY[3][D]="台灣團結聯盟";
			$PARTY_ARRAY[4][C]="#000000";$PARTY_ARRAY[4][W]="[親民]";$PARTY_ARRAY[4][D]="親民黨";
			$PARTY_ARRAY[5][C]="#000000";$PARTY_ARRAY[5][W]="[無團]";$PARTY_ARRAY[5][D]="無黨團結聯盟";
			$PARTY_ARRAY[6][C]="#0000FF";$PARTY_ARRAY[6][W]="[新黨]";$PARTY_ARRAY[6][D]="新黨";
			$PARTY_ARRAY[7][C]="#000000";$PARTY_ARRAY[7][W]="[綠黨]";$PARTY_ARRAY[7][D]="綠黨";
			$PARTY_ARRAY[8][C]="#000000";$PARTY_ARRAY[8][W]="[全廉]";$PARTY_ARRAY[8][D]="全民廉政無黨聯盟";
			$PARTY_ARRAY[9][C]="#FF0000";$PARTY_ARRAY[9][W]="[中民]";$PARTY_ARRAY[9][D]="中國民主黨";
			$PARTY_ARRAY[10][C]="#FF0000";$PARTY_ARRAY[10][W]="[中進]";$PARTY_ARRAY[10][D]="中國民主進步黨";
			$PARTY_ARRAY[11][C]="#FF0000";$PARTY_ARRAY[11][W]="[中青]";$PARTY_ARRAY[11][D]="中國青年黨";
			$PARTY_ARRAY[12][C]="#FF0000";$PARTY_ARRAY[12][W]="[中社]";$PARTY_ARRAY[12][D]="中國民主社會黨";
			$PARTY_ARRAY[13][C]="#FF0000";$PARTY_ARRAY[13][W]="[中統]";$PARTY_ARRAY[13][D]="中華統一促進黨";
			$PARTY_ARRAY[14][C]="#FF0000";$PARTY_ARRAY[14][W]="[中復]";$PARTY_ARRAY[14][D]="中國復興黨";
			$PARTY_ARRAY[15][C]="#000000";$PARTY_ARRAY[15][W]="[勞動]";$PARTY_ARRAY[15][D]="勞動黨";
			ECHO "<SPAN STYLE='WIDTH:10;BACKGROUND-COLOR:#CCCCCC;COLOR:".$PARTY_ARRAY[$PARTY_ID][C].";MARGIN:1'>".$PARTY_ARRAY[$PARTY_ID][W]."</SPAN>";
	}
php?>
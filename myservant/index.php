<?php
	require_once "inc/sql.php";
	connect_valid();
?>
<TITLE>發現公僕（誰是我的公僕？）</TITLE>
<BODY ONLOAD=initialPhase()>
	<BR><CENTER><SPAN STYLE='FONT-SIZE:30'>您知道誰是您的公僕嗎？</SPAN><BR><BR>
	<TABLE BORDER=1 CELLSPACING=0 CELLPADDING=3>
	<TR><TD COLSPAN=6 STYLE='BACKGROUND-COLOR:#DDDDFF;TEXT-ALIGN:CENTER'>請取出身分證，依照上面記載的資料依序選擇以下選項即可知道答案</TD></TR>
<?php
	
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
	
	ECHO "
	<TR><TD STYLE='TEXT-ALIGN:CENTER;BACKGROUND-COLOR:#FFDDDD;'>身分</TD><TD COLSPAN=5>
		<SELECT ID='NATIVE' ONCHANGE='showdiv()' STYLE='WIDTH:120;FONT-SIZE:16'>
			<OPTION VALUE='0'>是否為原住民</OPTION>
			<OPTION VALUE='1'>我不是原住民</OPTION>
			<OPTION VALUE='2'>我是原住民</OPTION>
		</SELECT>
		<SPAN ID='DIV_NATIVETYPE' STYLE='DISPLAY:NONE'>
		<SELECT ID='NATIVETYPE' ONCHANGE='showdiv()' STYLE='FONT-SIZE:16'>
			<OPTION VALUE='0'>平地原住民</OPTION>
			<OPTION VALUE='1'>山地原住民</OPTION>
		</SELECT>
		</SPAN>
	</TD></TR>
	";
php?>
	<TR><TD STYLE='TEXT-ALIGN:CENTER;BACKGROUND-COLOR:#FFDDDD;'>地址</TD><TD COLSPAN=5>
<?php
	
	display_city("CID","120","ONCHANGE=setDistList()",$_POST[CID]);
	
php?>
	<SPAN ID=DIST_LIST>
			<SELECT ID='DISTID' STYLE='WIDTH:120;FONT-SIZE:16'><OPTION VALUE=0>鄉鎮市區</OPTION></SELECT>
	</SPAN>
	<SPAN ID=VILLAGE_LIST>
			<SELECT ID='VILLAGEID' STYLE='WIDTH:120;FONT-SIZE:16'>><OPTION VALUE=0>村里</OPTION></SELECT>
	</SPAN>
	</TD></TR>
	<TR STYLE='BACKGROUND-COLOR:#DDDDFF;TEXT-ALIGN:CENTER'><TD>層級</TD><TD>類別</TD><TD>職稱</TD><TD>詳細資料</TD></TR>
	<TR STYLE='TEXT-ALIGN:CENTER'><TD STYLE='BACKGROUND-COLOR:#FFDDDD;' ROWSPAN=2>中央</TD><TD>民選首長</TD><TD STYLE='BACKGROUND-COLOR:#DDFFDD;WIDTH:100'>總統</TD><TD STYLE='WIDTH:550;BACKGROUND-COLOR:#EEFFEE'><SPAN STYLE='WIDTH:10;BACKGROUND-COLOR:#CCCCCC;COLOR:#0000FF;MARGIN:1'>[國民]</SPAN>&nbsp;馬英九</TD></TR>
		<TR STYLE='TEXT-ALIGN:CENTER'><TD>民意代表</TD><TD STYLE='BACKGROUND-COLOR:#DDFFDD;WIDTH:100;'>立法委員</TD><TD STYLE='WIDTH:500;BACKGROUND-COLOR:#EEFFEE'><DIV ID=DIST_LEGISLATOR></DIV></TD></TR>
	<TR STYLE='TEXT-ALIGN:CENTER'><TD STYLE='BACKGROUND-COLOR:#FFDDDD;' ROWSPAN=2>縣市</TD><TD>民選首長</TD><TD STYLE='BACKGROUND-COLOR:#DDFFDD;WIDTH:100'><DIV ID=CITYPOS>縣市長</DIV></TD><TD STYLE='WIDTH:550;BACKGROUND-COLOR:#EEFFEE'><DIV ID=CITY_GOVERNOR></DIV></TD></TR>
		<TR STYLE='TEXT-ALIGN:CENTER'><TD>民意代表</TD><TD STYLE='BACKGROUND-COLOR:#DDFFDD;WIDTH:100;'><DIV ID=CITYREPPOS>縣市議員</DIV></TD><TD STYLE='WIDTH:500;BACKGROUND-COLOR:#EEFFEE'><DIV ID=CITY_REP></DIV></TD></TR>
	<TR STYLE='TEXT-ALIGN:CENTER'><TD STYLE='BACKGROUND-COLOR:#FFDDDD;' ROWSPAN=2>鄉鎮市區</TD><TD>首長</TD><TD STYLE='BACKGROUND-COLOR:#DDFFDD;WIDTH:100;'><DIV ID=DISTPOS>鄉鎮市區長</DIV></TD><TD STYLE='WIDTH:550;BACKGROUND-COLOR:#EEFFEE'><DIV ID=DIST_GOVERNOR></DIV></TD></TR>
		<TR STYLE='TEXT-ALIGN:CENTER'><TD>民意代表</TD><TD STYLE='BACKGROUND-COLOR:#DDFFDD;WIDTH:100;'><DIV ID=DISTREPPOS>鄉鎮市民代表</DIV></TD><TD STYLE='BACKGROUND-COLOR:#DDDDDD'><DIV ID=DIST_REP>因中選會未提供完整選區資料，無法建置</DIV></TD></TR>
	<TR STYLE='TEXT-ALIGN:CENTER'><TD STYLE='BACKGROUND-COLOR:#FFDDDD;' ROWSPAN=2>村里</TD><TD>民選首長</TD><TD STYLE='BACKGROUND-COLOR:#DDFFDD;WIDTH:100;'><DIV ID=VILLAGEPOS>村里長</DIV></TD><TD STYLE='WIDTH:550;BACKGROUND-COLOR:#EEFFEE'><DIV ID=VILLAGE_GOVERNOR></DIV></TD></TR>
	<TR STYLE='TEXT-ALIGN:CENTER'><TD>公務員</TD><TD STYLE='BACKGROUND-COLOR:#DDFFDD;'><DIV ID=VILLAGEWORKERPOS>村里幹事</DIV></TD><TD STYLE='WIDTH:550;BACKGROUND-COLOR:#EEFFEE'><DIV ID=VILLAGE_WORKER></DIV></TD></TR></TABLE>
<?php
	
	ECHO "<TABLE BORDER=0>
		<TR>";
	FOR($SEED=0;$SEED<16;$SEED++)
	{
		IF($SEED>0&&($SEED%4==0))
			ECHO "</TR><TR>";
		ECHO "<TD STYLE='WIDTH:190'><SPAN STYLE='WIDTH:10;BACKGROUND-COLOR:#CCCCCC;COLOR:".$PARTY_ARRAY[$SEED][C].";MARGIN:1'>".$PARTY_ARRAY[$SEED][W]."</SPAN>：".$PARTY_ARRAY[$SEED][D]."</TD>";
	}
	ECHO "</TR></TABLE>";
	ECHO "<BR>※加場演出：<A HREF='https://play.google.com/store/apps/details?id=hsfsoft.civiltool.legislatorcaller' TARGET=_blank>【你亂搞，我打爆】立委監督 APP (Android 版)</A>※<BR>";
	ECHO "<BR>&copy; ".date('Y')."&nbsp;<A HREF='https://www.facebook.com/shengfeng.huang.9' TARGET=_blank>S.F. Huang</A>";
	
	

	
	FUNCTION display_city($NAME,$WIDTH,$ACTIONS,$DEFAULT)
	{
		$QUERY_STRING="SELECT * FROM CITY_LIST";
		IF($DEFAULT=="")
		{
			$DEFAULT=0;
		}
		$NO_OF_DATA=MYSQL_NUM_ROWS($RESULT=MYSQL_QUERY($QUERY_STRING));
		IF($NO_OF_DATA>0)
		{
			ECHO "<SELECT NAME='".$NAME."' ID='".$NAME."'  STYLE='WIDTH:".$WIDTH.";FONT-SIZE:16' ".$ACTIONS.">";
			IF($DEFAULT==0)
				ECHO "<OPTION VALUE=0 CHECKED>選擇縣市</OPTION>";
			ELSE
				ECHO "<OPTION VALUE=0>選擇縣市</OPTION>";
			FOR($SEED=0;$SEED<$NO_OF_DATA;$SEED++)
			{
				$DATA=MYSQL_FETCH_ARRAY($RESULT);
				ECHO "<OPTION VALUE='".$DATA[city_id]."'";
				IF($DATA[city_id]==$DEFAULT)
					ECHO " CHECKED";
				ECHO ">".$DATA[city_name]."</OPTION>";
			}
			ECHO "</SELECT>";
		}
		ELSE
		{
			ECHO "無資料";
		}
	}
	
	
php?>

<SCRIPT>

function showdiv()
{
	if(document.getElementById('NATIVE').value==2)
	{
		document.getElementById('DIV_NATIVETYPE').style.display='';
		loadDataObj(XMLHttpRequestObject,'showServant.php?LV=LEGIST&NATIVE=1&NATIVETYPE='+document.getElementById('NATIVETYPE').value,'DIST_LEGISLATOR');
	}
	else
	{
		document.getElementById('DIV_NATIVETYPE').style.display='none';
		document.getElementById('DIST_LEGISLATOR').innerHTML='';
	}
	document.getElementById('CITYPOS').innerHTML='縣市長';
	document.getElementById('CITY_GOVERNOR').innerHTML='';
	document.getElementById('CITYREPPOS').innerHTML='縣市議員';
	document.getElementById('CITY_REP').innerHTML='';
	document.getElementById('DISTPOS').innerHTML='鄉鎮市區長';
	document.getElementById('DIST_GOVERNOR').innerHTML='';
	document.getElementById('DISTREPPOS').innerHTML='鄉鎮市民代表';
	document.getElementById('VILLAGEPOS').innerHTML='村里長';
	document.getElementById('VILLAGE_GOVERNOR').innerHTML='';
	document.getElementById('VILLAGEWORKERPOS').innerHTML='村里幹事';
	document.getElementById('VILLAGE_WORKER').innerHTML='';
}

function setDistList()
{
	if(document.getElementById('CID').value==0)
	{
		document.getElementById('DIST_LIST').innerHTML="<SELECT ID='DISTLIST' STYLE='WIDTH:120'><OPTION VALUE=0>鄉鎮市區</OPTION></SELECT>";
		document.getElementById('VILLAGE_LIST').innerHTML="<SELECT ID='VILLAGELIST' STYLE='WIDTH:120'>><OPTION VALUE=0>村里</OPTION></SELECT>";
		document.getElementById('CITYPOS').innerHTML='縣市長';
		document.getElementById('CITY_GOVERNOR').innerHTML='';
		document.getElementById('CITYREPPOS').innerHTML='縣市議員';
	}
	else
	{
		document.getElementById('VILLAGE_LIST').innerHTML="<SELECT ID='VILLAGELIST' STYLE='WIDTH:120'>><OPTION VALUE=0>村里</OPTION></SELECT>";
		textContent=document.getElementById('CID').options[document.getElementById('CID').selectedIndex].text;
		document.getElementById('CITYPOS').innerHTML=textContent.substr(textContent.length-1)+'長';
		document.getElementById('CITYREPPOS').innerHTML=textContent.substr(textContent.length-1)+'議員';
		loadDataObj(XMLHttpRequestObject,'displaySelectList.php?CID='+document.getElementById('CID').value,'DIST_LIST');
		loadDataObj(XMLHttpRequestObject2,'showServant.php?LV=CITY&CID='+document.getElementById('CID').value,'CITY_GOVERNOR');
	}
	document.getElementById('DISTPOS').innerHTML='鄉鎮市區長';
	document.getElementById('VILLAGEPOS').innerHTML='村里長';
	document.getElementById('VILLAGEWORKERPOS').innerHTML='村里幹事';
	document.getElementById('CITY_REP').innerHTML='';
	document.getElementById('VILLAGE_GOVERNOR').innerHTML='';
	document.getElementById('DIST_GOVERNOR').innerHTML='';
	if(document.getElementById('NATIVE').value!=2)
	{
		document.getElementById('DIST_LEGISLATOR').innerHTML='';
	}
	document.getElementById('DISTREPPOS').innerHTML='鄉鎮市民代表';
	document.getElementById('VILLAGE_WORKER').innerHTML='';
}

function setVillageList()
{
	if(document.getElementById('DISTID').value==0)
	{
		document.getElementById('VILLAGE_LIST').innerHTML="<SELECT ID='VILLAGELIST' STYLE='WIDTH:120'>><OPTION VALUE=0>村里</OPTION></SELECT>";
		document.getElementById('DIST_GOVERNOR').innerHTML='';
	}
	else
	{
		textContent=document.getElementById('DISTID').options[document.getElementById('DISTID').selectedIndex].text;
		document.getElementById('DISTPOS').innerHTML=textContent.substr(textContent.length-1)+'長';
		if(textContent.substr(textContent.length-1)=='區')
			document.getElementById('DISTREPPOS').innerHTML='市民代表';
		else
			document.getElementById('DISTREPPOS').innerHTML=textContent.substr(textContent.length-1)+'民代表';
		loadDataObj(XMLHttpRequestObject,'displaySelectList.php?DISTID='+document.getElementById('DISTID').value,'VILLAGE_LIST');
		loadDataObj(XMLHttpRequestObject2,'showServant.php?LV=DIST&DISTID='+document.getElementById('DISTID').value,'DIST_GOVERNOR');
	}
	if(document.getElementById('NATIVE').value!=2)
	{
		document.getElementById('DIST_LEGISLATOR').innerHTML='';
	}
	document.getElementById('CITY_REP').innerHTML='';
	document.getElementById('VILLAGE_GOVERNOR').innerHTML='';
	document.getElementById('VILLAGE_WORKER').innerHTML='';
	document.getElementById('VILLAGEPOS').innerHTML='村里長';
	document.getElementById('VILLAGEWORKERPOS').innerHTML='村里幹事';
}

function setFormData()
{
	textContent=document.getElementById('VILLAGEID').options[document.getElementById('VILLAGEID').selectedIndex].text;
	document.getElementById('VILLAGEPOS').innerHTML=textContent.substr(textContent.length-1)+'長';
	document.getElementById('VILLAGEWORKERPOS').innerHTML=textContent.substr(textContent.length-1)+'幹事';

//DIST LEVEL
		loadDataObj(XMLHttpRequestObject,'showServant.php?LV=VILLAGE&VILLAGEID='+document.getElementById('VILLAGEID').value,'VILLAGE_GOVERNOR');
		loadDataObj(XMLHttpRequestObject4,'showServant.php?LV=VILLAGEWK&VILLAGEID='+document.getElementById('VILLAGEID').value,'VILLAGE_WORKER');
		if(document.getElementById('NATIVE').value==2)
		{
			loadDataObj(XMLHttpRequestObject5,'showServant.php?LV=CITYREP&NATIVE=1&NATIVETYPE='+document.getElementById('NATIVETYPE').value+'&CID='+document.getElementById('CID').value+'&VILLAGEID='+document.getElementById('VILLAGEID').value,'CITY_REP');
		}
		else
		{
			loadDataObj(XMLHttpRequestObject5,'showServant.php?LV=CITYREP&CID='+document.getElementById('CID').value+'&VILLAGEID='+document.getElementById('VILLAGEID').value,'CITY_REP');
		}
		if(document.getElementById('NATIVE').value==2)
		{
			loadDataObj(XMLHttpRequestObject2,'showServant.php?LV=LEGIST&NATIVE=1&NATIVETYPE='+document.getElementById('NATIVETYPE').value,'DIST_LEGISLATOR');
		}
		else
		{
			loadDataObj(XMLHttpRequestObject2,'showServant.php?LV=LEGIST&VILLAGEID='+document.getElementById('VILLAGEID').value,'DIST_LEGISLATOR');
		}
}

var XMLHttpRequestObject = false;
var XMLHttpRequestObject2 = false;
var XMLHttpRequestObject3 = false;
var XMLHttpRequestObject4 = false;
var XMLHttpRequestObject5 = false;
var XMLHttpRequestObject6 = false;
var XMLHttpRequestObject7 = false;

function iniHttpRequestObject(obj)
{
	if(window.XMLHttpRequest)
	{
		obj = new XMLHttpRequest();
	}
	else if (window.ActiveXObject)
	{
		obj = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return obj;
}

function initialPhase()
{
	XMLHttpRequestObject=iniHttpRequestObject(XMLHttpRequestObject);
	XMLHttpRequestObject2=iniHttpRequestObject(XMLHttpRequestObject2);
	XMLHttpRequestObject3=iniHttpRequestObject(XMLHttpRequestObject3);
	XMLHttpRequestObject4=iniHttpRequestObject(XMLHttpRequestObject4);
	XMLHttpRequestObject5=iniHttpRequestObject(XMLHttpRequestObject5);
	XMLHttpRequestObject6=iniHttpRequestObject(XMLHttpRequestObject6);
	XMLHttpRequestObject7=iniHttpRequestObject(XMLHttpRequestObject7);
}

function loadData(dataSource,DivID)
{
	document.getElementById(DivID).innerHTML=">>Loading<<";
	if(XMLHttpRequestObject)
	{
		var obj = document.getElementById(DivID);
		XMLHttpRequestObject.open("GET", dataSource);
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if(XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
			{
				obj.innerHTML = XMLHttpRequestObject.responseText;
			}
		}
		XMLHttpRequestObject.send(null);
	}
}

function loadDataObj(HttpObj,dataSource,DivID)
{
	if(HttpObj)
	{
		var obj = document.getElementById(DivID);
		HttpObj.open("GET", dataSource);
		HttpObj.onreadystatechange = function()
		{
			if(HttpObj.readyState == 4 && HttpObj.status == 200)
			{
				obj.innerHTML = HttpObj.responseText;
			}
		}
		HttpObj.send(null);
	}
}

function loadDataObjTo(HttpObj,dataSource,DivID,Direction,StartDataID,NO)
{
	dataSource=dataSource+"&DIR="+Direction+"&NO="+NO+"&STPID="+document.getElementById(StartDataID).value;
	if(HttpObj)
	{
		var obj = document.getElementById(DivID);
		HttpObj.open("GET", dataSource);
		HttpObj.onreadystatechange = function()
		{
			if(HttpObj.readyState == 4 && HttpObj.status == 200)
			{
				obj.innerHTML = HttpObj.responseText;
			}
		}
		HttpObj.send(null);
	}
}


</SCRIPT>
</BODY>

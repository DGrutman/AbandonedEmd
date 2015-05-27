<?php

include('SiData.php');
$clnt = str_pad($_REQUEST['clnt'],10,' ',STR_PAD_LEFT);
$mttr = str_pad($_REQUEST['mttr'],10,' ',STR_PAD_LEFT);

//Model would instantiate dbconnection and perform queries
$server="Driver={iSeries Access ODBC Driver};System=NYAS400;Uid=SCHUMANJ;Pwd=WEMED777;";
$user="SCHUMANJ"; 
$pass="WEMED777";
$dbconn=odbc_connect($server,$user,$pass);


//start model
$stmt = "select '1' as share, cdbdtl.* , ncnarr, dddesc
		from lmsfillib.cdbdtl cdbdtl 
		left join lmsfillib.cnfnar cnfnar on cdbdtl.dnpar = cnfnar.ncnptr
		inner join lmsfillib.coddsc coddsc on coddsc.code = cdbdtl.dnc052 and cdty='C052'
		where dnclnt='$clnt' and dnmttr='$mttr' and dnstat<>'X'";

$res = odbc_exec($dbconn,$stmt);

$share1data = array();
while($row = odbc_fetch_array($res))
	array_push($share1data,$row);
//end model

$share1SiData = new SiData($clnt,$mttr,1);
$share1SiData->loadData($share1data);

//start model
$stmt = "select '1' as share, cdbdtl.* , ncnarr, dddesc
		from lmsfillib.cdbdtl cdbdtl 
		left join lmsfillib.cnfnar cnfnar on cdbdtl.dnpar = cnfnar.ncnptr
		inner join lmsfillib.coddsc coddsc on coddsc.code = cdbdtl.dnc052 and cdty='C052'
		where dnclnt='$clnt' and dnmttr='         2' and dnstat<>'X'";

$res = odbc_exec($dbconn,$stmt);

$share2data = array();
while($row = odbc_fetch_array($res))
	array_push($share2data,$row);
//end model
$share2SiData = new SiData($clnt,$mttr,2);
$share2SiData->loadData($share2data);

//view would follow
var_dump($share1SiData);
var_dump($share2SiData);

?>
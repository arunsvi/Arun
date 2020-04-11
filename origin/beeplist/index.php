<?php
#error_reporting("E_ERROR | E_NOTICE");
@ini_set("display_errors", "0");
set_time_limit("0");
ini_set("memory_limit","10000M");

include "cURL.php";
$cookFile='cookFile.txt';
$cURL = new cURL(TRUE,$cookFile,'','');
#$cURL->get('https://app.scrapinghub.com/api/jobs/list.json?project=430616&spider=allcars&state=finished&count=1&apikey=c055aa6133a74a94ad2eab4208c8d076');
$resultFile=$cURL->get('https://storage.scrapinghub.com/items/430616/1/4?count=10&apikey=c055aa6133a74a94ad2eab4208c8d076');
print $resultFile;
?>
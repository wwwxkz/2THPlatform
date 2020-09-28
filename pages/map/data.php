<?php
function parseToXML($htmlStr)
{
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}

$url = "http://localhost/api/v1/report/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
$reports = json_decode(file_get_contents($url), true);

header("Content-type: text/xml");

echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;

foreach($reports['data'] as $index => $report){
  $location = json_decode($report['locations']);
  end($location);
  $key = key($location);
  
  echo '<marker ';
  echo 'id="' . $report['id'] . '" ';
  echo 'name="' . parseToXML($report['name']) . '" ';
  echo 'lat="' . $location[$key]->lat . '" ';
  echo 'lng="' . $location[$key]->lon . '" ';
  echo '/>';
  $ind = $ind + 1;
}

echo '</markers>';
?>

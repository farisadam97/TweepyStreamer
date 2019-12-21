<?php
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
// include('db_conn.php')
$connection=mysqli_connect('db-tweet.cr00p4kudq0x.ap-southeast-1.rds.amazonaws.com', "admin", "simpan03");
if (!$connection) {  die('Not connected : ' . mysqli_connect_errno());}
$db_selected = $connection->select_db("db_tweet");
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_connect_errno());
}
include('sql_main.php');
// $query = "SELECT * FROM streamTable ORDER BY idstreamTable DESC LIMIT 10";
$result = $connection->query($sql);
if (!$result) {
    die('Invalid query: ' . mysqli_connect_errno());
}
header("Content-type: text/xml");
while ($row =mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("id",$row['idstreamTable']);
    $newnode->setAttribute("jalan", $row['jalanName']);
    $newnode->setAttribute("tgl", $row['dateTweet']);
    $newnode->setAttribute("lat", $row['latLoc']);
    $newnode->setAttribute("lng", $row['lngLoc']);
    $newnode->setAttribute("kategori", $row['category']);
    $newnode->setAttribute("media", $row['mediaLink']);

}
echo $dom->saveXML();?>

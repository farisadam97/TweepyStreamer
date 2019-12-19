<?php 

include('db_con.php');
// $db_selected = $mysqli->select_db("db_tweet");
include('sql_main.php');
$result = $mysqli->query($sql);
?>

<!-- /*WHERE YEARWEEK('dateTweet',0) = YEARWEEK(CURDATE(),0)*/ -->
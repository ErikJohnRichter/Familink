<?php
require("common.php"); 

$link = mysql_connect($host, $username, $password);

if (!$link) {
  die("Sorry, there was an error. Please try again.");
    /*die('Error: ' . mysql_error()); */
    /*dir('There was a problem when trying to connect to the host. Please contact Tech Support. Error: ' . mysql_error()); */   
}

$db_selected = mysql_select_db($dbname, $link);

if (!$link) {
  die("Sorry, there was an error. Please try again.");
    
    /*dir('There was a problem when trying to connect to the database. Please contact Tech Support. Error: ' . mysql_error()); */   
}

$id = $_POST['id'];

$sql = "DELETE FROM data_generator.`configurations-".$_SESSION['user']['username']."` WHERE id = '$id' ";
mysql_query($sql);

header("Location: configurations.php"); 
die("Redirecting to: configurations.php");



/*if (!mysql_query($sql)) {
    die('Error: ' . mysql_error()); 
}*/

?>
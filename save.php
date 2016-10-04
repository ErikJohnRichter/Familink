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

$data = $_POST['mydata'];
$name = $_POST['title'];

$sql = "INSERT INTO data_generator.`configurations-".$_SESSION['user']['username']."`(config, name) VALUES ('$data', '$name')";
mysql_query($sql);



/*if (!mysql_query($sql)) {
    die('Error: ' . mysql_error()); 
}*/

?>


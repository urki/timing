<?
include "../inc/config.php";


$event_id = $_REQUEST["event_id"];
$tekma_id = $_REQUEST["tekma"];
$users = $_REQUEST["users"];

//create db object//
$db = new DB_Sql();

if ($users and $tekma_id and $event_id ) {
	$start = microtime_float();
	foreach($users as $user_id) { 
	/// then we start the timing//
	$sql = "INSERT INTO  `timming`.`timming` (
	`time_id` ,
	`user_id` ,
	`start` ,
	`stop` ,
	`event_id` ,
	`tekma_id`
	)
	VALUES (
	NULL ,  '$user_id',  ".$start.",  '',  '$event_id',  '$tekma_id')";
	$db->query($sql);
	}
	
	//redirekt to monitor page//
	header("location:run.php?event_id=".$event_id."&tekma=".$tekma_id);
	exit();
}
echo "Ups??";




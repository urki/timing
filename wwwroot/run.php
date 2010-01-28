<?
include "../inc/config.php";


$event_id = $_REQUEST["event_id"];
$tekma_id = $_REQUEST["tekma"];


if (!$event_id or !$tekma_id)
	die("event tekma .. nic ni");

//create db object//
$db = new DB_Sql();

//open template//
$tem = template_open("run.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);
$tmp = template_get_repeat_text("##START##","##STOP##","##RUNNERS##",$tem);
$row = $tmp[1];
$tem = $tmp[0];

//get out the event title//
$sql = "Select events.name as ename, tekma.name as tname from events,tekma where event_id='$event_id' and tekma_id='$tekma_id'";
$db->query($sql);
if ($db->next_record()) {
	$tem = str_replace("##TITLE##",$db->f("ename"). " - ". $db->f("tname"),$tem);
}

///now the runners//
$sql = "SELECT * 
FROM  `timming` , users
WHERE  `timming`.event_id = $event_id
AND tekma_id = $tekma_id
AND STOP =0
AND  `timming`.user_id =  `users`.id_user ";
$db->query($sql);


if ($db->affected_rows()==0) {
	header("location:event_list.php");
	exit();
}

while ($db->next_record()) {
	$table.=$row;
	$table = str_replace("##NUMBER##",$db->f("number"),$table);
	$table = str_replace("##NAME##",$db->f("full_name"),$table);
	$table = str_replace("##USER_ID##",$db->f("id_user"),$table);
	$table = str_replace("##EVENT_ID##",$event_id,$table);
	$table = str_replace("##TEKMA_ID##",$tekma_id,$table);
}

//replace template variables//
$tem = str_replace("##RUNNERS##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;
/*
 <td>##NUMBER## - ##NAME##</td>
  <td><a href="stop.php?user_id=##USER_ID##&event_id=##EVENT_ID##&tekma_id=##TEKMA_ID##">STOP</a></td>
*/
<?
include "../inc/config.php";

//create db object//
$db = new DB_Sql();

//open template//
$tem = template_open("user_list.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);
$tmp = template_get_repeat_text("##START##","##STOP##","##USER_LIST##",$tem);
$row = $tmp[1];
$tem = $tmp[0];

//get out the events//
$sql = "SELECT * 
FROM users, 
events WHERE users.event_id = events.event_id
ORDER BY users.full_name ASC";
$db->query($sql);
while ($db->next_record()) {
	$table.=$row;
	$table = str_replace("##USER_ID##",$db->f("id_user"),$table);
	$table = str_replace("##NAME##",$db->f("full_name"),$table);
	$table = str_replace("##EVENT##",$db->f("name"),$table);
	$table = str_replace("##NUMBER##",$db->f("number"),$table);
}

//replace template variables//
$tem = str_replace("##USER_LIST##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;
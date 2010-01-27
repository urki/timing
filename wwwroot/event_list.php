<?
include "../inc/config.php";

//create db object//
$db = new DB_Sql();

//open template//
$tem = template_open("event_list.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);
$tmp = template_get_repeat_text("##START##","##STOP##","##EVENT_LIST##",$tem);
$row = $tmp[1];
$tem = $tmp[0];

//get out the events//
$sql = "Select * from events";
$db->query($sql);
while ($db->next_record()) {
	$table.=$row;
	$table = str_replace("##EVENT_ID##",$db->f("event_id"),$table);
	$table = str_replace("##NAME##",$db->f("name"),$table);
}

//replace template variables//
$tem = str_replace("##EVENT_LIST##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;
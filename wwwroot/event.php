<?
include "../inc/config.php";


$event_id = $_REQUEST["event_id"];
if (!$event_id)
	die("event_id ?? ");
	

//create db object//
$db = new DB_Sql();

//open template//
$tem = template_open("event.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);
//select the name of the event//
$sql = "select name from events where event_id=$event_id";
$db->query($sql);
$db->next_record();
$title = $db->f("name");



///User_drop_down//
$sql = "SELECT * 
FROM users
WHERE event_id=$event_id
ORDER BY users.number ASC";
$db->query($sql);
while ($db->next_record()) {
	
	$u_names[] = $db->f("number")." - ".$db->f("full_name");
	$u_values[] = $db->f("id_user");
}

$u_drop = html_drop_down_arrays_multiple('users',$u_names,$u_values,$selected,10);


//tekma drop down//
$sql = "Select * from tekma";
$db->query($sql);
while ($db->next_record()) {
	$t_names[] = $db->f("name");
	$t_values[] = $db->f("tekma_id");
}
$t_drop = html_drop_down_arrays('tekma',$t_names,$t_values,$selected);


//replace template variables//
$tem = str_replace("##TITLE##",$title,$tem);
$tem = str_replace("##USER_DROP##",$u_drop,$tem);
$tem = str_replace("##TEKMA_DROP##",$t_drop,$tem);
$tem = str_replace("##EVENT_ID##",$event_id,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;
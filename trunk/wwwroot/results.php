<?
include "../inc/config.php";


function create_results($res,$title) {
	global $table,$row,$row_category;

	$table.=$row_category;
	$table = str_replace("##TITLE##",$title,$table);
	$x=1;
	while($res->next_record()) {
		$rtable.=$row;
		$rtable =str_replace("##FULL_NAME##",$res->f("full_name"),$rtable);
		$rtable =str_replace("##PLACE##",$x,$rtable);
		$rtable =str_replace("##TIME##",$res->f("end_time"),$rtable);
		$x++;
		}
	$table = str_replace("##RESULTS##",$rtable,$table);
	$rtable = '';
}



//create db object//
$db = new DB_Sql();

//open template//
$tem = template_open("results.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);


$tmp = template_get_repeat_text("##START_EN##","##STOP_EN##","##RESULTS##",$tem);
$row = $tmp[1];
$tem = $tmp[0];

$tmp = template_get_repeat_text("##START_ALL##","##STOP_ALL##","##RESULTS_LIST##",$tem);
$row_category = $tmp[1];
$tem = $tmp[0];



//echo $row_category . "<hr>". $row;




$tekma = $_REQUEST["tekma"];
$event_id = $_REQUEST["event_id"];




if ($tekma and $event_id) {
	
	$sql = "select events.name as ename,tekma.name as tname  from events,tekma where event_id=$event_id and tekma_id=$tekma";
	$db->query($sql);
	$db->next_record();
	$event_name = $db->f("ename");
	$tekma_name = $db->f("tname");
	
	//Pogledamo rezultate za Moske pod 40 let//
        $age="31 and 40";
	$res = get_results("M",$age,"between");
	if ($res->affected_rows()>0) {
                $titleAge=explode(" ",$age);
                create_results($res,$event_name." - ".$tekma_name." - Moški od ".$titleAge[0]." do ".$titleAge[2]." let");
                $age=0;
               }
	        
	//Pogledamo rezultate za Moske ned 21 in 30 let//
        $age="21 and 30";
	$res = get_results("M",$age,"between");
	if ($res->affected_rows()>0) {
                $titleAge=explode(" ",$age);
                create_results($res,$event_name." - ".$tekma_name." - Moški od ".$titleAge[0]." do ".$titleAge[2]." let");
                $age=0;
               }
	
	



}








//replace template variables//
$tem = str_replace("##RESULTS_LIST##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;
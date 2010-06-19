<?
include "../inc/config.php";
$event_id = $_REQUEST["event_id"];
$tekma_id = $_REQUEST["tekma"];
//echo "eventId=".$event_id;
//echo "tekma_id=".$tekma_id;


if (!$event_id or !$tekma_id)
	die("event tekma .. nic ni");


//create db object//
$db = new DB_Sql();
//open template//
$tem = template_open("stop_combo.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);
        

$event_id = $_REQUEST["event_id"];
$tekma = $_REQUEST["tekma"];


  //$user_id = $_REQUEST["user_id"];

 $uId=$user_id;

if ($_REQUEST["user_id"]!='') {
	//we have a submition//

	//$startNum = $_REQUEST["number"];
        $user_id = $_REQUEST["user_id"];
   
	//za nulo pri datumu if (strlen($birthday)!=10) $birthday ='';
	
    ///transform date to timestamp//
  if ($user_id and $tekma and $event_id ) {

	$sql = "update timming set stop ='".microtime_float()."' where user_id=$user_id and tekma_id='$tekma'
      and event_id='$event_id' and stop=0";
	$db->query($sql);
        $success = "true";
	//echo $sql;
	//redirekt to monitor page//
	header("location:".$_SERVER['HTTP_REFERER']);
	exit();
}
echo "Ups??";


}


//get user number with user_id
$sql="SELECT *
FROM users
RIGHT JOIN timming ON timming.user_id = users.id_user
WHERE timming.stop =0";
$db->query($sql);

while ($db->next_record()) {
	$e_names[] = $db->f("number");
	$e_values[] = $db->f("id_user");
}

$id_userdd = html_drop_down_arrays('user_id',$e_names,$e_values,"SELECTIRAN");
//document.form1.field1.select();






//replace template variables//

if (!$success)  {

	$tem = str_replace("##NUMBER##",$number,$tem);

}
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = str_replace("##EVENT_ID##",$event_id,$tem);
$tem = str_replace("##TEKMA##",$tekma,$tem);
$tem = str_replace("##STARTNUM##",$id_userdd,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;




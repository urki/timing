<?
include "../inc/config.php";

//create db object//
$db = new DB_Sql();
//open template//
$tem = template_open("index.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);


if ($_REQUEST["submit"]!='') {
	//we have a submition//
	$sex = $_REQUEST["sex"];
	$event = $_REQUEST["event"];
	$full_name = trim($_REQUEST["full_name"]);
	$birthday = $_REQUEST["birthday"];
	$city = $_REQUEST["city"];
	$number = $_REQUEST["number"];
        $club=$_REQUEST["club"];
	//za nulo pri datumu if (strlen($birthday)!=10) $birthday ='';
	
    ///transform date to timestamp//
    if ($birthday) {
		$btime = explode(".",$birthday);
    	$btime = ($btime[2]."-".$btime[1]."-".$btime[0]);
	}
	if ($sex  and $full_name and $city and $btime and event_id ) {

		//user check//
		//$sql = "select * from users where full_name='$full_name'";
		//$db->query($sql);
		//if ($db->affected_rows()>0) {
		//	$message = "Uporabnik ze obstaja";
		//} else
                    {


		$sql = "INSERT INTO  `timming`.`users` (
				`id_user` ,
				`full_name` ,
				`birthdate` ,
				`sex` ,
				`city` ,
                                `club`,
				`event_id` ,
				`number`
                                
			)
		VALUES (
		NULL ,  '$full_name',  '$btime',  '$sex',  '$city','$club',  '$event',  '$number')";
		$db->query($sql);
		$message = "Vnos uspesen";
		$success = "true";
	}
    } else {
	$message = "Manjkajoca polja!";
	}
}

$names[] = "Moski";
$names[] = "Zenska";
$values[] = "M";
$values[] = "F";

$sex_dd = html_drop_down_arrays('sex',$names,$values,$sex);
//get events
$sql="select * from events";
$db->query($sql);

while ($db->next_record()) {
	$e_names[] = $db->f("name");
	$e_values[] = $db->f("event_id");
}

$event_dd = html_drop_down_arrays('event',$e_names,$e_values,$event);





//replace template variables//
$tem = str_replace("##SEX##",$sex_dd,$tem);
$tem = str_replace("##EVENT##",$event_dd,$tem);
if (!$sucsess)  {
        $tem = str_replace("##CLUB##",$club,$tem);
	$tem = str_replace("##FULL_NAME##",$full_name,$tem);
	$tem = str_replace("##CITY##",$city,$tem);
	$tem = str_replace("##NUMBER##",$number,$tem);
	$tem = str_replace("##CITY##",$city,$tem);
}
$tem = str_replace("##MESSAGE##",$message,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;




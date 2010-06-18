<?
include "../inc/config.php";


//create db object//
$db = new DB_Sql();
//open template//
$tem = template_open("add_user_start_number.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);



  //$user_id = $_REQUEST["user_id"];

 $uId=$user_id;

if ($_REQUEST["submit"]!='') {
	//we have a submition//

	//$startNum = $_REQUEST["number"];
        $user_id = $_REQUEST["user_id"];
   
	//za nulo pri datumu if (strlen($birthday)!=10) $birthday ='';
	
    ///transform date to timestamp//
  
	if ($startNum) {	
                     $sql = "update timming.users set number=$startNum where id_user=$usrId\n"."";
		     $db->query($sql);
		     $message = "Vnos uspesen";
		     $success = "true";
                     header("location:print_user.php?id_user=".$usrId."&link="."&user_start_numbers.php");
                     header( "refresh:1;url=user_start_numbers.php" );
                } else {
	           $message = "Manjkajoca polja!";
	            }
}


//get events
$sql="SELECT autoNum FROM `users` right join start_number on users.number=start_number.autoNum where users.number is null";
$db->query($sql);

while ($db->next_record()) {
	$e_names[] = $db->f("autoNum");
	$e_values[] = $db->f("autoNum");
}

$numdd = html_drop_down_arrays('startNum',$e_names,$e_values,$startNum);







//replace template variables//

if (!$success)  {

	$tem = str_replace("##NUMBER##",$number,$tem);

}
$tem = str_replace("##MESSAGE##",$message,$tem);
$tem = str_replace("##STARTNUM##",$numdd,$tem);
$tem = str_replace("##USRID##",$uId,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;




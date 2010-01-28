<?
include "../inc/config.php";

//create db object//
$db = new DB_Sql();

//open template//
$tem = template_open("tekma_add.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);

if ($_REQUEST["submit"]!='') {
		//then we need to insert a new one//
		$e_name = trim($_REQUEST['name']);
		
		$sql = "select * from tekma where name='$e_name'";
		$db->query($sql);
		if ($db->affected_rows()>0) {
			$message = "Tekma ze obstaja";
		} else {
			$sql = "INSERT INTO  `timming`.`tekma` (
			`tekma_id` ,
			`name`
			)
			VALUES (
			NULL ,  '$e_name')
			";
			$db->query($sql);
			$message = "Tekma uspesno vnesena";
		}

}


//replace template variables//

$tem = str_replace("##MESSAGE##",$message,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;
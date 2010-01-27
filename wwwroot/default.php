<?
include "../inc/config.php";

//create db object//
$db = new DB_Sql();

//open template//
$tem = template_open("index.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);




//replace template variables//

$tem = str_replace("##MESSAGE##",$message,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;
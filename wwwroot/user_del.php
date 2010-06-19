<?
include "../inc/config.php";

//?user_id=1&event_id=1&tekma_id=2

//$event_id = $_REQUEST["event_id"];
//$tekma_id = $_REQUEST["tekma_id"];
$user_id = $_REQUEST["user_id"];
echo "userID=".$user_id;
//create db object//
$db = new DB_Sql();

if ($user_id) {
	
	$sql = "delete * from users where user_id='$user_id'";
	$db->query($sql);

	//echo $sql;
	//redirekt to monitor page//
	header("location:".$_SERVER['HTTP_REFERER']);
	exit();
}

echo "Ups??";




<?
require_once 'template.php';
require_once 'html_functions.php';
require_once 'db.inc';

//$cHOST     = ":/Applications/MAMP/tmp/mysql/mysql.sock";
$cHOST     = "127.0.0.1";
$cDATABASE = "timming";
$cUSER     = "root";
$cPASSWORD = "uR34Ga87";


//$BASE_DIR="/srv/www/htdoc/intranet";
//$BASE_DIR="D:\uros\Programiranje\intranet";
//$BASE_DIR="/Users/mungl/Sites/timming/";
$BASE_DIR="/var/www/timing";

$TEMPLATE_DIR=$BASE_DIR."/templates/";


function get_results($sex,$age,$compare) {
	global $tekma,$event_id;
	
	$db = new DB_sql();
	
	$sql = "SELECT start,stop,full_name,birthdate,sex,number,sec_to_time((stop-start)) as end_time
	FROM  `timming` , users
	WHERE  `timming`.user_id = users.id_user and timming.user_id and 
	(timestampdiff(YEAR,birthdate,now()) $compare $age) and sex='$sex'
	and timming.event_id = $event_id and timming.tekma_id = $tekma order by end_time ASC";
	$db->query($sql);

	return $db;
}

?>

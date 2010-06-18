<?

include "../inc/config.php";



//create db object//
$db = new DB_Sql();

//testiranje če so že vpisani
$sql = "SELECT * FROM `users` LIMIT 0, 30 ";
$db->query($sql);


if ($db->affected_rows()==0) {
         echo 'Ni se vpisan noben tekmovalec - cez priblizno 3s bos preusmerjen na vpis tekmovalcev. Ce ne, klikni na <a href="index.php">tukaj</a>.';

        header( "refresh:5;url=index.php" );
      
	exit();
}




//open template//
$tem = template_open("user_start_numbers.tpl");
//add header footer//
$tem = template_add_head_foot($tem,head,foot);
$tmp = template_get_repeat_text("##START##","##STOP##","##RUNNERS##",$tem);
$row = $tmp[1];
$tem = $tmp[0];


$sql="SELECT *
FROM users, events
WHERE users.event_id=events.event_id and users.number=0
ORDER BY events.event_id, users.number ASC";


$db->query($sql);

//dodaj okmo, ki pove da so vse stevilke vpisane
if ($db->affected_rows()==0) {
?>
        <html>
            <h1>Vsi tekmovalci &#158;e imajo svojo &#353;tartno &#353;tevilko! </h1>
            <br>
            <h2>&#269;ez priblizno 3 sekunde bo&#353; preusmerjen na vnos tekme.</h2>
            <br>
              <h2>&#268;e ne, klikni na <a href="event_list.php">tukaj</a>.</h2>
        </html>

<?php

        header( "refresh:3;url=event_list.php" );

	exit();
}


while ($db->next_record()) {
	$table.=$row;
	$table = str_replace("##NUMBER##",$db->f("number"),$table);
	$table = str_replace("##NAME##",$db->f("full_name"),$table);
	$table = str_replace("##USER_ID##",$db->f("id_user"),$table);
        $table = str_replace("##EVENT_NAME##",$db->f("name"),$table);
	$table = str_replace("##EVENT_ID##",$event_id,$table);
//      $table =str_replace("##BIRTHDATE##",$db->f("birthdate"),$table);
//	$table = str_replace("##TEKMA_ID##",$tekma_id,$table);   (//tudi te ne rabim več saj tu tekma ni pomembna in niti ne vem v katero tekmo bo sla oseba
}


//replace template variables//

$tem = str_replace("##EVENT##",$event_dd,$tem);
$tem = str_replace("##RUNNERS##",$table,$tem);
$tem = str_replace("##MESSAGE##",$message,$tem);
///clean up//
$tem = template_clean_up_tags($tem,"##");
//output of the template//
echo $tem;

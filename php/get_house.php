<?php 

    //回傳交流區大家的首頁

    include("mysql_connect.php");

    $sql = "SELECT m.photo,m.id,m.name,a.title,a.cont,a.datetime "
          ."FROM member m,article a "
          ."where a.no=m.last_art ORDER BY m.last_art DESC";

    $result = mysql_query($sql);

    if (mysql_num_rows($result) > 0) {

    	$article_array = array();
	
    	while($row = mysql_fetch_assoc($result)) {
            $row['cont'] = nl2br($row['cont']);
            $article_array[] = $row;
        }
    
        echo json_encode($article_array);
    }
    else echo 0;

?>

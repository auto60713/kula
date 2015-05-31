<?php session_start(); 

    //回傳個人文章

    $id = $_SESSION['id'];
    session_write_close();

    include("mysql_connect.php");

    $sql = "SELECT * FROM article where author='".trim($id)."' ORDER BY no DESC";
    $result = mysql_query($sql);

    if (mysql_num_rows($result) > 0) {

    	$article_array = array();
	
    	while($row = mysql_fetch_assoc($result)) {
            $article_array[] = $row;
        }
    
        echo json_encode($article_array);
    }
    else echo 0;

?>

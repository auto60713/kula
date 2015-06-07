<?php session_start(); 


if( isset($_GET['art']) ){
    //單篇文章
    $no = $_GET['art'];
    $sql = "SELECT * FROM article where no='".trim($no)."'";
}
else{
    //回傳個人所有文章
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM article where author='".trim($id)."' ORDER BY no DESC";
}

    session_write_close();

    include("mysql_connect.php");

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

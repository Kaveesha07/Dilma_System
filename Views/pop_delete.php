<?php
   
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    $popNo = $_GET["popNo"];

    $delete_query2 = "DELETE FROM poplines WHERE popNo = '{$popNo}';";
    $delete_result2 = $dbConn -> executeQuery($delete_query2);
    
    $delete_query = "DELETE FROM pop WHERE popNo = '{$popNo}';";
    $delete_result = $dbConn -> executeQuery($delete_query);

 
    if($delete_result && $delete_result2){
        header("location: pop_view.php?d_itm=1");
    }else{
        header("location: pop_view.php?d_itm=0");
    }
?>
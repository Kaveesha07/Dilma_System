<?php
   
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    $itmNo = $_GET["itmNo"];

    $status="Inactive";
    $update_query = "UPDATE item SET status = '{$status}' WHERE itmNo = '{$itmNo}'";
    $update_result = $dbConn -> executeQuery($update_query);
    if($update_result){
        header("location: Inventory_item.php?d_itm=1");
    }else{
        header("location: Inventory_item.php?d_itm=0");
    }
?>
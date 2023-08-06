<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    $popNo = $_GET["poNo"];
    //$pop_query = "SELECT * FROM purchaseorder WHERE popNo = '{$popNo}' Limit 1";
    //$pop_arr = $dbConn->executeQuery($pop_query);
    
    //$orh_id = $_GET["orh_id"];
    $pop_query = "SELECT * FROM purchaseorder Where poNo='{$popNo}'";
    $pop_result = $dbConn->executeQuery($pop_query);
    $pop_arr = $pop_result->fetch_array();
  

    /*$pop_result = $dbConn -> executeQuery($pop_query);
    $Postatus="";
    while($row = $pop_result -> fetch_array()){
        $popNo = $row['popNo'];
        $Postatus=$row['status'];
    }*/
 
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/assets/css/styles.css">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <title>Dilma Operations Management System</title>
</head>
<body class="d-flex flex-column h-100">
    <div>
        <?php include('../Shared/nav_header.php')?>
    </div>
    <div class="container px-5 py-4">
        <div class="mt-4">
            <a class="nav nav-item text-decoration-none text-muted mb-2 pt-5 mt-5" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square pe-2"></i>Go back
            </a>
        </div>
        <div class="mt-1 border-bottom">
        </div>
        
            <h3 class="pt-3 display-5">PO Number #<?php echo $pop_arr["popNo"];?></h3>
            
            
        <ul class="list-unstyled fw-light">
        <div class="row">
            <div class="col-10">
            <li class="list-item mb-2">
                <?php 
                if($pop_arr["status"]=="Open"){ ?>
                    <h5>Current Status: <span class="fw-bold badge bg-info text-dark">Open</span></h5>
                    <?php }else if($pop_arr["status"]=="Closed" ){ ?>
                <h5>Current Status: <span class="fw-bold badge bg-warning text-dark">Closed</span></h5>
                    <?php } ?>
            </li>
            </div>
            <div class="col-2">
                <a class="btn btn-sm btn-warning mt-2 mt-md-0" href="purchaseOrder_View.php?poNo=<?php echo $_GET["poNo"]?>&cur_stage=1">Approve PO</a>
            </div>
        </ul>
        <table class="table p-3 w-25">
            <tr >
                        <td ><b>Date :</b></td>
                        <td><?php echo $pop_arr["date"];?></td>
            </tr>
            <tr >
                        <td ><b>Relevant POP :</b></td>
                        <td><?php echo $pop_arr["poNo"];?></td>
            </tr>
            <tr >
                        <td ><b>Total PO :</b></td>
                        <td><?php echo "Rs ".$pop_arr["total"];?></td>
            </tr>
            
        </table>
        <table class="table mt-3 w-75">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody id="purchaseOrderItems">
                        <!-- Purchase order items will be dynamically added here -->
                    </tbody>
                   
        </table>
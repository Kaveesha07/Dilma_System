<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    $popNo = $_GET["popNo"];
    //$pop_query = "SELECT * FROM purchaseorder WHERE popNo = '{$popNo}' Limit 1";
    //$pop_arr = $dbConn->executeQuery($pop_query);
    
    //$orh_id = $_GET["orh_id"];
    $pop_query = "SELECT * FROM pop Where popNo='{$popNo}'";
    $pop_result = $dbConn->executeQuery($pop_query);
    $pop_arr = $pop_result->fetch_array();
  

    $query = "SELECT *  FROM popLines WHERE popNo='{$popNo}'";
    $res = $dbConn->executeQuery($query);
    /*$pop_result = $dbConn -> executeQuery($pop_query);
    $Postatus="";
    while($row = $pop_result -> fetch_array()){
        $popNo = $row['popNo'];
        $Postatus=$row['status'];
    }*/

    
 
?>

<?php
    if(isset($_POST["add_confirm"])){
        $UpopNo = $_POST["UpopNo"];
        

        if($UpopNo !=null)
        {
            $status="Closed";
            $update_query = "UPDATE pop SET status = '{$status}' WHERE popNo = '{$UpopNo}'";
            $update_result = $dbConn -> executeQuery($update_query);
        }
        else{
            $update_result = false;
        }
    
    if($update_result){header("location: pop_view.php?update_pop=1");}
        else{header("location: pop_view.php?update_pop=0");}
        exit(1);
        
    }

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
        
            <h3 class="pt-3 display-5">POP Number #<?php echo $pop_arr["popNo"];?></h3>
            
            
        <ul class="list-unstyled fw-light">
        <div class="row">
            <div class="col-10">
            <li class="list-item mb-2">
                <?php 
                if($pop_arr["status"]=="Open"){ ?>
                    <h5>Current Status: <span class="fw-bold badge bg-info text-dark">Open</span></h5>
                    <?php }else if($pop_arr["status"]=="Closed"){ ?>
                <h5>Current Status: <span class="fw-bold badge bg-warning text-dark">Closed</span></h5>
                    <?php } ?>
            </li>
            </div>
            <div class="col-2">
                <?php 
                if($pop_arr["status"]=="Open" ){ ?>
                <form method="POST" action="pop_details.php" class="form-floating" enctype="multipart/form-data">
                <input type="hidden" name="UpopNo" value="<?php echo $popNo; ?>">
                <button class="btn btn-warning " name="add_confirm" type="submit">Approve POP</button>
            </form>
                <?php } ?>
            </div>
        </ul>
        <table class="table p-3 w-25">
            <tr >
                        <td ><b>Date :</b></td>
                        <td><?php echo $pop_arr["popDate"];?></td>
            </tr>
            <tr >
                        <td ><b>Total POP :</b></td>
                        <!-- <td></td>-->
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
                    <tbody id="pppOrderItems">
                    <?php $i=1; while($row = $res -> fetch_array()){ ?>
                    <tr>

                        <td><?php echo $row["itmNo"];?></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $row["itmQty"];?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                   
        </table>
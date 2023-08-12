<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';
?>

<?php
    if(isset($_POST["add_confirm"])){
        $UpoNo = $_POST["UpoNo"];
        $grnItemNos = $_POST["itmNo"];
        $grnItemNames = $_POST["itmName"];
        $grnItemPrices = $_POST["itmPrice"];
        $grnQtys = $_POST["itmQty"];
        $i=0;
        foreach ($grnItemNos as $grnItemNo){
            
            $checkAvailability = "SELECT itemNo,onHandStock FROM inventory where itemNo ='{$grnItemNo}'";
            $resAvailbility = $dbConn->executeQuery($checkAvailability);
            $grnStock = $grnQtys[$i];
        
            if($rowAvail = $resAvailbility -> fetch_array())
            {
                while($rowAvail = $resAvailbility -> fetch_array())
                {
                    $updateStock = $rowAvail['onHandStock']+$grnStock;
                    $update_inventory = "UPDATE inventory SET onHandStock = $updateStock  WHERE itemNo = $grnItemNo";
                    $update_result_inventory = $dbConn -> executeQuery($update_inventory);   
                }
            }
            else{
            $insert_query = "INSERT INTO inventory (poNo,itemNo,onHandStock) VALUES ($UpoNo,$grnItemNo,$grnStock);";
            $insert_result = $dbConn -> executeQuery($insert_query);
            }
            $i++;
         
        }
        if($UpoNo !=null)
        {
            $status="Closed";
            $update_query = "UPDATE purchaseorder SET status = '{$status}' WHERE poNo = '{$UpoNo}'";
            $update_result = $dbConn -> executeQuery($update_query);
        }
        else{
            $update_result = false;
        }

    if(($insert_result || $update_result_inventory) && $update_result){header("location: purchaseOrder_View.php?update_po=1");}
        else{header("location: purchaseOrder_View.php?update_po=0");}
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <title>Dilma Operations Management System</title>
</head>
<body class="d-flex flex-column h-100">
    <?php include('../Shared/nav_header.php')?>
    <div class="container px-5 py-4">
    <div class="mt-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2 pt-5 mt-5" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square pe-2"></i>Go back
            </a>
        </div >
        <h3 class="mt-3">Good Storage</h3>
        <p>Generate Good Received Notes</p>
        <form method="POST" action="Inventory_GoodReceived.php" class="form-floating" enctype="multipart/form-data" >
              <div class="mb-2 pt-0 w-50">
                    <div class="row mt-4">
                        <div class="d-flex col-6">
                            <input type="text" id="disabledTextInput" name="poNo" class="form-control " placeholder="Enter PO Number" >
                            <button type="submit" name="btnSearch" class="btn btn-warning mx-3">Apply</button>
                        </div>
                    </div>
                </div>
                        <div class="col-12 mt-4">
                            <div class="col-4">
                            <?php 
                                if(isset($_POST["btnSearch"])){
                                    $poNo = $_POST["poNo"];
                                    $status="Open";
                                    $po_query = "SELECT * FROM purchaseorder  Where poNo='{$poNo}' AND status='{$status}'";
                                    $po_result = $dbConn->executeQuery($po_query);
                                    $po_arr = $po_result->fetch_array();

                                    $query = "SELECT *  FROM poLines WHERE poNo='{$poNo}'";
                                    $res = $dbConn->executeQuery($query);

                                    if($po_arr != null){
                                    ?>
                                    <div class="cardBox">
                                    <div class="card p-3 pt-3">
                                        <table class="table">
                                            
                                        <tr >
                                                <td ><b>Date :</b></td>
                                                <td><?php echo $po_arr["date"];?></td>
                                        </tr>
                                        <tr >
                                                <td ><b>PO :</b></td>
                                                <td><?php echo $po_arr["poNo"];?></td>
                                        </tr>
                                        <tr >
                                                <td ><b>Total PO :</b></td>
                                                <td><?php echo "Rs ".$po_arr["total"];?></td>
                                        </tr>
                                        
                                    </table>
                                        <label class="label justify-content-end">
                                                <form method="POST" action="Inventory_GoodReceived.php" class="form-floating" enctype="multipart/form-data">
                                                <input type="hidden" name="UpoNo" value="<?php echo $poNo; ?>">
                                                <button class="btn btn-warning float-right w-50" name="add_confirm" type="submit">Make GRN</button>
                                                
                                        </label>
                                    </div>
                                    </div>
                            </div>
                                <div class="col-12 w-75 mt-3">
                                    <div class="cardBox">
                                    <div class="card p-3 pt-3">
                                    <table class="table mt-3 ">
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
                                            <input type="hidden" name="itmNo[]" value="<?php echo $row["itmNo"];?>">
                                            <td><?php echo $row["itmNo"];?></td>
                                        <?php
                                            $itmNo =$row["itmNo"];
                                            $query2 = "SELECT itmName,itmPrice  FROM item WHERE itmNo=$itmNo";
                                            $res2 = $dbConn->executeQuery($query2);
                                            while($r = $res2 -> fetch_array()){?>
                                                <td><?php echo $r["itmName"];?></td>
                                                <input type="hidden" name="itmName[]" value="<?php echo $r["itmName"];?>">
                                                <td><?php echo $r["itmPrice"];?></td>
                                                <input type="hidden" name="itmPrice[]" value="<?php echo $r["itmPrice"];?>">
                                        <?php }?>
                                            <input type="hidden" name="itmQty[]" value="<?php echo $row["itmQty"];?>">
                                            <td><?php echo $row["itmQty"];?></td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                   
                                    </table>
                                    </div>
                                    </div>
                                </div>
                            <?php }else{ ?>
                               <div class="row row-cols-1 notibar">
                               <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                       class="bi bi-x-circle ms-2" viewBox="0 0 16 16">
                                       <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                       <path
                                           d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                   </svg><span class="ms-2 mt-2">There is no relevant purchase order to GRN</span>
                                   <span class="me-2 float-end"><a class="text-decoration-none link-light" href="purchaseOrder_View.php">X</a></span>
                               </div>
                           </div>     
                           </form>
                            <?php }}  
                            ?>       
                            </div>
                        </div>
                </div>
              </div>
          </form>
    
    </div>
    
</body>
</html>
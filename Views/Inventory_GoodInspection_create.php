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
        $AdjstItemNos = $_POST["itmNo"];
        $AdjstItemNames = $_POST["itmName"];
        $AdjstitmAdjQtys = $_POST["itmAdjQty"];
        $AdjstQtys = $_POST["itmQty"];
        $date =date('Y-m-d');
        $i=0;
        foreach ($AdjstItemNos as $AdjstItemNo){
            $checkAvailability = "SELECT itemNo,onHandStock FROM inventory where itemNo ='{$AdjstItemNo}'";
            $resAvailbility = $dbConn->executeQuery($checkAvailability);
            $AdjstitmAdjQty = $AdjstitmAdjQtys[$i];
           
            while($rowAvail = $resAvailbility -> fetch_array())
            {
            $updateStock = $rowAvail['onHandStock']-$AdjstitmAdjQty;
            $update_inventory = "UPDATE inventory SET rejectedStock=$AdjstitmAdjQty,approvedStock=$updateStock WHERE itemNo = $AdjstItemNo";
            $update_result_inventory = $dbConn -> executeQuery($update_inventory);
            $insert_query = "INSERT INTO rejection (poNo,date,itmNo,itmQty) VALUES ($UpoNo,'$date',$AdjstItemNo,$AdjstitmAdjQty);";
            $insert_result = $dbConn -> executeQuery($insert_query);

            }
            $i++;
            
        }
        if($update_result_inventory && $insert_result ){header("location: inventory_stock.php?update_inv=1");}
        else{header("location: inventory_stock.php?update_inv=0");}
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
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
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
        <h3 class="mt-3">Good Inspection</h3>
        <p>Make new inspection</p>
        <form action ="" method ="post" >
              <div class="mb-4 pt-0 w-50">
                <div class="row mt-4">
                    <div class="col-6">
                        <input type="text" id="disabledTextInput" name="poNo" class="form-control" placeholder="Enter PO Number" >
                    </div>
                    <div class="col-3">
                    <button type="submit" name="btnSearch" class="btn btn-warning ">Apply</button>
                    </div>
                </div>
              </div>
              <div class="col-12 mt-4">
                            <div class="col-4">
                            <?php 
                                if(isset($_POST["btnSearch"])){
                                    $poNo = $_POST["poNo"];
                                    $status="Closed";
                                    $po_query = "SELECT * FROM purchaseorder Where poNo='{$poNo}' AND status='{$status}'";
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
                                                <td ><b>PO No :</b></td>
                                                <td><?php echo $po_arr["poNo"];?></td>
                                        </tr>
                                    
                                        
                                    </table>
                                        
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
                                                <th>GRN Quantity</th>
                                                <th>Rejecting Quantity</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="pppOrderItems">
                                        <?php $i=1; while($row = $res -> fetch_array()){ ?>
                                        <tr>
                                            <input type="hidden" name="itmNo[]" value="<?php echo $row["itmNo"];?>">
                                            <td><?php echo $row["itmNo"];?></td>
                                            <?php 
                                                $itmNo =$row["itmNo"];
                                                $query2 = "SELECT itmName  FROM item WHERE itmNo=$itmNo";
                                                $res2 = $dbConn->executeQuery($query2);
                                                while($r = $res2 -> fetch_array()){?>
                                                    <td><?php echo $r["itmName"];?></td>
                                                    <input type="hidden" name="itmName[]" value="<?php echo $r["itmName"];}?>">
                                            <td><?php echo $row["itmQty"];?></td>
                                            <input type="hidden" name="itmQty[]" value="<?php echo $row["itmQty"];?>">
                                            <td>
                                            <input type="number" step="1" min="0.00" max="<?php echo $row["itmQty"]; ?>"class="form-control" id="itmAdjQty" placeholder="" name="itmAdjQty[]" required>
                               
                                            </td>
                                        </tr>  
                                        <?php } ?>
                                        </tbody>
                   
                                    </table>
                                        <div class="col d-flex justify-content-end">
                                                <form method="POST" action="Inventory_GoodReceived.php" class="form-floating" enctype="multipart/form-data">
                                                <input type="hidden" name="UpoNo" value="<?php echo $po_arr["poNo"]; ?>">
                                                <button class="btn btn-warning w-25" name="add_confirm" type="submit">Complete Inspection</button>
                                                </form>
                                        </div>
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
                        
                            <?php }}  
                            ?>       
                            </div>
                        </div>
          </form>
    
    </div>
</body>
</html>
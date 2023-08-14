<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    //pass through view button in purchase order view
    $poNo = $_GET["poNo"];

    //get purchaseOrder details with poline details
    $po_query = "SELECT l.poNo as lpopNo,l.poNo as lpopNo, l.itmNo as itmNo, l.itmQty as itmQty, p.poNo as poNo,p.popNo as popNo, p.date as pdate, p.status as status,p.total as total
    FROM polines as l,purchaseorder as p WHERE l.poNo=p.poNo AND p.poNo=$poNo";

    $po_result = $dbConn->executeQuery($po_query);
    $po_result2 = $dbConn->executeQuery($po_query);
    $po_arr = $po_result->fetch_array();
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
<body >
    <div class="d-flex flex-column h-100">
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
        
            <h3 class="pt-3 display-5">PO Number #<?php echo $po_arr["poNo"];?></h3>
            
            
        <ul class="list-unstyled fw-light">
        <div class="row">
            <div class="col-10">
            <li class="list-item mb-2">
                <?php 
                //only open po available for approve
                if($po_arr["status"]=="Open"){ ?>
                    <h5>Current Status: <span class="fw-bold badge bg-info text-dark">Open</span></h5>
                    <?php }else if($po_arr["status"]=="Closed" ){ ?>
                <h5>Current Status: <span class="fw-bold badge bg-warning text-dark">Closed</span></h5>
                    <?php } ?>
            </li>
            </div>
            <div class="col-2">
            
        </ul>
        <table class="table p-3 w-25">
            <tr >
                        <td ><b>Date :</b></td>
                        <td><?php echo $po_arr["pdate"];?></td>
            </tr>
            <tr >
                        <td ><b>Relevant POP :</b></td>
                        <td><?php echo $po_arr["popNo"];?></td>
            </tr>
            <tr >
                        <td ><b>Total PO :</b></td>
                        <td><?php echo "Rs ".$po_arr["total"];?></td>
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
                    <?php 
                    $i=1; while($row = $po_result2 -> fetch_array()){ ?>
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
                   
        </table>
    </div>
    </div>
</body>
    <div class="flex mt-5">
    <?php include('../Shared/footer.php')?>
  </div>

</html>
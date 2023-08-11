<?php
     $path = $_SERVER['DOCUMENT_ROOT'];
     $path .= "/Dilma_System";
     $db_path = $path . "/DataAccess";
     include $db_path.'/DBconnection.php';
    
    

    if(isset($_POST["add_confirm"])){
        $UpopNo = $_POST["UpopNo"];
        $poItemNos = $_POST["itmNo"];
        $poItemNames = $_POST["itmName"];
        $poItemPrices = $_POST["itmPrice"];
        $poQtys = $_POST["itmQty"];
        $totalamount = $_POST["totalamount"];
        

        if($UpopNo !=null)
        {
            $status="Closed";
            $update_query = "UPDATE pop SET status = '{$status}' WHERE popNo = '{$UpopNo}'";
            $update_result = $dbConn -> executeQuery($update_query);
            $date =date('Y-m-d');
            $poStatus="Open";
            $insert_query = "INSERT INTO purchaseorder (popNo,date,status,total) VALUES ($UpopNo,'$date','$poStatus',$totalamount);";
            $insert_result = $dbConn -> executeQuery($insert_query);

            $ReadSql5 = "SELECT poNo FROM purchaseorder where popNo = '{$UpopNo}'";
            $resPOList = $dbConn->executeQuery($ReadSql5);

            if ($resPOList->num_rows > 0) {
                while ($ro = $resPOList->fetch_assoc()) {
                    $poNo = $ro["poNo"];
            }}
            $i=0;
            foreach ($poItemNos as $poItemNo){
 
                $poItemName = $poItemNames[$i];
                $poItemPrice = $poItemPrices[$i];
                $poQty = $poQtys[$i];

                $insert_query2 = "INSERT INTO polines (poNo,popNo,itmNo,itmQty) VALUES ($poNo,$UpopNo,$poItemNo,$poQty);";
                $insert_result = $dbConn -> executeQuery($insert_query2);
                $i++; 
            }


        }
        else{
            $update_result = false;
            $insert_result=false;
        }
    
    if($update_result && $insert_result){header("location: pop_view.php?update_pop=1");}
        else{header("location: pop_view.php?update_pop=0");}
        exit(1);
        
    }

?>

<?php
 
   
    $popNo = $_GET["popNo"];

    //$pop_query = "SELECT * FROM purchaseorder WHERE popNo = '{$popNo}' Limit 1";
    //$pop_arr = $dbConn->executeQuery($pop_query);
    
    //$orh_id = $_GET["orh_id"];
    //$pop_query = "SELECT * FROM pop Where popNo='{$popNo}'";
    //$pop_result = $dbConn->executeQuery($pop_query);
    //$pop_arr = $pop_result->fetch_array();

    //$ReadSql5 = "SELECT o.order_date as odate,c.name as cname,ct.qty as cqty FROM orders as o ,customer as c ,cart as ct where c.id=ct.customer_id AND c.id=o.customer_id";
    //$res5 = $dbConn->executeQuery($ReadSql5);
  

    $pop_query = "SELECT l.popNo as lpopNo, l.itmNo as itmNo, l.itmQty as itmQty, p.popNo as popNo, p.popDate as popDate, p.status as status,p.totalamount as totalamount
    FROM popLines as l,pop as p WHERE l.popNo=p.popNo AND p.popNo=$popNo";
    $pop_result = $dbConn->executeQuery($pop_query);
    $pop_result2 = $dbConn->executeQuery($pop_query);
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
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
           
                <?php } ?>
            </div>
        </ul>
        <table class="table p-3 w-25">
            <tr >
                        <td ><b>Date :</b>
                      <?php echo $pop_arr["popDate"];?></td>
            </tr>
            <tr >
                        <input type="hidden" name="totalamount" value="<?php echo $pop_arr["totalamount"];?>">
                        <td ><b>Total POP :</b><?php echo "  Rs. ".$pop_arr["totalamount"];?></td>
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
                    <?php $i=0; while($row = $pop_result2 -> fetch_array()){ ?>
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
    <div class="flex mt-5">
    <?php include('../Shared/footer.php')?>
  </div>
</body>
</html>
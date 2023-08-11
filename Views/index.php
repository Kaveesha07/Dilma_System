<?php include('../Shared/nav_header.php')?>
<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';
    
    $ReadSql = "SELECT count(*) as count FROM purchaseorder Where status ='Open'";
    $resPO = $dbConn->executeQuery($ReadSql);

    $ReadSql2 = "SELECT count(*) as count FROM item";
    $resItem = $dbConn->executeQuery($ReadSql2);

    $ReadSql3 = "SELECT sum(itmQty) as count FROM allocation where itmQty>0";
    $resAllocated = $dbConn->executeQuery($ReadSql3);

    $ReadSql4 = "SELECT sum(rejectedStock) as count FROM inventory where rejectedStock>0";
    $resRejected = $dbConn->executeQuery($ReadSql4);

    $ReadSql5 = "SELECT *  FROM purchaseorder ORDER BY date DESC LIMIT 20";
    $resPOList = $dbConn->executeQuery($ReadSql5);
    
    $ReadSql6 = "SELECT salesRepName FROM sales_rep ";
    $resSalePList = $dbConn->executeQuery($ReadSql6);

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
    <title>Dilma Operations Management System</title>

    <style>

* {

  margin: 0;
  padding: 0;
  box-sizing: border-box;
  
}

:root {
  --brown: #A52A2A;
  --white: #ffffff;
  --gray: #f5f5f5;
  --black1: #222;
  --black2: #999;
}

body {
  margin-top: 20pt;
  min-height: 100vh;
  overflow-x: hidden;
  font-family: 'Poppins', sans-serif;
}

.container {
  position: relative;
  width: 100%;
}


.cardBox {
  position: relative;
  width: 100%;
  padding: 20px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 30px;
}

.cardBox .card {
  position: relative;
  background: var(--white);
  padding: 30px;
  border-radius: 20px;
  display: flex;
  justify-content: space-between;
  cursor: pointer;
  box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
}

.cardBox .card .numbers {
  position: relative;
  font-weight: 500;
  font-size: 2.5rem;
  color: var(--blue);
}

.cardBox .card .cardName {
  color: var(--black2);
  font-size: 1.1rem;
  margin-top: 5px;
}

.cardBox .card .iconBx {
  font-size: 3.5rem;
  color: var(--black2);
}

.cardBox .card:hover {
  background: var(--brown);
}
.cardBox .card:hover .numbers,
.cardBox .card:hover .cardName,
.cardBox .card:hover .iconBx {
  color: var(--white);
}

.details {
  position: relative;
  width: 100%;
  padding: 20px;
  display: grid;
  grid-template-columns: 2fr 1fr;
  grid-gap: 30px;

}

.details .recentOrders {
  position: relative;
  
  min-height: 500px;
  background: var(--white);
  padding: 20px;
  box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
  border-radius: 20px;
}

.details .cardHeader {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}
.cardHeader h2 {
  font-weight: 600;
  color: var(--brown);
}

.salespersons .btn {
  margin-top: 10px;
  position: relative;
  padding: 5px 10px;
  text-decoration: none;
  border-radius: 6px;

}

.details table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}
.details table thead td {
  font-weight: 600;
}
.details .recentOrders table tr {
  color: var(--black1);
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
.details .recentOrders table tr:last-child {
  border-bottom: none;
}
.details .recentOrders table tbody tr:hover {
  background: var(--brown);
  color: var(--white);
}
.details .recentOrders table tr td {
  padding: 10px;
}

.salespersons {
  position: relative;
  min-height: 500px;
  padding: 20px;
  background: var(--white);
  box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
  border-radius: 20px;
}
.salespersons table tr td {
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  padding: 10px;
}
.salespersons table tr{
  color: #222;
}

.salespersons table tr td {
  padding: 4px 10px;
  
}
.salespersons table tr td {
  padding: 10px;
}

.salespersons table tr td h4 {
  
  font-size: 16px;
  font-weight: 500;
  line-height: 1.2rem;
}
.salespersons table tr td h4 span {
  font-size: 14px;
  color: var(--black2);
}

.details .salespersons table tbody tr:hover {
  background: var(--brown);
  color: var(--white);
}

.salespersons table tbody{
  color: #f5f5f5;
}


/* ====================== Responsive Design ========================== */
@media (max-width: 991px) {
  .navigation {
    left: -300px;
  }
  .navigation.active {
    width: 300px;
    left: 0;
  }
  .main {
    width: 100%;
    left: 0;
  }
  .main.active {
    left: 300px;
  }
  .cardBox {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .details {
    grid-template-columns: 1fr;
  }
  .recentOrders {
    overflow-x: auto;
  }
  .status.inProgress {
    white-space: nowrap;
  }
}

@media (max-width: 480px) {
  .cardBox {
    grid-template-columns: repeat(1, 1fr);
  }
  .cardHeader h2 {
    font-size: 20px;
  }
  .user {
    min-width: 40px;
  }
  
  .main.active .toggle {
    color: #fff;
    position: fixed;
    right: 0;
    left: initial;
  }

}
    </style>
</head>
<body >
   
<div class="container mt-5">     
    <div class="pt-5">
            <!-- ======================= Cards ================== -->
            <div class="cardBox">
            <a  href="purchaseOrder_View.php " style="text-decoration: none; color: black;" >
                <div class="card text-center">
                    <div class="text-center">
                        <?php
                        if (mysqli_num_rows($resPO) > 0) {
							        $row = mysqli_fetch_assoc($resPO);
                                    $count = $row["count"];
                        }?>
                        <div class="numbers"><?php echo $count ?></div>
                        <div class="cardName">Open Purchase Orders</div>
                    </div>

                    <div class="iconBx mt-1">
                      <i class="bi bi-file-earmark" style="font-size: 35px;"></i>
                    </div>
                </div>
                </a>
            <a  href="Inventory_item.php " style="text-decoration: none; color: black;" >
                <div class="card text-center">
                    <div>
                        <?php
                        if (mysqli_num_rows($resItem) > 0) {
							        $row = mysqli_fetch_assoc($resItem);
                                    $count = $row["count"];
                        }?>
                        <div class="numbers"><?php echo $count ?></div>
                        <div class="cardName">Items</div>
                    </div>

                    <div class="iconBx  mt-1">
                      <i class="bi bi-box" style="font-size: 35px;"></i>
                    </div>
                </div>
            </a>
            <a  href="Inventory_GoodAllocation_View.php " style="text-decoration: none; color: black;" >
                <div class="card text-center">
                    <div>
                        <?php
                            if (mysqli_num_rows($resAllocated) > 0) {
                                        $row = mysqli_fetch_assoc($resAllocated);
                                        $count = $row["count"];
                            }?>
                        <div class="numbers"><?php echo $count ?></div>
                        <div class="cardName">Allocated Goods</div>
                    </div>

                    <div class="iconBx mt-1">
                      <i class="bi bi-card-checklist" style="font-size: 35px;"></i>
                    </div>
                </div>
            </a>
            <a  href="Inventory_GoodRejection.php" style="text-decoration: none; color: black;" >
                <div class="card text-center">
                    <div>
                        <?php
                            if (mysqli_num_rows($resAllocated) > 0) {
                                        $row = mysqli_fetch_assoc($resRejected);
                                        $count = $row["count"];
                            }?>
                        <div class="numbers"><?php echo $count ?></div>
                        <div class="cardName">Rejected Goods</div>
                    </div>
            

                    <div class="iconBx mt-1">
                      <i class="bi bi-box-arrow-up-left" style="font-size: 35px;"></i>
                    </div>
                </div>
            </a>
            </div>


            <!-- ================ Purchase Order Details List ================= -->
            <div class="details">
                <div class="recentOrders p-5">
                    <div class="cardHeader">
                        <h2>Recent Purchase Orders</h2>
                        <a href="purchaseOrder_View.php" class="btn btn-warning">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr style="text-align: center;"> 
                                <td>PO Number </td>
                                <td>Date</td>
                                <td>Amount</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            if ($resPOList->num_rows > 0) 
                            {
                                while ($row = $resPOList->fetch_assoc()) 
                                {
                            ?> 
                            <tr style="text-align: center;">
                                <td><?php echo $row["poNo"];?></td>
                                <td><?php echo $row["date"];?></td>
                                <td><?php echo $row["total"];?></td>
                                <td><?php echo $row["status"];?></td>
                                <td>
                            </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="salespersons">
                    <div class="cardHeader mt-4 mx-2">
                        <h2>Our Sales Persons</h2>
                    </div>
                    <table>
                      <thead>
                            <tr> 
                                <td>Sale Person Name </td>
                                
                            </tr>
                        </thead>
                      <tbody>
                          <?php
                            if ($resSalePList->num_rows > 0) 
                                {
                                    while ($row = $resSalePList->fetch_assoc()) 
                                    {
                            ?> 
                                <tr >
                                    <td><?php echo $row["salesRepName"];?></td>
                                </tr>
                    
                            <?php }
                              } ?>
                                  
                        </tbody>  
                     </table>
                        <a href="Inventory_GoodAllocation_View.php" class="btn btn-warning float-right" style="text-align: center;">View All</a> 
                </div>
            </div>
        </div>
    </div>
</body>
    
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
  <div class="flex">
    <?php include('../Shared/footer.php')?>
  </div>


</html>
</body>
</html>

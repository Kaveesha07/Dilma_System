<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';
    
    $query = "SELECT *  FROM inventory";
    $res = $dbConn->executeQuery($query);
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
        <div class="mt-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2 pt-5 mt-5" href="#" onclick="history.back();">
                    <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>
        </div>
        <h3 class="mt-3">Inventory Management</h3>
        <p>Monitor and search inventory details</p>
        <div class="d-flex">
        <a href="Inventory_item.php" class="btn btn-sm btn-primary ">View Item Master</a>
        </div>
        <div class="mt-3">
            <?php 
            if(isset($_GET["update_inv"])){
                if($_GET["update_inv"]==1){
                    ?>
            <!-- START SUCCESSFULLY ADD A ITEM -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle ms-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                    <span class="ms-2 mt-2">Successfully rejected items in the purchase order.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="inventory_stock.php">X</a></span>
                </div>
            </div>
            <!-- END SUCCESSFULLY ADD A ITEM -->
            <?php }else{ ?>
            <!-- START FAILED FOOD ADD A ITEM -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-circle ms-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg><span class="ms-2 mt-2">Failed to reject the items of purchase order.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="inventory_stock.php">X</a></span>
                </div>
            </div>
            <!-- END FAILED ADD A ITEM -->
            <?php }
                }
            ?>
        </div>
        <div class="mt-5">
        <form class="form-floating mb-3" method="GET" action="inventory_stock.php">
                <div class="row g-2">
                    
                    <div class="col">
                        <input type="text" class="form-control" id="itemNo" name="itemNo" placeholder="Item Number"
                            <?php if(isset($_GET["search"])){?>value="<?php echo $_GET["itemNo"];?>" <?php } ?>>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="search" class="btn btn-success">Search</button>
                        <button type="reset" class="btn btn-danger"
                            onclick="javascript: window.location='inventory_stock.php'">Clear</button>
                        <a href="Inventory_GoodInspection_create.php" class="btn btn-primary">Make Inspection</a>
                        
                    </div>
                </div>
            </form>
            </div>
  
            <div class="pt-2" id="item-table">

        <?php
            if(!isset($_GET["search"])){
                $search_query = "SELECT * FROM inventory;";
            }else{
                $search_fn=$_GET["itemNo"];
                $search_query = "SELECT * FROM inventory i WHERE itemNo LIKE '%{$search_fn}%';";
            }
            $search_result = $dbConn -> executeQuery($search_query);
            //$search_result = $dbConn->executeQuery($query);
            $search_numrow = $search_result -> num_rows;
            if($search_numrow == 0){
        ?>
        <div class="row">
            <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-x-circle ms-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                </svg><span class="ms-2 mt-2">No Items found!</span>
                <a href="inventory_stock.php" class="text-white">Clear Search Result</a>
            </div>
        </div>
        <?php } else{ ?>
        <div class="table-responsive">
        <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-5">
            <caption><?php echo $search_numrow;?> Items(s) <?php if(isset($_GET["search"])){?><br /><a
                    href="inventory_stock.php" class="text-decoration-none text-danger">Clear Search
                    Result</a><?php } ?></caption>
            <thead class="bg-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item Number</th>
                    <th scope="col">On Hand Stock</th>
                    <th scope="col">Approved Stock</th>
                    <th scope="col">Rejected Stock</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php $i=1; while($row = $search_result -> fetch_array()){ ?>
                <tr>
                    <th><?php echo $i++;?></th>
                    <td><?php echo $row["itemNo"];?></td>
                    <td><?php echo $row["onHandStock"];?></td>
                    <td><?php echo $row["approvedStock"];?></td>
                    <td><?php echo $row["rejectedStock"];?></td>
                   
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <?php }
            $search_result -> free_result();
        ?>
        </div>
        </div>
</body>

<php ?>
<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';
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
        <h3 class=" mt-3">Purchase Orders</h3>
        <p>Monitor and search purchase order details</p>
        <div>
        <form class="form-floating mb-3" method="GET" action="purchaseOrder_View.php">
                <div class="row g-2">
                    
                    <div class="col-6">
                        <input type="text" class="form-control" id="poNo" name="poNo" placeholder="Purchase Order Number"
                            <?php if(isset($_GET["search"])){?>value="<?php echo $_GET["poNo"];?>" <?php } ?>>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="search" class="btn btn-success">Search</button>
                        <button type="reset" class="btn btn-danger"
                            onclick="javascript: window.location='purchaseOrder_View.php'">Clear</button>
                        
                    </div>
                </div>
            </form>
            </div>
  
            <div class="pt-2" id="pop-table">

        <?php
            if(!isset($_GET["search"])){
                $search_query = "SELECT * FROM purchaseorder;";
            }else{
                $search_fn=$_GET["poNo"];
                $search_query = "SELECT * FROM purchaseorder i WHERE poNo LIKE '%{$search_fn}%';";
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
                </svg><span class="ms-2 mt-2">No Purchase Orders found!</span>
                <a href="purchaseOrder_View.php" class="text-white">Clear Search Result</a>
            </div>
        </div>
        <?php } else{ ?>
        <div class="table-responsive">
        <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-5">
            <caption><?php echo $search_numrow;?> Purchase Order(s) <?php if(isset($_GET["search"])){?><br /><a
                    href="purchaseOrder_View.php" class="text-decoration-none text-danger">Clear Search
                    Result</a><?php } ?></caption>
            <thead class="bg-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">PO Number</th>
                    <th scope="col">POP Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; while($row = $search_result -> fetch_array()){ ?>
                <tr>
                    <th><?php echo $i++;?></th>
                    <td><?php echo $row["popNo"];?></td>
                    <td><?php echo $row["poNo"];?></td>
                    <td><?php echo $row["date"];?></td>
                    <td><?php echo $row["status"];?></td>
                    <td><?php echo $row["total"];?></td>
                    <td>
                        <a href="purchaseOrder_details.php?poNo=<?php echo $row["poNo"]?>"
                            class="btn btn-sm btn-primary">View</a>
                    </td>
                    </td>
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
        
    
    </div>
</body>

<php ?>
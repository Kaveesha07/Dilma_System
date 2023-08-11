<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    /*$query = "SELECT itmNo FROM item ORDER BY itmNo DESC LIMIT 1";
    $result = $dbConn->executeQuery($query);
    while($row = $result -> fetch_array()){ 
        
    }*/

    if(isset($_POST["add_confirm"])){
        $itmName = $_POST["itmName"];
        $itmDesc = $_POST["itmDesc"];
        $itmPrice = $_POST["itmPrice"];

        if($itmName !=null && $itmDesc !=null && $itmPrice !=null)
        {
            $insert_query = "INSERT INTO item (itmName,itmDesc,itmPrice)
            VALUES ('{$itmName}','{$itmDesc}',{$itmPrice});";
            $insert_result = $dbConn -> executeQuery($insert_query);
        }
        else{
            $insert_result = false;
        }
    
    if($insert_result){header("location: Inventory_item.php?add_fdt=1");}
        else{header("location: Inventory_item.php?add_fdt=0");}
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
    <div>
        <?php include('../Shared/nav_header.php')?>
    </div>
    <div class="container px-5 py-4">
        <div class="mt-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2 pt-5 mt-5" href="#" onclick="history.back();">
                <i class="bi bi-arrow-left-square me-2"></i>Go back
            </a>
        </div>

        
    <div class="container form-signin mt-auto w-50">
        <form method="POST" action="Inventory_Item_add.php" class="form-floating" enctype="multipart/form-data">
            <h2 class="mt-4 mb-3 fw-normal text-bold"><i class="bi bi-pencil-square me-2"></i>Add New Item</h2>
            <p>Enter new item details here</p>
            
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="itmName" placeholder="itmName" name="itmName" required>
                <label for="itmName">Item Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="itmDesc" placeholder="itmDesc" name="itmDesc" required>
                <label for="itmDesc">Item Description</label>
            </div>
            <div class="form-floating mb-2">
                <input type="number" step="0.25" min="0.00" max="20000" class="form-control" id="itmPrice" placeholder="Price (Rs.)" name="itmPrice" required>
                <label for="itmPrice">Price (Rs.)</label>
            </div>
            
            <button class="w-50 btn btn-warning mb-3 " name="add_confirm" type="submit">Add Item</button>
        </form>
    </div>
    </div>
    <div class="flex pt-5 mt-5">
    <?php include('../Shared/footer.php')?>
  </div>
</body>
</html>
    
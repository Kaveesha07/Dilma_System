<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';
    
    $query = "SELECT *  FROM inventory where rejectedStock>0";
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
            <i class="bi bi-arrow-left-square pe-2"></i>Go back
            </a>
        </div >
        <h3 class="mt-3">Rejected Goods</h3>
        <p>Monitor and search rejected goods details</p>

        <div class="table-responsive">
        <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-5">
            <caption></caption>
            <thead class="bg-light">
                <tr>
                    <th scope="col">Item Number</th>
                    <th scope="col">Rejected Quantity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
				if ($res->num_rows > 0) 
                {
					while ($row = $res->fetch_assoc()) 
                    {
				?> 
                <tr>
                    <td><?php echo $row["itemNo"];?></td>
                    <td><?php echo $row["rejectedStock"];?></td>
                    <td>
                        <a href="admin_customer_detail.php?c_id=<?php echo $row["itemNo"]?>"
                            class="btn btn-sm btn-primary">View</a>
                        <a href="admin_customer_delete.php?c_id=<?php echo $row["itemNo"]?>"
                            class="btn btn-sm btn-outline-danger">Delete</a>
                    </td>
                </tr>
                <?php }
				} ?>
            </tbody>
        </table>
</body>

<php ?>
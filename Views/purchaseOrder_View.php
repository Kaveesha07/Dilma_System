<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';
    
    $query = "SELECT *  FROM purchaseorder";
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
    <link href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <title>Dilma Operations Management System</title>
</head>
<body class="d-flex flex-column h-100">
    <div>
        <?php include('../Shared/nav_header.php')?>
    </div>
    <div class="container px-5 py-4">
        <h3 class="pt-5 mt-5">Purchase Orders</h3>
        <div class="table-responsive">
        <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-5">
            <caption></caption>
            <thead class="bg-light">
                <tr>
                    <th scope="col">PO Number</th>
                    <th scope="col">POP Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
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
                    <th><?php echo $row["popNo"];?></th>
                    <td><?php echo $row["poNo"];?></td>
                    <td><?php echo $row["date"];?></td>
                    <td><?php echo $row["status"];?></td>
                    <td><?php echo $row["total"];?></td>
                    <td>
                        <a href="admin_customer_detail.php?c_id=<?php echo $row["poNo"]?>"
                            class="btn btn-sm btn-primary">View</a>
                        <a href="admin_customer_delete.php?c_id=<?php echo $row["poNo"]?>"
                            class="btn btn-sm btn-outline-danger">Delete</a>
                    </td>
                </tr>
                <?php }
				} ?>
            </tbody>
        </table>
</body>

<php ?>
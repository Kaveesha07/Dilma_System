
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
    <?php include('../Shared/nav_header.php')?>
    <div class="container px-5 py-4">

        <h3 class="pt-5 mt-5">Create Purchase Order Proposal</h3>
        <h4 class="pt-4">Add Items</h4>
        <form action ="" method ="post" >
              <div class="mb-4 pt-0 w-50">
                <input type="text" id="disabledTextInput" name="itmName" class="form-control" placeholder="Item Name">
              </div>
              <div class="mb-4 pb-1 w-50">
                <input type="text" id="disabledTextInput" name="itmQty" class="form-control" placeholder="Quantity">
                
              </div>
              <div>
                <button type="submit" name="btncategory" class="btn btn-warning ">Add Category</button>
                <button type="reset" class="btn btn-warning ms-3">Reset</button>
              </div>

          </form>
    
    </div>
</body>
</html>

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

        <h3 class="pt-5 mt-5">Good Storage</h3>
        <p>Details of stored goods</p>
        <form action ="" method ="post" >
              <div class="mb-4 pt-0 w-50">
                <div class="row mt-5">
                    <div class="col-6">
                        <input type="text" id="disabledTextInput" name="itmName" class="form-control" placeholder="Enter PO Number" required>
                    </div>
                    <div class="col-3">
                    <button type="submit" name="btnSearch" class="btn btn-warning ">Apply</button>
                    </div>
                </div>
              </div>
          </form>
    
    </div>
</body>
</html>
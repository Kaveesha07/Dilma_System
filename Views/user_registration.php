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
<div class="container px-5 py-4">
<div class="mt-4">
    <div>
        <?php include('../Shared/nav_header_reg.php')?>
        
        <a class="nav nav-item text-decoration-none text-muted mb-2 pt-5 mt-5" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <div class="cardBox">
        <div class="card text-center ">
        <div class="container form-signin mt-auto w-50">
        <form method="POST" action="add_cust.php" class="form-signin " >
            <h2 class="mt-4 mb-3 fw-normal text-bold"><i class="bi bi-person-plus me-2"></i>Sign Up</h2>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                    minlength="5" maxlength="45" required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="pwd" placeholder="Password" name="pwd" minlength="8"
                    maxlength="45" required>
                <label for="pwd">Password</label>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="cfpwd" placeholder="Confirm Password" minlength="8"
                    maxlength="45" name="cfpwd" required>
                <label for="cfpwd">Confirm Password</label>
                <div id="passwordHelpBlock" class="form-text smaller-font">
                    Your password must be at least 8 characters long.
                </div>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="firstname" placeholder="Operator Full Name" name="fullname"
                    required>
                <label for="firstname">Operator Full Name</label>
            </div>
            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" required>
                <label for="email">E-mail</label>
            </div>  
            <div class="form-floating">
                <div class="mb-2 form-check">
                    <input type="checkbox" class="form-check-input " id="tandc" name="tandc" required>
                    <label class="form-check-label small" for="tandc">I agree to the terms and conditions and the
                        privacy policy</label>
                </div>
            </div>
            <button class="w-100 btn btn-success mb-3" type="submit">Sign Up</button>
        </form>
    </div>
        </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="flex mt-5">
    <?php include('../Shared/footer.php')?>
  </div>
</body>
</html>

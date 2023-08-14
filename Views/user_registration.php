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
    <!-- boostarap and fonts import here -->
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
        <!-- import header -->
        <?php include('../Shared/nav_header_reg.php')?>
        
        <a class="nav nav-item text-decoration-none text-muted mb-2 pt-5 mt-5" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square me-2"></i>Go back
        </a>
        <div >
            <?php 
            //registraion check using registraion accept and output message here
            if(isset($_GET["reg_up"])){
                if($_GET["reg_up"]==1){
                    ?>
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle ms-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                    <span class="ms-2 mt-2">Successfully created your account.<a class="text-decoration-none link-light" href="user_login.php"> Click here to Login.</a></span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="user_registration.php">X</a></span>
                </div>
            </div>
            <?php }else{ ?>
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-circle ms-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg><span class="ms-2 mt-2">Failed to created your account.<a class="text-decoration-none link-light" href="user_login.php"> Click here to Login</a></span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="user_registration.php">X</a></span>
                </div>
            </div>
            <?php }
                }
            ?>
        </div>
        <div class="cardBox">
        <div class="card text-center ">
        <div class="container form-signin mt-auto w-50">
        <form method="POST" action="user_registration_accept.php" class="form-signin " >
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
                <input type="text" class="form-control" id="fullname" placeholder="Operator Full Name" name="fullname"
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

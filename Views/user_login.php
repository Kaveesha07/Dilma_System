<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
        font-family: 'Poppins', sans-serif;
        }
        .cardBox .card {
            position: relative;
            background: white;
            padding: 30px;
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="loginBg">
    <div class="container ">
        <div class="row">
            <div class="col-6 mt-3 ">
                <img src="assets/images/logo.png" alt="Logo.jpg" height="250 ">
            </div>
            <div class="col-4">
            <div class="cardBox">
                <div class="card p-3">
                <form method="POST" action="check_login.php" class="form-floating">
                    <h2 class="mt-4 mb-3 fw-normal text-bold" style="text-align: center;"><i class="bi bi-door-open me-2"></i>Sign in</h2>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" required>
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pwd" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="w-100 btn btn-warning mb-3" type="submit">Log In</button>
                    <a class="nav nav-item text-decoration-none text-muted mb-2 small" href="admin_login.php">
                        <i class="bi bi-shop me-2"></i>Log in to Admin
                    </a>
                    <!--<a class="nav nav-item text-decoration-none text-muted mb-2 small" href="cust_forgot_pwd.php">
                        <i class="bi bi-key me-2"></i>Forgot your password?-->
                    </a>
                    <a class="nav nav-item text-decoration-none text-muted mb-2 small" href="user_registration.php">
                        <i class="bi bi-person-plus me-2"></i>Create your new account
                    </a>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
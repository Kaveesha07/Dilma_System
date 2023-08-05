
<header class="navbar  navbar-expand-md fixed-top shadow-sm mb-auto">
    <div class="container-fluid mx-3">
        <a href="index.php">
            <img src="../views/assets/images/logo.png" width="100" class="me-3 ms-5" alt="Logo">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarCollapse">

            <ul class="navbar-nav me-auto mb-2 mb-md-0 ms-5">
                <li class="nav-item">
                    <a class="nav-link px-2 " href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a href="pop_view.php" class="nav-link px-2 ">POP</a>
                </li>
                <li class="nav-item">
                    <a href="purchaseOrder_View.php" class="nav-link px-2 ">Purchase Order</a>
                </li>

                <li class="nav-item">
                    <a href="inventory_stock.php" class="nav-link px-2 ">Inventory</a>
                </li>
                <li class="nav-item">
                    <a href="Inventory_GoodReceived.php" class="nav-link px-2 ">GRN</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php if(!isset($_SESSION['cid'])){ ?>
                <a class="btn btn-warning" href="user_login.php">Log Out</a>
                
                <?php }else{ ?>


                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a href="cust_profile.php" class="nav-link px-2 text-dark">
                            Welcome, <?=$_SESSION['operatorName']?>
                            
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="mx-2 mt-1 mt-md-0 btn btn-outline-danger" href="user_login.php">Log Out</a>
                    </li>
                </ul>
                <?php } ?>
            </div>
        </div>
    </div>


    <link rel="stylesheet" href="../views/assets/css/styles.css">
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
    <link href="../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
</header>
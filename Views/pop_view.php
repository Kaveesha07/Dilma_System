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
    <?php include('../Shared/nav_header.php')?>
    <div class="container px-5 py-4">
    <div class="mt-4 border-bottom">
            <a class="nav nav-item text-decoration-none text-muted mb-2 pt-5 mt-5" href="#" onclick="history.back();">
            <i class="bi bi-arrow-left-square pe-2"></i>Go back
            </a>
        </div>
        <h3 class=" mt-3">Purchase Order Proposals</h3>
        <p>Monitor and search purchase order proposal details</p>
        <div>
            <div>
        <?php {
            
            if(isset($_GET["add_pop"])){
                if($_GET["add_pop"]==1){
                    ?>
             <!-- message for sucesfully add pop -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle ms-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                    <span class="ms-2 mt-2">Successfully add a new purchase proposal.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="pop_view.php.">X</a></span>
                </div>
            </div>

            <?php }else{ ?>
            <!-- message for faild to add pop -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-circle ms-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg><span class="ms-2 mt-2">Failed to add a new item.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="pop_view.php">X</a></span>
                </div>
            </div>
            <?php }
                }
            }
            ?>
        </div>
        <div >
            <?php 
            if(isset($_GET["update_pop"])){
                if($_GET["update_pop"]==1){
                    ?>
            <!-- message for sucesfully update pop -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle ms-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                    </svg>
                    <span class="ms-2 mt-2">Successfully approve the purchase order proposal.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="pop_view.php">X</a></span>
                </div>
            </div>

            <?php }else{ ?>
            <!-- message for faild to update pop -->
            <div class="row row-cols-1 notibar">
                <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-circle ms-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg><span class="ms-2 mt-2">Failed to approve the purchase order proposal.</span>
                    <span class="me-2 float-end"><a class="text-decoration-none link-light" href="pop_view.php">X</a></span>
                </div>
            </div>
 
            <?php }
                }
            ?>
        </div>
        <div >
                <?php
                if(isset($_GET["d_itm"])){
                    if($_GET["d_itm"]==1){
                        ?>
                <!-- message for sucesfully  delete pop -->
                <div class="row row-cols-1 notibar">
                    <div class="col mt-2 ms-2 p-2 bg-success text-white rounded text-start">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-check-circle ms-2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                        </svg>
                        <span class="ms-2 mt-2">Successfully removed purchase proposal.</span>
                        <span class="me-2 float-end"><a class="text-decoration-none link-light" href="pop_view.php">X</a></span>
                    </div>
                </div>
                <?php }else{ ?>
                <!-- message for faild to delete pop -->
                <div class="row row-cols-1 notibar">
                    <div class="col mt-2 ms-2 p-2 bg-danger text-white rounded text-start">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-x-circle ms-2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg><span class="ms-2 mt-2">Failed to removed purchase proposal.</span>
                        <span class="me-2 float-end"><a class="text-decoration-none link-light" href="pop_view.php">X</a></span>
                    </div>
                </div>
           
                <?php }
                }?>
        </div>
        <form class="form-floating mb-3 mt-3" method="GET" action="pop_view.php">
                <div class="row g-2">
                    <div class="col">
                        <input type="text" class="form-control" id="popNo" name="popNo" placeholder="Purchase Order Proposal Number"
                            <?php if(isset($_GET["search"])){?>value="<?php echo $_GET["popNo"];?>" <?php } ?>>
                    </div>
                    <div class="col-auto">
                        <button type="submit" name="search" class="btn btn-success">Search</button>
                        <button type="reset" class="btn btn-danger"
                            onclick="javascript: window.location='pop_view.php'">Clear</button>
                        <a href="pop_create.php" class="btn btn-primary">Create new POP</a>
                    </div>
                </div>
            </form>
            </div>
  
            <div class="pt-2" id="pop-table">

        <?php
            
            if(!isset($_GET["search"])){
                //when no search all items retrive
                $search_query = "SELECT * FROM pop Where status != 'Inactive';";
            }else{
                //when search only get exact item
                $search_fn=$_GET["popNo"];
                $search_query = "SELECT * FROM pop i WHERE popNo LIKE '%{$search_fn}%' AND status != 'Inactive';";
            }
            $search_result = $dbConn -> executeQuery($search_query);
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
                </svg><span class="ms-2 mt-2">No Purchase Order Proposal found!</span>
                <a href="pop_view.php" class="text-white">Clear Search Result</a>
            </div>
        </div>
        <?php } else{ ?>
        <div class="table-responsive">
        <table class="table rounded-5 table-light table-striped table-hover align-middle caption-top mb-5">
            <caption><?php echo $search_numrow;?> POP(s) <?php if(isset($_GET["search"])){?><br /><a
                    href="pop_view.php" class="text-decoration-none text-danger">Clear Search
                    Result</a><?php } ?></caption>
            <thead class="bg-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">PO Proposal Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!--show pop values from database -->
                <?php $i=1; while($row = $search_result -> fetch_array()){ ?>
                <tr>
                    <th><?php echo $i++;?></th>
                    <td><?php echo $row["popNo"];?></td>
                    <td><?php echo $row["popDate"];?></td>
                    <td><?php echo $row["status"];?></td>
                    <td>
                        <a href="pop_details.php?popNo=<?php echo $row["popNo"]?>"
                            class="btn btn-sm btn-primary">View</a>
                        
                        <a href="pop_delete.php?popNo=<?php echo $row["popNo"]?>"
                        <?php 
                            if($row["status"]=="Open" ){ ?>
                            class="btn btn-sm btn-outline-danger">Delete</a>
                        <?php }?>
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
    <div class="flex">
    <?php include('../Shared/footer.php')?>
  </div>
</body>
</html>
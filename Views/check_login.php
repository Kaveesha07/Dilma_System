<?php
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    $query = "SELECT operatorId,operatorName,username,password FROM systemoperator WHERE
    username = '$username' AND password = '$pwd' LIMIT 0,1";

    $result = $dbConn -> executeQuery($query);
    if($result -> num_rows == 1){
        //user login
        $row = $result -> fetch_array();
        session_start();
        $_SESSION["operatorId"] = $row["operatorId"];
        $_SESSION["operatorName"] = $row["operatorName"];
        $_SESSION["username"] = $row["username"];

        header("location: index.php");
        exit(1);
    }else{
        ?>
        <script>
            alert("You entered wrong username and/or password!");
            history.back();
        </script>
        <?php
    }
?>
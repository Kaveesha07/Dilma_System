<?php
    session_start();
    //database access path
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    $username = $_POST["username"];
    $passwrd = $_POST["pwd"];

    $query = "SELECT directorId,directorName,directorEmail,username,password FROM managingdirector WHERE
    username = '$username' AND password = '$passwrd' LIMIT 0,1";

    $result = $dbConn -> executeQuery($query);
    if($result -> num_rows == 1){
        //director login
        $row = $result -> fetch_array();
        $_SESSION["directorId"] = $row["directorId"];
        $_SESSION["username"] = $username;
        $_SESSION["shopname"] = $row["directorName"];
        $_SESSION["utype"] = "Administrator";
        //$_SESSION["type"] = $row["type"];
        header("location: index.php");
    }else{
        ?>
        <script>
            alert("Wrong username and/or password!");
            history.back();
        </script>
        <?php
    }
?>
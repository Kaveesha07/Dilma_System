<?php
    //For inserting new system operator to database
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/Dilma_System";
    $db_path = $path . "/DataAccess";
    include $db_path.'/DBconnection.php';

    //check password with confirm password
    $pwd = $_POST["pwd"];
    $cfpwd = $_POST["cfpwd"];
    if($pwd != $cfpwd){
        ?>
        <script>
            alert('Your password is not match.\nPlease enter it again.');
            history.back();
        </script>
        <?php
        exit(1);
    }else{
        //get other info when password matches
        $username = $_POST["username"];
        $fullName = $_POST["fullname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];

        //Check for duplicating username
        $query = "SELECT username FROM systemoperator WHERE username = '$username';";
        $result = $dbConn -> executeQuery($query);
        if($result -> num_rows >= 1){
            ?>
            <script>
                alert('Your username is already taken!');
                history.back();
            </script>
            <?php
        }
        $result -> free_result();

        //Check for duplicating email
        $query = "SELECT operatorEmail FROM systemoperator WHERE operatorEmail = '$email';";
        $result = $dbConn -> executeQuery($query);
        if($result -> num_rows >= 1){
            ?>
            <script>
                alert('Your email is already in use!');
                history.back();
            </script>
            <?php
        }
        $result -> free_result();

        //Enter the new operatir details to database
        $query = "INSERT INTO systemoperator (operatorName,operatorEmail,username,password)
        VALUES ('$fullName','$email','$username','$pwd');";
        $result = $dbConn -> executeQuery($query);

        //send varriable based on output
        if($result){
            header("location: user_registration.php?reg_up=1");
        }else{
            header("location: user_registration.php?reg_up=0");
        }
    }
?>
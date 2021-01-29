<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'demo');
define('DB_NAME', 'demo');
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$username = $_REQUEST["username"];
$upassword = $_REQUEST["password"];

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt,"s",$param_username);
        $param_username = $username;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            //check username
            if(mysqli_stmt_num_rows($stmt)==1){
                mysqli_stmt_bind_result($stmt, $id, $username, $password);
                if(mysqli_stmt_fetch($stmt)){
                    if($password == $upassword){

                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;
    
                        header("location: home.html");
                    } else {
                        echo "Password incorrect";
                    }
                } 
            } else {
                echo "Username not found";
            }

        } else {
            echo "Couldnt execute statement";
        }
        
    }   
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
?>
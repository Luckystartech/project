<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "restaurant";

$conn = new mysqli($servername, $username, $password, $database);
if (!$conn) {
    die();
} 

// SIGN UP
if(isset($_POST["signup"])){
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $query = "INSERT INTO `users`(`username`, `password`, `role`) VALUES ('$username','$password','staff')";
    $result = $conn->query($query);

    if($result){
        echo "$username you just registered";
    } else {echo"please register";}
}

// LOGIN ALREADY REGISTERED USERS
if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    
    
    $res = $conn->query("SELECT `password`,`id`,`username` from `users` WHERE `username`='$username' ");
    $user = $res->fetch_assoc();
    var_dump($user);
    

    if($user){
        if(password_verify($password, $user["password"])){
            echo "correct password";
            session_start();
            $_SESSION["uid"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location:dashboard.php");
        } else {echo "user not found";}
    }else{echo "incorrect password";}
}
?>

<form method="post">
    <label for="name">Username</label>
    <input type="text" name="username" id="name" required></br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required></br>
    <button name="login" >login</button>
    <button name = "signup" >sign up</button>
    <!-- <input type="submit" value="submit"> -->
</form>
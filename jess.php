<?php

// CONNECT DATABASE
include_once(__DIR__."/newconnection.php"); 

// create account
    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 
        $email = $_POST["email"];

        // CREATE AN ACCOUNT AND INSERT USERS INTO DATABASE

        $query = "INSERT INTO `users`(`username`, `password`, `email`) VALUES ('$username','$password','$email')";

        $result = $conn->query($query); 

        if($result){
            echo"you just registered";
        }else{ echo"please register"; }
    }

// login users

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $query = "SELECT `username`, `password`, `email` FROM `users` WHERE `username`='$username' ";
    $result = $conn->query($query);

    $user = $result->fetch_assoc(); 

    // var_dump($user);

    if($user){
        if(password_verify($password, $user["password"])){
            echo"you have an account with us";
            session_start();
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            header("location:newpage.php");
        }else{echo"create an account";}   
    }
}

?>
<form method="post">
    <input type="text" name="username" placeholder="username"></br>
    <input type="password" name="password" placeholder="password"></br>
    <input type="email" name="email" placeholder="email"></br>
    <button type="submit" name="submit" >sign up</button>
    <button type="submit" name="login" >login</button>
</form>
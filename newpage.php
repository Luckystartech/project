<?php
    include_once(__DIR__."/newconnection.php");

    session_start();
    if(!isset($_SESSION["username"], $_SESSION["email"])){
        header("location:jess.php");
    }

//page = 0 offset = 5 * 0 = 0
// page = 1 offset = 5*1=5
// page = 2 offset = 5*2=10
// page = n offset = $perpage * $page

if(isset($_GET["page"])){
    $page = $_GET["page"];
}else{$page = 0;}

$per_page = 5;
$offset = $per_page * $page;

?>

<h1>THIS IS THE NEW PAGE</h1>

<table>
    <thead>
        <tr>
            <th>username</th>
            <th>email</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM `users` LIMIT $per_page OFFSET $offset";

    $result = $conn->query($query);

    while($row = $result->fetch_assoc()){
        // var_dump($row);
     
    ?>
        <tr>
            <td><?php echo $row["username"] ?> </td>
            <td><?php echo $row["email"] ?> </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
    
</table>
</br>
<a href="?page=<?php if($page-1 < 0){
    echo $page = 0;}
    else{echo $page-1;}?>">Back</a>___________
<a href="?page=<?php echo $page+1 ?>">Next</a>
<!-- ?>page=0 -->

<div><a href="./newlogout.php">logout</a></div>


<!-- http://localhost/project/jess.php?username=emeka &password=12345&email=manager%40gmail.com&login= -->

<!-- $_GET["page"] -->

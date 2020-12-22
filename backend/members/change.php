<?php
    require '../connect.php';
    $id=$_POST["id"];
    $category=$_POST["category"];

    $sql="Update details set $category=CURDATE() where id=$id";
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo "error";
    }
    $conn->close();
?>
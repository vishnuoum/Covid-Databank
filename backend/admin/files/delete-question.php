<?php
    require '../../connect.php';
    $id=$_POST["id"];
    $sql="Update questions set hidden='true' where id=$id";
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo "error";
    }
?>
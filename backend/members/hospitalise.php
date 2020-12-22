<?php
    require '../connect.php';
    $id=$_POST["id"];
    $sql="Update details set hospitalised=CURDATE() where id=".$id;
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo "error";
    }
    $conn->close();
?>
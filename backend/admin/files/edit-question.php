<?php
    require '../../connect.php';
    $text=$_POST["question"];
    $id=$_POST["id"];
    $sql="Update questions set text='$text' where id=$id";
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo "error";
    }
    $conn->close();
?>
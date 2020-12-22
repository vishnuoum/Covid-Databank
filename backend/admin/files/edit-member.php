<?php
    require '../../connect.php';
    $id=$_POST["id"];
    $name=$_POST["name"];
    $phone=$_POST["phone"];
    $ward=$_POST["ward"];

    $sql="Update members set name='$name', phone='$phone', ward=$ward where id=$id";
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo "error";
    }
    $conn->close();
?>
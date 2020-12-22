<?php
    require '../connect.php';
    $phone=$_POST["phone"];
    $password=$_POST["password"];

    $sql="Select id from members where phone='".$phone."' and password='".sha1($password)."'";
    $result=$conn->query($sql);
    if($result->num_rows > 0){
        setcookie("phone", $phone);
        setcookie("id", ($result->fetch_assoc())["id"]);
        echo "done";
    }
    else{
        echo "error";
    }
    $conn->close();
?>
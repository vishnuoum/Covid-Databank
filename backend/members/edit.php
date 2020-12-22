<?php
    require '../connect.php';
    $id=$_POST["id"];
    $name=$_POST["name"];
    $age=$_POST["age"];
    $gender=$_POST["gender"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    $mode="NULL";
    $category=$_POST["category"];
    $different=$_POST["different"];

    if(isset($_POST["mode"])){
        $mode="'".$_POST["mode"]."'";
    }

    $sql="Update details set name='$name', age='$age', gender='$gender', residency='$category', phone='$phone', address='$address', q_mode=$mode, different='$different' where id=$id";
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo $conn->error;
    }
    $conn->close();
?>
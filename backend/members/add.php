<?php
    require '../connect.php';
    $name=$_POST["name"];
    $age=$_POST["age"];
    $gender=$_POST["gender"];
    $phone=$_POST["phone"];
    $category=$_POST["category"];
    $address=$_POST["address"];
    $option=$_POST["option"];
    $different=$_POST["different"];
    $key='';
    $value='';
    if(isset($_POST["contact"])){
        $key=$key.",by_contact";
        $value=$value.",'".$_POST["contact"]."'";
    }
    if(isset($_POST["mode"])){
        $key=$key.",q_mode";
        $value=$value.",'".$_POST["mode"]."'";
    }
    $sql="Insert into details(id,name,age,gender,phone,address,member,residency,$category".$key.",different) Values(NULL,'$name','$age','$gender','$phone','$address',".$_COOKIE["id"].",'$option',CURDATE()".$value.",'$different')";
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo "error";
    }
?>
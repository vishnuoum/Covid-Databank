<?php
require '../connect.php';
$name=$_POST["name"];
$phone=$_POST["phone"];
$ward=$_POST["ward"];
$password=$_POST["password"];

$sql="Insert into members(id,name,phone,ward,password) Values(NULL,'$name','$phone',$ward,'".sha1($password)."')";
if($conn->query($sql)===TRUE){
    setcookie("phone", $phone);
    setcookie("id", $conn->insert_id);
    echo "done";
}
else{
    echo "error";
}

$conn->close();
?>
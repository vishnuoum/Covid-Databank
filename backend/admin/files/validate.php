<?php
$phone=$_POST["phone"];
$password=$_POST["password"];
if($phone=="9447673646" && sha1($password)=="44bf22e19f9847a349696ff9d28c2d147c9cf830"){
    setcookie("admin",$phone);
    echo "done";
}
else{
    echo "error";
}
?>
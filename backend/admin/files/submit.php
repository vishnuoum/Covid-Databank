<?php
    require '../../connect.php';
    $remark=$_POST["remark"];
    $sql="Insert into remarks(id,text) Values(NULL,'$remark')";
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo "error";
    }
    $conn->close();
?>
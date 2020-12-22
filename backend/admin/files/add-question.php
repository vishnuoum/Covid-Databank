<?php
    require '../../connect.php';
    $q=$_POST["question"];
    $sql="Insert into questions(id,text) Values(NULL,'$q')";
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo "error";
    }
    $conn->close();
?>
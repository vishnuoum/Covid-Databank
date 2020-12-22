<?php
    require '../connect.php';
    $r=$_POST["r"];
    $id=$_POST["id"];
    $sql="Update response set response= CASE id";
    $arr="(";
    for($i=0;$i<count($r);$i++){
        $arr=$arr.$id[$i].",";
        $sql=$sql." When ".$id[$i]." then '".$r[$i]."'";
    }
    $arr=substr($arr,0,-1);
    $arr=$arr.")";
    $sql = $sql."END where id in ".$arr.";";
    if($conn->query($sql)===TRUE){
        echo "done";
    }
    else{
        echo $conn->error;
        echo $sql;
    }
    $conn->close();
?>
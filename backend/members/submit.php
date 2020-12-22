<?php
    require '../connect.php';
    $q=$_POST["q"];
    $a=$_POST["a"];
    $i=0;
    $sql="Insert into response(id,question,member,response) Values";
    while($i<sizeof($q)){
        $sql=$sql."(NULL,".$q[$i].",".$_COOKIE["id"].",'".$a[$i]."'),";
        $i=$i+1;
    }
    $sql=substr($sql, 0, -1);
    if($conn->query($sql)===TRUE){
        setcookie('completed', "true", strtotime('today 23:59'));
        echo "done";
    }
    else{
        // echo $conn->error;
        echo "error";
    }
    

    $conn->close();

?>
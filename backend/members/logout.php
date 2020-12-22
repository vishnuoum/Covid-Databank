<?php
    setcookie("id","",time()-3600);
    setcookie("phone","",time()-3600);
    header("Location:login.html");
?>
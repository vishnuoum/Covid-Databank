<?php
    if(isset($_GET["signup"])){
        header("Location:members/signup.html");
    }
    else{
        header("Location:members/");
    }

?>
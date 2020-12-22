<?php
if(!isset($_COOKIE["id"])){
    header("Location:login.html");
}
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Convener's Area</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel = "icon" href ="../icon.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
        appId: "7461f631-eb5a-41b2-b830-5c05892320c0"
        });
    });
    </script>

    <style>
        .container {
            margin-top: 30px;
        }

        .navbar {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            z-index:1;
        }

        .center{
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            text-align:center;
            color:gray;
        }
    </style>
</head>

<body>
<?php
    if(!isset($_GET["client"])){
?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="navbar-brand">Convener</div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Daily task <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add-detail.php">Add details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="edit-detail.php">Edit details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
            </ul>
        </div>
    </nav>
    <?php
    }
    ?>
    <div class="container">
        
            <?php

                require '../connect.php';

                $completed=$conn->query("Select id from response where member=(Select id from members where phone=".$_COOKIE["phone"].") and date=CURDATE()");
                if($completed->num_rows==0){
                $sql="Select id,text from questions where not hidden='true'";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                    echo "<form action=\"submit.php\" id=\"form\">";
                    $num=1;
                    while($row=$result->fetch_assoc()){
                        echo "<div class=\"form-group\"> 
                <label for=\"q".$row["id"]."\">".$num++.".&nbsp;".$row["text"]."</label> 
                <input type=\"hidden\" name=\"q[]\" id=\"q".$row["id"]."\" value=\"".$row["id"]."\">
                <input type=\"tel\" name=\"a[]\" id=\"a".$row["id"]."\" class=\"form-control\" placeholder=\"Enter your response\" autocomplete=\"no-fill\" required 
                    > 
            </div>";
                    }
                    echo "<div class=\"form-group\">
                <input type=\"submit\" class=\"btn btn-primary btn-block\">
            </div></form>";
                }
                else{
                    echo "<div class=\"centre\">Nothing to display</div>";
                }
                $conn->close();}
                else{
                    if(!isset($_GET["client"])){
                        echo "<div class=\"center\">You have already responded<br><a href=\"update-task.php\" class=\"btn btn-primary\">Edit</a></div>";
                    }
                    else{
                        echo "<div class=\"center\">You have already responded<br><a href=\"update-task.php?client=yes\" class=\"btn btn-primary\">Edit</a></div>";
                    }
                }
            ?>
            
            

        
    </div>

</body>

</html>

<script>
    $("#form").submit(function (e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.




        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function (data) {
                if (data == "done") {
                    Swal.fire({
                        title:'Success!',
                        text:'You have submitted successfully',
                        type:'success'
                    }).then((result) => {
                        <?php
                            if(!isset($_GET["client"])){
                        ?>
                        location.reload();
                        <?php
                            }
                            else{
                        ?>
                        location.replace("task.php?client=yes");
                        <?php
                            }
                        ?>

                    });
                }
                else {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            }
            ,
            error: function (data) {
                Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
            }
        });


    });
</script>


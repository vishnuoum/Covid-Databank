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
    <title>Member Area</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <style>
        .container {
            margin-top: 30px;
            margin-bottom:50px;
        }

        .navbar {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            z-index:1;
        }

        .navbar-brand{
            margin-left:0px!important;
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
        
        <div class="navbar-brand"><i class="fa fa-arrow-left" onclick="history.back()"></i>&emsp;Edit</div>
    </nav>
    <?php
        }
    ?>
    <div class="container">
        
        <?php
            require '../connect.php';
            $sql="Select r.id,r.question,r.response,q.text from response r inner join questions q on r.question=q.id where date=CURDATE() and member=".$_COOKIE["id"];
            $result=$conn->query($sql);
            if($result->num_rows>0){?>
    <form action="update.php" id="form">
        <?php   $num=1;
                while($row=$result->fetch_assoc()){ ?>
                    <div class="form-group">
                        <label for=""><?php echo $num.".&nbsp;".$row["text"] ;?></label>
                        <input type="hidden" name="id[]" value="<?php echo $row["id"];?>">
                        <input type="tel" class="form-control" required name="r[]" value="<?php echo $row["response"];?>">
                    </div>
                <?php 
                    $num+=1;
                }
        ?>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block">
        </div>
    </form>
        <?php }else{
                echo "<div class=\"center\">You haven't submitted the response yet</div>";
            }
            $conn->close();
        ?>
        
    </div>

</body>

</html>

<script>
    $(document).ready(function(){
        $('html, body').scrollTop(0);

            $(window).on('load', function() {
            setTimeout(function(){
                $('html, body').scrollTop(0);
            }, 0);
        });
    });


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
                        text:'Successfully saved changes',
                        type:'success'
                    }).then((result) => {


                        window.history.go(-1);
                        // <?php
                        //     if(!isset($_GET["client"])){    
                        // ?>
                        // location.reload();
                        // <?php
                        //     }
                        //     else{
                        // ?>
                        // location.replace("update-task.php?client=yes");
                        // <?php
                        //     }
                        // ?>

                    });
                }
                else {
                    console.log(data);
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
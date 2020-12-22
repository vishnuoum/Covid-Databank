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
      <li class="nav-item">
        <a class="nav-link" href="task.php">Daily task</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Add details <span class="sr-only">(current)</span></a>
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
        <form action="add.php" id="form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="tel" name="age" id="age" class="form-control" placeholder="Enter age" required>
            </div>
            <div class="form-group">
                <label for="name">Category:</label>
                <select name="category" id="category" class="form-control" required>
                    <option selected disabled>Select a category</option>
                    <option value="quarantine">Quarantine</option>
                    <option value="covid_detected">Covid detected</option>
                    <option value="recovered">Recovered</option>
                    <option value="demise">Dead</option>
                </select>
            </div>
            <div class="form-group" id="contact"></div>
            <div class="form-group" id="q_mode"></div>
            <div class="form-group" id="hospital"></div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" class="form-control" required>
                    <option selected disabled>Select a category</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter phone number" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" required>
            </div>
            <div class="form-group">
                <label for="option">Select an option(only change in case of NRI or NRK):</label>
                <select name="option" id="option" class="form-control">
                    <option value="Keralite" selected>Keralite</option>
                    <option value="NRK">NRK</option>
                    <option value="NRI">NRI</option>
                </select>
            </div>
            <div class="form-group">
                Differently abled:&emsp;
                <label class="checkbox-inline"><input type="radio" name="different" value="yes" id="different">&nbsp;Yes</label>&emsp;
                <label class="checkbox-inline"><input type="radio"  name="different" value="no" id="different" checked>&nbsp;No</label>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block">
            </div>
        </form>
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
                        location.replace("add-detail.php?client=yes");
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


    $('#category').on('change', function (e) {
        var optionSelected = $("option:selected", this);
        var valueSelected = this.value;
        if(valueSelected=="covid_detected"){
            $("#q_mode").html('');
            $("#contact").html("By contact: \
            <label class=\"checkbox-inline\"><input type=\"radio\" name=\"contact\" value=\"yes\" id=\"check\">&nbsp;Yes</label>&emsp;\
            <label class=\"checkbox-inline\"><input type=\"radio\"  name=\"contact\" value=\"no\" id=\"check\" checked>&nbsp;No</label>");
        }
        else if(valueSelected=="quarantine"){
            $("#contact").html("By contact: \
            <label class=\"checkbox-inline\"><input type=\"radio\" name=\"contact\" value=\"yes\" id=\"check\">&nbsp;Yes</label>&emsp;\
            <label class=\"checkbox-inline\"><input type=\"radio\"  name=\"contact\" value=\"no\" id=\"check\" checked>&nbsp;No</label>");
            $("#q_mode").html("<label for=\"mode\">Quarantine mode:</label> \
            <Select class=\"form-control\" name=\"mode\" id=\"mode\" required>\
            <option selected disabled>Select a mode</option>\
            <option value=\"home\">Home</option>\
            <option value=\"institutional\">Institutional</option>\
            <option value=\"paid\">Paid</option>\
            </select>");
        }
        else{
            $("#contact").html('');
            $("#q_mode").html('');
        }
    });
</script>


<?php
if(!isset($_COOKIE["admin"])){
    header("Location:login.html");
}
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Area</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="../../icon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>


  <style>
    .container {
      margin-top: <?php
          echo isset($_GET["client"])? 10:70;
        ?>px;
    }

    .navbar {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      z-index:1;
    }

    .center {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: gray;
    }

    .dropdown-menu{
      overflow-Y:scroll;
      height:200px;
    }
  </style>
</head>

<body>
<?php
        if(!isset($_GET["client"])){
    ?>
  <nav class="navbar navbar-expand-xl fixed-top navbar-dark bg-primary">
    <div class="navbar-brand">Admin</div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="today.php">Today</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="remark.php">Add remark</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="whatsapp://send?text=Please Signup!!!! https://covid-de.000webhostapp.com?signup">Share signup</a>
        </li> -->
        <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Details
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="view-details.php?q=quarantine">Details of Quarantined</a>
                <a class="dropdown-item" href="view-details.php?q=covid_detected">Details of Covid positive</a>
                <a class="dropdown-item" href="view-details.php?q=recovered">Details of Recovered</a>
                <a class="dropdown-item" href="view-details.php?q=demise">Details of Passed away</a>
                <a class="dropdown-item" href="view-all.php">All(combined)</a>
            </div>
            </li> -->
            <li class="nav-item">
            <a class="nav-link" href="view-all.php">Details</a>
            </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Notify <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view-mem.php">Members</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="statistics.php">Statistics</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Ward wise statistics
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <?php
                $wards=1;
                while($wards<42){
                    echo "<a class=\"dropdown-item\" href=\"ward-stat.php?ward=$wards\">Ward $wards</a>";
                    $wards+=1;
                }
            ?>
          </div>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="add-q.php">Add question</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view-q.php">View/Edit questions</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php
        }
  ?>
  <div class="container">
    <form action="send.php" id="form">
        <div class="form-group">
            <label for="question">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Enter a title" required autocomplete="no-fill">
        </div>
        <div class="form-group">
            <label for="question">Content</label>
            <input type="text" class="form-control" name="content" id="content" placeholder="Enter your content" required autocomplete="no-fill">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-block" value="Send">
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
                if (data == "success") {
                    Swal.fire({
                        title:'Success!',
                        text:'Notifications were send successfully',
                        type:'success'
                    }).then((result) => {
                        location.reload();
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
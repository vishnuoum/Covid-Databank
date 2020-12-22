<?php
if(!isset($_COOKIE["admin"])){
    header("Location:login.html");
}
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>


  <style>
    .container {
      margin-top: <?php
          echo isset($_GET["client"])? 10:70;
        ?>px;
    }

    .navbar {
      width:100%!important;
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

    .dataTables_wrapper{
        overflow-x:scroll!important;
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
        <li class="nav-item">
          <a class="nav-link" href="notify.php">Notify</a>
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
        <li class="nav-item active">
          <a class="nav-link" href="#">View/Edit questions <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>
  <?php
        }
  ?>
  <div class="container">
    <?php
        require '../../connect.php';
        $sql="Select id,text from questions where not hidden='true'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            $i=1;
            echo "<table id=\"questions\" class=\"display\"><thead><tr><th>#</th><th>Question</th><th>Options</th></tr></thead><tbody>";
            while($row=$result->fetch_assoc()){
                echo "<tr id=\"".$row["id"]."\"><td>$i</td><td>".$row["text"]."</td><td><div class=\"btn-group\"><button class=\"btn btn-primary\" onclick=\"edit_q(".$row["id"].",'".$row["text"]."')\">Edit</button><button class=\"btn btn-primary\" onclick=\"del_q(".$row["id"].")\">Delete</button></div></td></tr>";
                $i=$i+1;
            }
            echo "</tbody></table>";
        }
        else{
            echo "<div class=\"center\">Nothing to display</div>";
        }
    ?>

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form" action="edit-question.php">
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label for="name" class="col-form-label">Question:</label>
                <input type="text" class="form-control" id="question" name="question">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" form="form" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

<script>
    $(document).ready( function () {
        $('#questions').DataTable();
    } );

    function del_q(id){
        console.log(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText:'No'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "delete-question.php",
                    data: {
                        id:id
                    }, // serializes the form's elements.
                    success: function (data) {
                        if (data == "done") {
                            Swal.fire({
                                title:'Success!',
                                text:'You have successfully deleted the question',
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
            }
        })
        
    }
    

    function edit_q(id,text) {
      $("#id").val(id);
      $("#question").val(text);
      $('#modal').modal('show');
    }
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
                        text:'Changes saved',
                        type:'success'
                    }).then((result) => {
                        location.reload();
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
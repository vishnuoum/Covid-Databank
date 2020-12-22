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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

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

        .dataTables_wrapper{
            overflow-x:scroll!important;
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
      <li class="nav-item">
        <a class="nav-link" href="add-detail.php">Add details</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Edit details <span class="sr-only">(current)</span></a>
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
            $sql="Select * from details where member=".$_COOKIE["id"];
            $result=$conn->query($sql);
            if($result->num_rows>0){
                $i=1;
                echo "<table id=\"details\" class=\"display\"><thead><tr><th>#</th><th>Name</th><th>Age</th><th>Gender</th><th>Phone</th><th>Address</th><th>Category</th><th>Differently abled</th><th>Quarantined date</th><th>Quarantine mode</th><th>Quarantine lifted date</th><th>Covid detected date</th><th>Hospitalised date</th><th>By contact</th><th>Recovered date</th><th>Demise date</th><th>Change</th><th>Options</th></tr></thead><tbody>";
                while($row=$result->fetch_assoc()){
                    echo "<tr id=\"".$row["id"]."\"><td>$i</td><td>".$row["name"]."</td><td>".$row["age"]."</td><td>".$row["gender"]."</td><td>".$row["phone"]."</td><td>".$row["address"]."</td><td>".$row["residency"]."</td><td>".$row["different"]."</td><td>".$row["quarantine"]."</td><td>".$row["q_mode"]."</td><td>".$row["quarantine_lifted"]."</td><td>".$row["covid_detected"]."</td><td>".$row["hospitalised"]."</td><td>".$row["by_contact"]."</td><td>".$row["recovered"]."</td><td>".$row["demise"]."</td><td><div class=\"btn-group\"><button class=\"btn btn-primary\" onclick=\"change('quarantine',".$row["id"].")\">Quarantined</button><button class=\"btn btn-primary\" onclick=\"change('quarantine_lifted',".$row["id"].")\">Lifted</button><button class=\"btn btn-primary\" onclick=\"change('covid_detected',".$row["id"].")\">Covid</button><button class=\"btn btn-primary\" onclick=\"hospitalise(".$row["id"].")\">Hospitalize</button><button class=\"btn btn-primary\" onclick=\"change('recovered',".$row["id"].")\">Recovered</button><button class=\"btn btn-primary\" onclick=\"change('demise',".$row["id"].")\">Dead</button></div></td><td><center><button class=\"btn btn-primary\" onclick=\"edit(this)\">Edit</button></center></td></tr>";
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
                        <form action="edit.php" id="form">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Age:</label>
                                <input type="tel" name="age" id="age" class="form-control" placeholder="Enter age" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <select name="gender" id="gender" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter phone number" required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select name="category" id="category" class="form-control" required>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" required>
                            </div>
                            <div class="form-group" id="differently_abled">

                            </div>
                            <div class="form-group" id="q_mode">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Save" class="btn btn-primary" form="form">
                    </div>
                </div>
            </div>
        </div>




    </div>

</body>

</html>

<script>

    $(document).ready( function () {
        $('#details').DataTable();
    } );


    function edit(t){
        parent=((t.parentNode).parentNode).parentNode;
        children=parent.children;
        $("#id").val(parent.id);
        $("#name").val(children[1].innerHTML);
        $("#age").val(children[2].innerHTML);
        $("#phone").val(children[4].innerHTML);
        $("#address").val(children[5].innerHTML);
        if(children[3].innerHTML=='male'){
            $("#gender").html("<option value=\"male\" selected>male</option><option value=\"female\">female</option><option value=\"other\">other</option>");
        }
        else if(children[3].innerHTML=='female'){
            $("#gender").html("<option value=\"male\">male</option><option value=\"female\" selected>female</option><option value=\"other\">other</option>");
        }
        else{
            $("#gender").html("<option value=\"male\">male</option><option value=\"female\">female</option><option value=\"other\" selected>other</option>");
        }
        if(children[9].innerHTML=='home'){
            $("#q_mode").html("<label for=\"mode\">Quarantine mode:</label>\
            <select class=\"form-control\" name=\"mode\" id=\"mode\">\
            <option value=\"home\" selected>Home</option>\
            <option value=\"institutional\">Institutional</option>\
            <option value=\"paid\">Paid</option>\
            </select>");
        }
        else if(children[9].innerHTML=="institutional"){
            $("#q_mode").html("<label for=\"mode\">Quarantine mode:</label>\
            <select class=\"form-control\" name=\"mode\" id=\"mode\" required>\
            <option value=\"home\">Home</option>\
            <option value=\"institutional\" selected>Institutional</option>\
            <option value=\"paid\">Paid</option>\
            </select>");
        }
        else if(children[9].innerHTML=="paid"){
            $("#q_mode").html("<label for=\"mode\">Quarantine mode:</label>\
            <select class=\"form-control\" name=\"mode\" id=\"mode\" required>\
            <option value=\"home\">Home</option>\
            <option value=\"institutional\">Institutional</option>\
            <option value=\"paid\" selected>Paid</option>\
            </select>");
        }
        else{
            $("#q_mode").html('');
        }
        if(children[6].innerHTML=='NRI'){
            $("#category").html("<option value=\"NRI\" selected>NRI</option><option value=\"NRK\">NRK</option><option value=\"Keralite\">Keralite</option>");
        }
        else if(children[6].innerHTML=='NRK'){
            $("#category").html("<option value=\"NRI\">NRI</option><option value=\"NRK\" selected>NRK</option><option value=\"Keralite\">Keralite</option>");
        }
        else{
            $("#category").html("<option value=\"NRI\">NRI</option><option value=\"NRK\">NRK</option><option value=\"Keralite\" selected>Keralite</option>");
        }
        if(children[7].innerHTML=='yes'){
            $("#differently_abled").html("Differently abled:&emsp;<label class=\"checkbox-inline\"><input type=\"radio\" name=\"different\" value=\"yes\" id=\"different\" checked>&nbsp;Yes</label>&emsp;\
                <label class=\"checkbox-inline\"><input type=\"radio\"  name=\"different\" value=\"no\" id=\"different\">&nbsp;No</label>");
        }
        else{
            $("#differently_abled").html("Differently abled:&emsp;<label class=\"checkbox-inline\"><input type=\"radio\" name=\"different\" value=\"yes\" id=\"different\">&nbsp;Yes</label>&emsp;\
                <label class=\"checkbox-inline\"><input type=\"radio\"  name=\"different\" value=\"no\" id=\"different\" checked>&nbsp;No</label>");
        }

        
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
                        text:'Successfully saved changes',
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
                        location.replace("edit-detail.php?client=yes");
                        <?php
                            }
                        ?>
                    });
                }
                else {
                    console.log(data)
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



    function change(c,id){ 
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "change.php",
                    data: {
                        id:id,
                        category:c
                    }, // serializes the form's elements.
                    success: function (data) {
                        if (data == "done") {
                            Swal.fire({
                                title:'Success!',
                                text:'Successfully saved changes',
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
                                location.replace("edit-detail.php?client=yes")
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
            }
        })

    }

    function hospitalise(id){ 
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "hospitalise.php",
                    data: {
                        id:id
                    }, // serializes the form's elements.
                    success: function (data) {
                        if (data == "done") {
                            Swal.fire({
                                title:'Success!',
                                text:'Successfully saved changes',
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
                                location.replace("edit-detail.php?client=yes")
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
            }
        })

    }
</script>


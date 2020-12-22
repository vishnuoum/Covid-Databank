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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

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
            <li class="nav-item dropdown">
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
        <?php
            $category=array("quarantine","covid_detected","recovered","demise");
            if(isset($_GET["q"]) && in_array($_GET["q"],$category)){




                if($_GET["q"]==$category[0]){
                    $key="Quarantined date";
                    $sql="Select d.id,d.name,d.age,d.gender,d.phone,d.quarantine,m.ward,d.address from details d inner join members m on d.member=m.id where quarantine_lifted IS NULL and covid_detected IS NULL and recovered IS NULL and demise IS NULL and quarantine IS NOT NULL";
                }
                else if($_GET["q"]==$category[1]){
                    $key="Covid detected date</th><th>By contact";
                    $sql="Select d.id,d.name,d.age,d.gender,d.phone,d.covid_detected,d.by_contact,m.ward,d.address from details d inner join members m on d.member=m.id where recovered IS NULL and demise IS NULL and covid_detected IS NOT NULL";
                    // $sql="Select d.id,d.name,d.age,d.gender,d.phone,d.covid_detected,d.by_contact,m.ward,d.address from details d inner join members m on d.member=m.id where recovered IS NULL and covid_detected IS NOT NULL";
                }
                else if($_GET["q"]==$category[2]){
                    $key="Recovered date";
                    $sql="Select d.id,d.name,d.age,d.gender,d.phone,d.recovered,m.ward,d.address from details d inner join members m on d.member=m.id where demise IS NULL and recovered IS NOT NULL";
                }
                else{
                    $key="Demise date";
                    $sql="Select d.id,d.name,d.age,d.gender,d.phone,d.demise,m.ward,d.address from details d inner join members m on d.member=m.id where demise IS NOT NULL";
                }



                require '../../connect.php';
                $result=$conn->query($sql);
                if($result->num_rows>0){
                    $i=1;
                    echo "<table id=\"details\" class=\"display\"><thead><tr><th>#</th><th>Name</th><th>Age</th><th>Gender</th><th>Phone</th><th>Ward</th><th>Address</th><th>$key</th></tr></thead><tbody>";
                    while($row=$result->fetch_assoc()){
                        if($_GET["q"]==$category[1]){
                            echo "<tr id=\"".$row["id"]."\"><td>$i</td><td>".$row["name"]."</td><td>".$row["age"]."</td><td>".$row["gender"]."</td><td>".$row["phone"]."</td><td>".$row["ward"]."</td><td>".$row["address"]."</td><td>".$row[$_GET["q"]]."</td><td>".$row["by_contact"]."</td></tr>";
                        }
                        else{
                            echo "<tr id=\"".$row["id"]."\"><td>$i</td><td>".$row["name"]."</td><td>".$row["age"]."</td><td>".$row["gender"]."</td><td>".$row["phone"]."</td><td>".$row["ward"]."</td><td>".$row["address"]."</td><td>".$row[$_GET["q"]]."</td></tr>";
                        }
                        $i=$i+1;
                    }
                    echo "</tbody></table>";
                }
                else{
                    echo $conn->error;
                    echo "<div class=\"center\">Nothing to display</div>";
                }
                $conn->close();
            }
            else{
                echo "<div class=\"center\">Nothing to display</div>";
            }
        ?>
    </div>

</body>

</html>

<script>
    $(document).ready( function () {
            $('#details').DataTable();
    } );
</script>


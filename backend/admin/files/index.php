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
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <link rel="icon" href="../../icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <style>
        .highlight {
            margin: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.09);
            padding: 10px;
            border-radius: 5px;
            color: rgb(0, 176, 255);
            background-color: rgb(0, 176, 255, 0.2);
            border: 2px solid rgb(0, 176, 255);
        }

        .row {
            margin: 10px
        }

        .container {
            margin: 0px !important;
            padding: 0px !important;
            width: 100%;
        }

        .chart,
        .doughnut {
            margin: 5px;
            padding: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.09);
            border-radius: 5px;
        }

        .col-6,
        .col-lg-6,.col-12 {
            padding: 5px !important;
        }

        .top{
            margin-top:20px!important;
        }
        

        .d-flex{
            margin-top:<?php
          echo isset($_GET["client"])? 10:60;
        ?>px;
        }
        
        .container {
        margin-top: 20px;
        margin-bottom:60px;
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

        .button,.button:hover,.button:focus{
        outline:none;
        border:none;
        padding: 12px 20px;
        background-color:transparent;
        }

        .b-active {
        border-bottom:2px solid #0275d8!important;
        }

        .fab{
        position:fixed;
        bottom:30px;
        right:20px;
        border-radius:50px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        @media print{
        .fab{
            display:none;
        }
        }

        .col-12{
            display:none;
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
            <li class="nav-item active">
            <a class="nav-link" href="#">Home  <span class="sr-only">(current)</span></a>
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
            </li> -->
            <!-- <li class="nav-item dropdown">
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

    <div class="btn-group d-flex justify-content-center">
                    <button class="button b-active" id="glance" onclick="glances()">In a glance</button>
                    <button class="button" id="highlight" onclick="highlights()">Todays's highlights</button>
    </div>


    <div class="row top">
        <?php
            $quarantine=array();
            $covid=array();
            $recovered=array();
            $dead=array();
            $dates=array();
            require '../../connect.php';
            $sql="Select (Select count(id) from details where quarantine=CURDATE() and quarantine_lifted is null and covid_detected is null and recovered is null and demise is null) as quarantine,(Select count(id) from details where covid_detected=CURDATE() and recovered is null and demise is null) as covid_detected,(Select count(id) from details where recovered=CURDATE() and demise is null) as recovered,(Select count(id) from details where demise=CURDATE()) as demise,(Select count(id) from details where quarantine<=CURDATE() and quarantine_lifted is null and covid_detected is null and recovered is null and demise is null) as quarantine_t,(Select count(id) from details where covid_detected<=CURDATE() and recovered is null and demise is null) as covid_detected_t,(Select count(id) from details where recovered<=CURDATE() and demise is null) as recovered_t,(Select count(id) from details where demise<=CURDATE()) as demise_t,(Select min(quarantine) from (Select quarantine from details WHERE quarantine is not null union Select quarantine_lifted from details where quarantine_lifted is not null union select covid_detected from details where covid_detected is not null union select recovered from details where recovered is not null union select demise from details where demise is NOT null) t) as date";
            $result=$conn->query($sql);
            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                $date=$row["date"];
                $period = new DatePeriod(
                    new DateTime($date),
                    new DateInterval('P1D'),
                    new DateTime(date("Y-m-d") ."+1 day")
                );
                foreach ($period as $key => $value) {
                    $sql="Select (SELECT count(id) from details where quarantine='".$value->format('Y-m-d')."' and quarantine_lifted is null and covid_detected is null and recovered is null and demise is null) as quarantine, (SELECT count(id) from details where covid_detected='".$value->format('Y-m-d')."' and recovered is null and demise is null) as covid_detected,(SELECT count(id) from details where recovered='".$value->format('Y-m-d')."' and demise is null) as recovered, (SELECT count(id) from details where demise='".$value->format('Y-m-d')."') as demise";
                    $res=$conn->query($sql);
                    if($res->num_rows>0){
                        $data=$res->fetch_assoc();
                        array_push($quarantine,$data["quarantine"]);
                        array_push($covid,$data["covid_detected"]);
                        array_push($recovered,$data["recovered"]);
                        array_push($dead,$data["demise"]);
                        array_push($dates,$value->format('d-m-Y'));
                    }
                }
                
        ?>
                <div class="col-6 col-md-3">
                    <div class="highlight">
                        <h6>Positive</h6>
                        <h4><?php echo $row["covid_detected_t"]."( +".$row["covid_detected"]." )";?></h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="highlight">
                        <h6>Recovered</h6>
                        <h4><?php echo $row["recovered_t"]."( +".$row["recovered"]." )";?></h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="highlight">
                        <h6>Quarantined</h6>
                        <h4><?php echo $row["quarantine_t"]."( +".$row["quarantine"]." )";?></h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="highlight">
                        <h6>Dead</h6>
                        <h4><?php echo $row["demise_t"]."( +".$row["demise"]." )";?></h4>
                    </div>
                </div>

                <?php
                //additional starts
                $sql="Select ward from members where id in (Select member from (Select count(id) as c,member from details where covid_detected=CURDATE() group by member) as t1 Inner Join (Select max(c) as m from (Select count(id) as c from details where covid_detected=CURDATE() group by member) as table1) as t2 on c=m)";
                $high=$conn->query($sql);
                //additional ends
                //additional starts
                $sql="Select ward from members where id in (Select member from (Select count(id) as c,member from details where quarantine=CURDATE() group by member) as t1 Inner Join (Select max(c) as m from (Select count(id) as c from details where quarantine=CURDATE() group by member) as table1) as t2 on c=m)";
                $quar=$conn->query($sql);
                //additional ends
                //additional starts
                $sql="Select ward from members where id in (Select member from (Select count(id) as c,member from details where demise=CURDATE() group by member) as t1 Inner Join (Select max(c) as m from (Select count(id) as c from details where demise=CURDATE() group by member) as table1) as t2 on c=m)";
                $demise=$conn->query($sql);
                //additional ends
                $sql="Select ward from members where id in (Select member from (Select count(id) as c,member from details where covid_detected=CURDATE() and by_contact='yes' group by member) as t1 Inner Join (Select max(c) as m from (Select count(id) as c from details where covid_detected=CURDATE() and by_contact='yes' group by member) as table1) as t2 on c=m)";
                $contact=$conn->query($sql);
                //additional ends
                //additional starts
                        ?>
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="highlight">
                                <h6>Most Positive cases from</h6>
                                <h5><?php echo "Ward ";

                                    if($high->num_rows>0){
                                        while($hwards=$high->fetch_assoc()){
                                            echo $hwards["ward"]."&nbsp;";
                                        }
                                    }
                                
                                ?></h5>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="highlight">
                                <h6>Most Contact cases from</h6>
                                <h5><?php echo "Ward ";

                                    if($contact->num_rows>0){
                                        while($contacts=$contact->fetch_assoc()){
                                            echo $contacts["ward"]."&nbsp;";
                                        }
                                    }
                                
                                ?></h5>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="highlight">
                                <h6>Most quarantine cases from</h6>
                                <h5><?php echo "Ward ";

                                    if($quar->num_rows>0){
                                        while($qua=$quar->fetch_assoc()){
                                            echo $qua["ward"]."&nbsp;";
                                        }
                                    }
                                
                                ?></h5>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-3">
                            <div class="highlight">
                                <h6>Most death cases from</h6>
                                <h5><?php echo "Ward ";

                                    if($demise->num_rows>0){
                                        while($dem=$demise->fetch_assoc()){
                                            echo $dem["ward"]."&nbsp;";
                                        }
                                    }
                                
                                ?></h5>
                            </div>
                        </div>
                        <?php
                    //additional ends
                ?>
                
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="doughnut">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="chart">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        
        <?php
            $conn->close();
            }
            else{
                die("<div class=\"center\">Nothing to display</div>");
            }
        ?>
    </div>

</body>

</html>


<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: <?php echo json_encode($dates)?>,
            datasets: [{
                label: 'Positive',
                backgroundColor: 'rgb(255, 99, 132,0.3)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?php echo json_encode($covid)?>
            }, {
                label: 'Quarantined',
                backgroundColor: 'rgb(255, 127, 0,0.3)',
                borderColor: 'rgb(255, 127, 0)',
                data: <?php echo json_encode($quarantine)?>
            },
            {
                label: 'Recovered',
                backgroundColor: 'rgb(25,191,0,0.3)',
                borderColor: 'rgb(25,191,0)',
                data: <?php echo json_encode($recovered)?>
            },
            {
                label: 'Dead',
                backgroundColor: 'rgb(115,115,115,0.3)',
                borderColor: 'rgb(115,115,115)',
                data: <?php echo json_encode($dead)?>
            }]
        },

        // Configuration options go here
        options: {
            title: {
                display: true,
                text: 'Cumulative statistics',
                maintainAspectRatio: false
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                // callbacks: {
                //     label: function (t, d) {
                //         if (t.yield=='0') {
                //             return '0';
                //         }
                //         else{
                //             return t.yLabel;
                //         }
                        
                //     }
                // }
            }
        }
    });


    var ctx = document.getElementById('myChart2').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',

        // The data for our dataset
        data: {
            labels: ['Quarantined', 'Postive', 'Recovered', 'Dead'],
            datasets: [{
                backgroundColor: ['rgb(255, 127, 0,0.3)','rgb(255, 99, 132,0.3)', 'rgb(25, 191,0,0.3)', 'rgb(115,115,115,0.3)'],
                borderColor: ['rgb(255, 127, 0)','rgb(255, 99, 132)', 'rgb(25,191,0)', 'rgb(115,115,115)'],
                data: <?php echo json_encode(array_map('intval',array_values(array_slice($row,0,4))));?>
            }]
        },

        // Configuration options go here
        options: {
            title: {
                display: true,
                text: "Today's statistics",
                maintainAspectRatio: false
            }
        }
    });
</script>


<script>
    function glances(){
        $('#glance').addClass('b-active');
        $('#highlight').removeClass('b-active');
        $(".col-6").show();
        $(".col-12").hide();
    }
    function highlights(){
        $('#highlight').addClass('b-active');
        $('#glance').removeClass('b-active');
        $(".col-12").show();
        $(".col-6").hide();
    }
</script>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
    window.OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
        OneSignal.init({
        appId: "7461f631-eb5a-41b2-b830-5c05892320c0",
        });
    });
    </script>
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
        .col-lg-6 {
            padding: 5px !important;
        }

        .top{
            margin-top:20px!important;
        }
        
        .container {
        margin-top: 30px;
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




        @media print{
        .fab{
            display:none;
        }
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
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="task.php">Daily task</a>
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
    


    <div class="row top">
        <?php
            $quarantine=array();
            $covid=array();
            $recovered=array();
            $dead=array();
            $dates=array();
            require '../connect.php';
            $sql="Select (Select count(id) from details where quarantine=CURDATE() and member=".$_COOKIE["id"].") as quarantine,(Select count(id) from details where covid_detected=CURDATE() and member=".$_COOKIE["id"].") as covid_detected,(Select count(id) from details where recovered=CURDATE() and member=".$_COOKIE["id"].") as recovered,(Select count(id) from details where demise=CURDATE() and member=".$_COOKIE["id"].") as demise,(SELECT min(date) from response) as date";
            $result=$conn->query($sql);
            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                $date=$row["date"];
                // $period = new DatePeriod(
                //     new DateTime($date),
                //     new DateInterval('P1D'),
                //     new DateTime(date("Y-m-d") ."+1 day")
                // );
                // foreach ($period as $key => $value) {
                //     $sql="Select (SELECT count(id) from details where quarantine='".$value->format('Y-m-d')."' and member=".$_COOKIE["id"].") as quarantine, (SELECT count(id) from details where covid_detected='".$value->format('Y-m-d')."' and member=".$_COOKIE["id"].") as covid_detected,(SELECT count(id) from details where recovered='".$value->format('Y-m-d')."' and member=".$_COOKIE["id"].") as recovered, (SELECT count(id) from details where demise='".$value->format('Y-m-d')."' and member=".$_COOKIE["id"].") as demise";
                //     $res=$conn->query($sql);
                //     if($res->num_rows>0){
                //         $data=$res->fetch_assoc();
                //         array_push($quarantine,$data["quarantine"]);
                //         array_push($covid,$data["covid_detected"]);
                //         array_push($recovered,$data["recovered"]);
                //         array_push($dead,$data["demise"]);
                //         array_push($dates,$value->format('d-m-Y'));
                //     }
                // }
                $sql="Select (SELECT count(id) from details where quarantine is not null and member=".$_COOKIE["id"].") as quarantine, (SELECT count(id) from details where covid_detected is not null and member=".$_COOKIE["id"].") as covid_detected,(SELECT count(id) from details where recovered is not null and member=".$_COOKIE["id"].") as recovered, (SELECT count(id) from details where demise is not null and member=".$_COOKIE["id"].") as demise";
                    $res=$conn->query($sql);
                    if($res->num_rows>0){
                        $data=$res->fetch_assoc();
                        array_push($quarantine,$data["quarantine"]);
                        array_push($covid,$data["covid_detected"]);
                        array_push($recovered,$data["recovered"]);
                        array_push($dead,$data["demise"]);
                        // array_push($dates,$value->format('d-m-Y'));
                    }
        ?>
                <div class="col-6 col-md-3">
                    <div class="highlight">
                        <h6>Positive</h6>
                        <h4><?php echo $data["covid_detected"];?></h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="highlight">
                        <h6>Recovered</h6>
                        <h4><?php echo $data["recovered"];?></h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="highlight">
                        <h6>Quarantined</h6>
                        <h4><?php echo $data["quarantine"];?></h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="highlight">
                        <h6>Dead</h6>
                        <h4><?php echo $data["demise"];?></h4>
                    </div>
                </div>
        
        
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
                die("<div class=\"center\">Notg to display</div>");
            }
        ?>
    </div>

</body>

</html>


<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            // labels: <?php echo json_encode($dates)?>,
            datasets: [{
                label: 'Positive',
                backgroundColor: 'rgb(255, 99, 132,0.3)',
                borderColor: 'rgb(255, 99, 132)',
                borderWidth:2,
                data: <?php echo json_encode($covid)?>
            }, {
                label: 'Quarantined',
                backgroundColor: 'rgb(255, 127, 0,0.3)',
                borderColor: 'rgb(255, 127, 0)',
                borderWidth:2,
                data: <?php echo json_encode($quarantine)?>
            },
            {
                label: 'Recovered',
                backgroundColor: 'rgb(25,191,0,0.3)',
                borderColor: 'rgb(25,191,0)',
                borderWidth:2,
                data: <?php echo json_encode($recovered)?>
            },
            {
                label: 'Dead',
                backgroundColor: 'rgb(115,115,115,0.3)',
                borderColor: 'rgb(115,115,115)',
                borderWidth:2,
                data: <?php echo json_encode($dead)?>
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
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
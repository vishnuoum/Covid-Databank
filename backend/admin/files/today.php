<?php
if((isset($_GET["print"])&&isset($_GET["client"]))){

}
else if(!isset($_COOKIE["admin"])){
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .container {
      /* margin-top: 70px; */
      margin-top:20px;
      margin-bottom:60px;
    }

    .top{
      margin-top:<?php
          echo isset($_GET["client"])? 10:70;
        ?>px;
    }

    .navbar {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      z-index:1;
      /* position:fixed;
      width:100%;
      top:0px; */
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

    .container{
      margin:50px!important;
    }
    
    

    @media print{
      .fab{
        display:none;
      }
      body{
        margin:0px;
        zoom:-20%;
      }
      .container{
        margin:0px;
        width:100%;
      }
      .d-flex{
        margin-bottom:50px;
      }
    }

    h4{
      margin-top:30px!important;
      margin-bottom:30px;
    }

    <?php
      if(isset($_GET["print"])){
        echo ".container{ 
          opacity:0;
        }
        
        @media print{
          .container{
            opacity:1;
          }
        }
        ";
      }
    ?>

  </style>
</head>



<script>
    <?php
      if(isset($_GET["print"])&&isset($_GET["client"])){
    ?>
    var count=0;

    // console.log(count);

    function chartcount(){
      count++;
      console.log(count);
      if(count==13){
        window.print();
      }
    }
    <?php
      }
    ?>

    buttons=document.getElementsByClassName("button");
    function showdata(t){
      if(!t.classList.contains("b-active")){
        buttons[0].classList.remove('b-active');
        buttons[1].classList.remove('b-active');
        t.classList.add("b-active");
      }
    }

    function showvisualization(t){
      if(!t.classList.contains("b-active")){
        buttons[0].classList.remove('b-active');
        buttons[1].classList.remove('b-active');
        t.classList.add("b-active");
      }

    }

    function drawchart(id,labels,data,sum){
        new Chart(document.getElementById(id), {
        type: 'bar',
        data: {
        labels: labels,
        datasets: [{
        label:['Response'],
        data: data,
        borderWidth:1,
        borderColor:"rgb(0,136,255)",
        backgroundColor:"rgb(0,136,255,0.5)"
        }]
        },
        options: {
            responsive:false,
            hover: {animationDuration: 0},
            legend: {
                display: false
            },
            title: {
            display: true,
            text: 'Total:'+sum
            },
            scales:{
              yAxes: [{
                ticks: {
                  beginAtZero: true
                },
                scaleLabel:{
                  display: true,
                  labelString: 'Response'
                }
                // gridLines:{
                //     display:false
                // }
              }],
              xAxes:[{
                scaleLabel:{
                  display: true,
                  labelString: 'Wards'
                }
                // gridLines:{
                //   display:false
                // }
              }]
            },
            animation: {
            duration: 500,
            easing: "easeOutQuart",
            onComplete: function () {
                var ctx = this.chart.ctx;
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function (dataset) {
                    for (var i = 0; i < dataset.data.length; i++) {
                        var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                            scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                        ctx.fillStyle = '#444';
                        var y_pos = model.y - 2;
                        // Make sure data value does not get overflown and hidden
                        // when the bar's value is too close to max value of scale
                        // Note: The y value is reverse, it counts from top down
                        if ((scale_max - model.y) / scale_max >= 0.93)
                            y_pos = model.y + 20;
                        ctx.fillText(dataset.data[i], model.x, y_pos);
                    }
                });
                <?php
                  if(isset($_GET["print"])&&isset($_GET["client"])){
                ?>chartcount();
                <?php
                  }
                ?>
            }
            }
        }
        });
    }

</script>

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
        <li class="nav-item active">
          <a class="nav-link" href="#">Today <span class="sr-only">(current)</span></a>
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
        <li class="nav-item">
          <a class="nav-link" href="view-q.php">View/Edit questions</a>
        </li>
      </ul>
    </div>
  </nav>
      <?php
        }
      ?>
      <?php
      require '../../connect.php';
        if(!isset($_GET["print"])){
      ?>
  <div class="d-flex justify-content-center d-print-none top">
      <form action="today.php" method="get" class="form-inline">
        <select name="date" id="date" class="form-control mb-2 mr-sm-2">
          <option selected disabled>Select a date</option>
          <?php
            
            $sql = "SELECT quarantine as date from details where not quarantine is null UNION SELECT quarantine_lifted as date from details where not quarantine_lifted is null UNION SELECT covid_detected as date from details where not covid_detected is null UNION Select recovered as date from details where not recovered is null UNION SELECT demise as date from details where not demise is null";
            $dates=$conn->query($sql);
            if($dates->num_rows>0){
              while($date=$dates->fetch_assoc()){
                echo "<option value=\"".$date["date"]."\">".date("d-m-Y",strtotime($date["date"]))."</option>";
              }

            }
          ?>
        </select>
        <button type="submit" class="btn btn-primary mb-2">Go</button>&nbsp;
        <button type="button" class="btn btn-primary mb-2" <?php
          if(isset($_GET["client"])){
            echo "onclick=\"Android.pdf(window.location.href)\"";
          }
          else{
            echo "onclick=\"window.print()\"";
          }
        ?>>Save</button>
      </form>
       <!-- <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="button b-active" onclick="showdata(this)">Data</button>
        <button type="button" class="button" onclick="showvisualization(this)">Visualization</button>
      </div>  -->
    </div>
    <?php
        }
    ?>

    <div class="d-flex justify-content-center">
            <h4 class="d-print-block d-none">Report<?php
              if(isset($_POST["date"])){
                echo "(".date('d-m-Y', strtotime($_POST["date"])).")";
              }
              elseif(isset($_GET["date"])){
                echo "(".date('d-m-Y', strtotime($_GET["date"])).")";
              }
              else{
                echo "(".date('d-m-Y').")";
              }
            ?></h4>
    </div>
  <div class="container">

    <div class="content">
      <?php

          $i=1;

          
          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<CURDATE() and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<CURDATE() and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<'".$_GET["date"]."' and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<'".$_GET["date"]."' and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
              echo "$i.&emsp;ഇന്നലെ വരെ ക്വാറന്റൈനിൽ ഉള്ളവരുടെ എണ്ണം?<br><br>";
              
              $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                // if($row["response"]==''){
                //   array_push($response,0);
                // }
                // else{
                  array_push($response,(int)$row["response"]);
                // }
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          
          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine=CURDATE() and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine=CURDATE() and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<'".$_GET["date"]."' and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine='".$_GET["date"]."' and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;കഴിഞ്ഞ 24 മണിക്കൂറിനുള്ളിൽ ഹോം ക്വാറന്റൈനിൽ എത്തിച്ചേർന്നവരുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and q_mode='home' and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<=CURDATE() and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<='".$_GET["date"]."' and q_mode='home' and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;ഇന്ന് ഹോം ക്വാറന്റൈനിൽ ഉള്ളവരുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine_lifted<=CURDATE() and q_mode='home' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine_lifted<=CURDATE() and q_mode='home' and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine_lifted<='".$_GET["date"]."' and q_mode='home' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine_lifted<='".$_GET["date"]."' and q_mode='home' and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;ഹോം ക്വാറന്റൈൻ പൂർത്തിയാക്കിവരുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          
          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where hospitalised=CURDATE() and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine_lifted=CURDATE() and q_mode='home' and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where hospitalised='".$_GET["date"]."' and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine_lifted='".$_GET["date"]."' and q_mode='home' and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;കഴിഞ്ഞ 24 മണിക്കൂറിൽ ആശുപത്രിയിലേക്ക് മാറ്റിയവരുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          
          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine_lifted=CURDATE() and q_mode='home' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine_lifted=CURDATE() and q_mode='home' and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine_lifted='".$_GET["date"]."' and q_mode='home' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine_lifted='".$_GET["date"]."' and q_mode='home' and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;ഇന്ന് ഹോം ക്വാറന്റൈൻ അവസാനിച്ചതും/മാറ്റിയവരുടെയും  എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          // echo "7.&emsp;ഹോം ക്വാറന്റൈനിൽ അവശേഷിക്കുന്നവരുടെ എണ്ണം?<br><br>";

          // echo "8.&emsp;കഴിഞ്ഞ 24 മണിക്കൂറിനുളിൽ ക്വാറന്റൈൻ ലംഘനം നടത്തിയവരുടെ എണ്ണം?<br><br>";

          // echo "9.&emsp;ഇന്സ്ടിട്യൂഷൻ ക്വാറന്റൈൻ സെന്ററുകളുടെ എണ്ണം?<br><br>";

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='institutional' and residency='NRI' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='institutional' and residency='NRI' and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='institutional' and residency='NRI' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='institutional' and residency='NRI' and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;ഇന്സ്ടിട്യൂഷൻ ക്വാറന്റൈനിൽ ഉള്ള NRI കളുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='institutional' and residency='NRK' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='institutional' and residency='NRK' and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='institutional' and residency='NRK' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='institutional' and residency='NRK' and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;ഇന്സ്ടിട്യൂഷൻ ക്വാറന്റൈനിൽ ഉള്ള NRK കളുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='institutional' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='institutional' and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='institutional' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='institutional' and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;ഇന്സ്ടിട്യൂഷൻ ക്വാറന്റൈനിലുള്ളവരുടെ ആകെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          // echo "13.&emsp;പെയ്ഡ് ക്വാറന്റൈൻ സെന്ററുകളുടെ എണ്ണം?<br><br>";

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='paid' and residency='NRI' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='paid' and residency='NRI' and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='paid' and residency='NRI' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id),member,(Select ward from members where id=member) from details  where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='institutional' and residency='NRI' and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;പെയ്ഡ് ക്വാറന്റൈനിലുള്ള NRI കളുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='paid' and residency='NRK' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='paid' and residency='NRK' and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='paid' and residency='NRK' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='institutional' and residency='NRK' and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;പെയ്ഡ് ക്വാറന്റൈനിലുള്ള NRK കളുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='paid' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<=CURDATE() and quarantine_lifted is null and q_mode='paid' and covid_detected is null and demise is null and recovered is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='paid' and covid_detected is null and demise is null and recovered is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where quarantine<='".$_GET["date"]."' and quarantine_lifted is null and q_mode='institutional' and covid_detected is null and demise is null and recovered is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){

            echo "$i.&emsp;പെയ്ഡ് ക്വാറന്റൈനിലുള്ളവരുടെ ആകെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          // echo "17.&emsp;വീടുകളിലേക്ക് വിദേശത്തുനിന്ന് വരുന്നവരുടെ എണ്ണം?<br><br>";

          // echo "18.&emsp;വീടുകളിലേക്ക് വിദേശത്തുനിന്ന് വരുന്നവരുടെ ആകെ എണ്ണം?<br><br>";

          // echo "19.&emsp;വീടുകളിലേക്ക് ഇതരസംസ്ഥാനത്തുനിന്ന്  വരുന്നവരുടെ എണ്ണം?<br><br>";

          // echo "20.&emsp;വീടുകളിലേക്ക് ഇതരസംസ്ഥാനത്തുനിന്ന്  വരുന്നവരുടെ ആകെ എണ്ണം?<br><br>";

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where covid_detected<CURDATE() and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected<=CURDATE() group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where covid_detected<'".$_GET["date"]."' and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected<='".$_GET["date"]."' group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;ഇതുവരെയുള്ള പോസിറ്റീവ് കേസുകളുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where covid_detected=CURDATE() and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected=CURDATE() and recovered is null and demise is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where covid_detected='".$_GET["date"]."' and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected='".$_GET["date"]."' and recovered is null and demise is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;കഴിഞ്ഞ 24 മണിക്കൂറിനുള്ളിൽ സ്ഥിരീകരിച്ച പോസിറ്റീവ് കേസുകളുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where covid_detected<=CURDATE() and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected<=CURDATE() and recovered is null and demise is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where covid_detected<='".$_GET["date"]."' and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected<='".$_GET["date"]."' and recovered is null and demise is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;ആകെ പോസിറ്റീവ് കേസുകളുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          
          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where hospitalised<=CURDATE() and covid_detected is not null and recovered is null and demise is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected<=CURDATE() and recovered is null and demise is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where hospitalised<='".$_GET["date"]."' and covid_detected is not null and recovered is null and demise is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected<='".$_GET["date"]."' and recovered is null and demise is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;നിലവിൽ ആശുപത്രികളിൽ ചികിത്സയിലുള്ള പോസിറ്റീവ് കേസുകളുടെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }

          

          if(!isset($_GET["date"])){
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<=CURDATE() and by_contact='yes' and quarantine_lifted is null and covid_detected  is null and recovered is null and demise is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected<=CURDATE() and recovered is null and demise is null group by member";
          }
          else{
            $sql = "SELECT seq as ward,(Select count(id) as response from details where quarantine<='".$_GET["date"]."' and by_contact='yes' and quarantine_lifted is null and covid_detected  is null and recovered is null and demise is null and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            // $sql="Select count(id) as response,member,(Select ward from members where id=member) as ward from details  where covid_detected<='".$_GET["date"]."' and recovered is null and demise is null group by member";
          }
          $result=$conn->query($sql);
          if($result->num_rows>0){
            echo "$i.&emsp;വാർഡുകളിൽ സമ്പർക്കം മുഖേന ക്വാറന്റൈനിൽ ഉള്ളവരുടെ ആകെ എണ്ണം?<br><br>";
            $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(\"$i\",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
              $i++;
          }
          else{
            echo $conn->error;
          }


        $sql1="Select id,text from questions where not hidden='true'";
        $result1=$conn->query($sql1);
        if($result1->num_rows>0){
          while($q=$result1->fetch_assoc()){
            if(isset($_GET["date"])){
              $sql="SELECT seq as ward,(Select response from response where question=".$q["id"]." and date='".$_GET["date"]."' and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
              }
            else{
              $sql="SELECT seq as ward,(Select response from response where question=".$q["id"]." and date=CURDATE() and member=(Select id from members where ward=seq)) as response FROM seq_1_to_41";
            }

            $result=$conn->query($sql);
            if($result->num_rows>0){
              echo $i."&emsp;".$q["text"]."<br>";
              $ward=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($ward,(int)$row["ward"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"$i\" height=\"400\" width=\"850\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(".$i.",".json_encode($ward).",".json_encode($response).",".array_sum($response).")</script>";
            }
            else{
              echo "<div class=\"center\">Nothing to display</div>";
              break;
            }
            $i+=1;
          }
        }

        echo "<strong>Today's remarks:</strong><br>";
              if(isset($_GET["date"])){
                $sql="Select text from remarks where date='".$_GET["date"]."'";
              }
              else{
                $sql="Select text from remarks where date=CURDATE()";
              }
              $remarks=$conn->query($sql);
              if($remarks->num_rows>0){
                echo $remarks->fetch_assoc()["text"];
              }
              else{
                echo "Remark is not submitted";
              }

        $conn->close();
      ?>
    </div>
  </div>


</body>

</html>

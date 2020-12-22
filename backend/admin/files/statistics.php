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

    .button,.button:hover,.button:focus{
      outline:none;
      border:none;
      padding: 12px 20px;
      background-color:transparent;
    }

    .b-active {
      border-bottom:2px solid #0275d8!important;
    }

    .print{
      position:absolute;
      top:80px;
      right:30px;
    }

    h4{
      margin-bottom:50px;
    }

    @media print{
      .fab{
        display:none;
      }
      canvas{
        width:100%;
      }
      body{
        margin:0px;
      }
      .container{
        margin:0px;
      }
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

    function chartcount(){
      count++;
      console.log(count);
      if(count==25){
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

    function drawchart(id,labels,data){
        new Chart(document.getElementById(id), {
        type: 'line',
        data: {
        labels: labels,
        datasets: [{
            fill:false,
            label:['Response'],
            data: data,
            borderWidth:2,
            borderColor:"rgb(0,136,255)",
        }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
            display: false,
            text: 'Statistics'
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
              }],
              xAxes:[{
                scaleLabel:{
                  display: true,
                  labelString: 'Dates'
                }
              }]
            },
            animation:{
              onComplete:function(){
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
        <li class="nav-item active">
          <a class="nav-link" href="#">Statistics <span class="sr-only">(current)</span></a>
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
        </li>
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
  <div class="d-flex justify-content-center">
      <h4 class="d-none d-print-block">Statistics</h4>
      <!-- <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="button b-active" onclick="showdata(this)">Data</button>
        <button type="button" class="button" onclick="showvisualization(this)">Visualization</button>
      </div> -->
    </div>
  <div class="container">
    <div class="content">
      <?php
        require '../../connect.php';
        $sql1="Select id,text from questions where not hidden='true'";
        $result1=$conn->query($sql1);
        if($result1->num_rows>0){
          $i=1;
          while($q=$result1->fetch_assoc()){
            $sql="Select sum(response) as response,question,date from response where question=".$q["id"]." group by date";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              echo $i."&emsp;".$q["text"]."<br>";
              $date=array();
              $response=array();
              while($row=$result->fetch_assoc()){
                array_push($date,$row["date"]);
                array_push($response,(int)$row["response"]);
              }
              // echo json_encode($ward);
              // echo json_encode($response);
              echo "<br>";
              echo "<canvas id=\"".$q["id"]."\"></canvas>";
              echo "<br>";
              echo "<script>drawchart(".$q["id"].",".json_encode($date).",".json_encode($response).")</script>";
            }
            else{
              echo "<div class=\"center\">Nothing to display</div>";
            break;
            }
            $i+=1;
          }
        }
        else{
            echo "<div class=\"center\">Nothing to display</div>";
        }
      ?>
    </div>
  </div>
        <?php
        
          if(!isset($_GET["print"])){
        ?>
        <button class="btn btn-primary print d-print-none" <?php
          if(isset($_GET["client"])){
            echo "onclick=\"Android.pdf(window.location.href)\"";
          }
          else{
            echo "onclick=\"window.print()\"";
          }
        ?>>Save</button>
            <?php
          }
            ?>
</body>

</html>

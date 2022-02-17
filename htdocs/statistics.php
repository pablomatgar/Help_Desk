<?php
include 'php.php';

$conn = OpenCon();
session_start();

  if(isset($_SESSION) && $_SESSION['Job_ID']!=NULL){
      switch($_SESSION['Job_ID']){
          case 876:
            break;
          default: echo '<script>window.alert("Access denied for the user.");</script>';
          header("Refresh:0, url=index.php");
            break;
      }
  }
  else{
    echo '<script>window.alert("Access denied for the user.");</script>';
    header("Refresh:0, url=index.php");
  }

  $query = "SELECT COUNT(*) FROM COMPLAINT";

  $total = $conn->query($query)->fetch_row()[0];

  $query = "SELECT COUNT(*) FROM COMPLAINT WHERE Status = 0";

  $remaining = $conn->query($query)->fetch_row()[0];

  $query = "SELECT COUNT(*) FROM COMPLAINT WHERE Specialist_Required = 1 AND Status = 1";

  $help = $conn->query($query)->fetch_row()[0];
  
  $query = "SELECT COUNT(*) FROM COMPLAINT WHERE Specialist_Required = 0 AND Status = 1";

  $rest = $conn->query($query)->fetch_row()[0];

  include ("html/statistics.html");

  $query = 'SELECT * FROM EMPLOYEE WHERE Job_ID = 543';

  $result = $conn->query($query);

  $employees = array();

  if ($result->num_rows > 0) {
      while($row = $result->fetch_row()) {
          array_push($employees,$row[0]);
      }
  }

  $completed = array();

  for($i = 0; $i < sizeof($employees); $i++){
    $query = 'SELECT COUNT(*) FROM COMPLAINT WHERE Status = 1 AND Complaint_ID = ANY (SELECT `Complaint_ID` FROM .CALL WHERE `Operator_ID` = "'.$employees[$i].'")';
    array_push($completed,$conn->query($query)->fetch_row()[0]);
  }

  $employeesString = "";

  for($i = 0; $i < sizeof($employees); $i++){
    if($i==sizeof($employees)-1){
      $employeesString = $employeesString.'"'.$employees[$i].'"';
    }
    else{
      $employeesString = $employeesString.'"'.$employees[$i].'",';
    }
    
  }

  $completedString = "";

  for($i = 0; $i < sizeof($completed); $i++){
    if($i==sizeof($completed)-1){
      $completedString = $completedString.$completed[$i];
    }
    else{
      $completedString = $completedString.$completed[$i].',';
    }
    
  }



echo '<script>var ctx = document.getElementById("myChart1").getContext("2d");var chart = new Chart(ctx,{"type":"doughnut","data":{"labels":["Complaints not completed","Complaints completed with specialists","Complaints completed withouth specialists"],"datasets":[{"label":"My First Dataset","data":['.$remaining.','.$help.','.$rest.'],"width":"33%","backgroundColor":["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"]}]},options: {responsive: true,maintainAspectRatio: false}});</script>';

echo '<script>var ctx2 = document.getElementById("myChart2").getContext("2d");var char2 = new Chart(ctx2,{"type":"bar","data":{"labels":['.$employeesString.'],"datasets":[{"label":"Complaints completed by employee","data":['.$completedString.'],"fill":false,"backgroundColor":["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)","rgba(153, 102, 255, 0.2)","rgba(201, 203, 207, 0.2)"],"borderColor":["rgb(255, 99, 132)","rgb(255, 159, 64)","rgb(255, 205, 86)","rgb(75, 192, 192)","rgb(54, 162, 235)","rgb(153, 102, 255)","rgb(201, 203, 207)"],"borderWidth":1}]},"options":{responsive: true,maintainAspectRatio: false,"scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}}})</script>';

CloseCon($conn);

?>
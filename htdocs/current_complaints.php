<?php
include 'php.php';

  $data = array();

  session_start();

  if(isset($_SESSION) && $_SESSION['Job_ID']!=NULL){  //Security && set queries
      switch($_SESSION['Job_ID']){
          case 999: $query = "SELECT * FROM COMPLAINT WHERE Status = 0"; 
            break;
          case 543: $query = 'SELECT * FROM COMPLAINT WHERE Status = 0 AND Complaint_ID = ANY (SELECT `Complaint_ID` FROM .CALL WHERE `Operator_ID` = "'.session_id().'")'; 
            break;
          case 111: $query = 'SELECT * FROM COMPLAINT WHERE Status = 0 AND Specialist_ID = "'.session_id().'"'; 
            break;
          default:  echo '<script>window.alert("Access denied for the user.");</script>';
          header("Refresh:0, url=index.php");
            break;
      }
  }
  else{
    echo '<script>window.alert("Access denied for the user.");</script>';
    header("Refresh:0, url=index.php");
  }

  $conn = OpenCon();

  $result = $conn->query($query);


if ($result->num_rows > 0) { //Display complaints
    while($row = $result->fetch_assoc()) {
        $element = '<div class = "legend_style" onclick="displayComplaint(' . $row["Complaint_ID"] . ')"><legend>Complaint ID: ' . $row["Complaint_ID"] . ' - Complaint Type: ' . $row["Complaint_Type"] . '</legend></div>';
        array_push($data,$element);
    }
}

include ("html/current_complaints.html");

foreach ($data as &$item) {
    echo $item;
}

CloseCon($conn);

?>
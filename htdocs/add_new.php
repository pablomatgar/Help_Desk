<?php
include 'php.php';
$conn = OpenCon();

session_start();

if(isset($_POST['submit'])){ //Saves data when submitted
    $complaint = array();
    $call = array();
    $element = $_POST["problemn"];//0
    array_push($complaint,$element);
    $element = $_POST["problemtype"];//1
    array_push($complaint,$element);
    $element = $_POST["hardware"];//2
    array_push($complaint,$element);
    $element = $_POST["specialist"];//3
    switch($element){
      case 'yes': array_push($complaint,1);
      $elementS = $_POST["specialistSelection"];//8
      break;
      case 'no': array_push($complaint,0);
      $elementS = 'NULL';
      break;
    }
    if($_POST["completiondate"]!=NULL){//4  Status
      array_push($complaint,1);
    }
    else{
      array_push($complaint,0);
    }
    $element = $_POST["completiondate"];//5
    if($element==""){
      $element='NULL';
    }
    else{
      $element = '"'.$element.'"';
    }
    array_push($complaint,$element);
    $element = $_POST["howsolved"];//6
    if($element==""){
      $element='NULL';
    }
    else{
      $element = $element.' - '.date("Y/m/d H:i:s");
      $element = '"'.$element.'"';
    }
    array_push($complaint,$element);
    $element = $_POST["hourstaken"];//7
    if($element==""){
      $element='NULL';
    }
    else{
      $element = '"'.$element.'"';
    }
    array_push($complaint,$element);
    array_push($complaint,$elementS);//8
  
    $element = $_POST["callid"];//0
    array_push($call,$element);
    $element = $_POST["calldate"];//1
    array_push($call,$element);
    $element = $_POST["notes"];//2
    array_push($call,$element);
    $element = $_POST["operatorid"];//3
    array_push($call,$element);
    $element = $_POST["employeeid"];//4
    array_push($call,$element);
    $element = $_POST["startcall"];//5
    array_push($call,$element);

    $query = 'INSERT INTO COMPLAINT (Complaint_Type, Hardware_Serial, Specialist_Required, Status, Completion_Date, Comments, Hours_Taken, Specialist_ID, Complaint_ID, Date_Logged) VALUES ("'.$complaint[1].'", "'.$complaint[2].'", "'.$complaint[3].'", "'.$complaint[4].'", '.$complaint[5].', '.$complaint[6].', '.$complaint[7].', '.$complaint[8].', "'.$complaint[0].'", "'.$call[1].'")'; 

    $result = $conn->query($query);
  
    $query = 'INSERT INTO .CALL  (Call_Date, Call_Time, Call_ID, Complaint_ID, Operator_ID, Employee_ID, Call_Reason) VALUES ("'.$call[1].'","'.$call[5].'", "'.$call[0].'", "'.$complaint[0].'", "'.$call[3].'", "'.$call[4].'", "'.$call[2].'")'; 
    
    $result = $conn->query($query);

    header("Refresh:0, url=index.php");
  
  }

  if(isset($_SESSION) && $_SESSION['Job_ID']!=NULL){ //Security and set some settings depending on the role
    switch($_SESSION['Job_ID']){
        case 999: include ("html/add_new.html");
          echo '<script>document.getElementById("calldate").setAttribute("value", "'.date("Y-m-d").'");</script>';
          echo '<script>document.getElementById("startcall").setAttribute("value", "'.date("H:i:s").'");</script>';
          break;
        case 543: include ("html/add_new.html");
          echo '<script>document.getElementById("calldate").setAttribute("value", "'.date("Y-m-d").'");</script>';
          echo '<script>document.getElementById("startcall").setAttribute("value", "'.date("H:i:s").'");</script>';
          echo '<script>document.getElementById("operatorid").setAttribute("value", "'.session_id().'");</script>';
          echo '<script>document.getElementById("operatorid").setAttribute("readonly", "");</script>';
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

CloseCon($conn);

?>
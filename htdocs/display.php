<?php
include 'php.php';
$conn = OpenCon();

session_start();

if(isset($_POST['submit'])){ //Reads data if the user is updating the data
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
    $elementS = $_POST["specialistselection"];//8
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
    $element = $element.' - '.date("Y/m/d H:i:s").' - '.session_id().'\n';
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

  $query = 'UPDATE COMPLAINT SET Complaint_Type = "'.$complaint[1].'", Hardware_Serial = "'.$complaint[2].'",  Specialist_Required = "'.$complaint[3].'", Status = "'.$complaint[4].'", Completion_Date = '.$complaint[5].', Comments = '.$complaint[6].', Hours_Taken = '.$complaint[7].', Specialist_ID = '.$complaint[8].' WHERE Complaint_ID = '.$complaint[0].''; 

  $result = $conn->query($query); //Updates data

  $element = $_POST["callid"];//0
  array_push($call,$element);
  $element = $_POST["calldate"];//1
  array_push($call,$element);
  $element = $_POST["startcall"];//2
  array_push($call,$element);

  $query = 'UPDATE .CALL SET Call_Date = "'.$call[1].'", Call_Time = "'.$call[2].'" WHERE Call_ID = '.$call[0].''; 

  $result = $conn->query($query);

  header("Refresh:0, url=index.php");
}
else{ //Display complaint info
  $id = $_GET["id"];

  $query = 'SELECT * FROM COMPLAINT WHERE Complaint_ID = "' . $id . '"'; 

  $result = $conn->query($query);

  $complaint = array();
  $call = array();

  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $element = $row["Complaint_ID"];//0
          array_push($complaint,$element);
          $element = $row["Complaint_Type"];//1
          array_push($complaint,$element);
          $element = $row["Hardware_Serial"];//2
          array_push($complaint,$element);
          $element = $row["Specialist_Required"];//3
          array_push($complaint,$element);
          $element = $row["Status"];//4
          array_push($complaint,$element);
          $element = $row["Completion_Date"];//5
          array_push($complaint,$element);
          $element = $row["Comments"];//6
          array_push($complaint,$element);
          $element = $row["Hours_Taken"];//7
          array_push($complaint,$element);
          $element = $row["Specialist_ID"];//8
          array_push($complaint,$element);
      }
  }

  $query = 'SELECT * FROM .CALL WHERE Complaint_ID = "' . $id . '"'; 

  $result = $conn->query($query);

  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $element = $row["Call_ID"];//0
          array_push($call,$element);
          $element = $row["Employee_ID"];//1
          array_push($call,$element);
          $element = $row["Call_Time"];//2
          array_push($call,$element);
          $element = $row["Call_Date"];//3
          array_push($call,$element);
          $element = $row["Operator_ID"];//4
          array_push($call,$element);
          $element = $row["Call_Reason"];//5
          array_push($call,$element);
      }
  }

  if($complaint[4]==1){ //If complaint is completed, not editable
    $output = '<div class="form_style">
    <form method="post" action="display.php" id="form">
        <div class = "fieldset_style">
      <fieldset>
          <div class = "legend_style"><legend>CALL INFO</legend></div>
      <p>
          <label for="callid">Call ID:</label>
          <input type="text" id="callid" name="callid" value="'. $call[0] .'" readonly>
      </p>	
      <p>	
        <label for="startcall">Call date:</label>
        <input type="date" id="calldate" name="calldate" value="'. $call[3] .'" readonly>
      </p>	
      <p>	
        <label for="startcall">Start call time:</label>
        <input type="time" step="1" id="startcall" name="startcall" value="'. $call[2] .'" readonly>
      </p>	
      </fieldset>
        </div>
    
      <div class = "fieldset_style">
      <fieldset>
          <div class = "legend_style"><legend>TECHNICAL INFO</legend></div>
          
      <p>
          <label for="employeeid">Employee ID:</label>
          <input type="text" id="employeeid" name="employeeid" value="'. $call[1] .'" readonly>
      </p>
      <p>
          <label for="operatorid">Operator ID:</label>
          <input type="text" id="operatorid" name="operatorid" value="'. $call[4] .'" readonly>
      </p>	
      <p>
          <label for="hardware">Hardware:</label>
          <input type="text" id="hardware" name="hardware" value="'. $complaint[2] .'" readonly>
      </p>
      </fieldset>
        </div>
        
      <div class = "fieldset_style">
      <fieldset>
          <div class = "legend_style"><legend>PROBLEM INFO</legend></div>
      <p>
          <label for="problemn">Problem Nº:</label>
          <input type="text" id="problemn" name="problemn" value="'. $complaint[0] .'" readonly>
      </p>
        <br>
        <label for="Reason for call">Reason for the call or cause of the problem:</label>
        <br>
          <textarea class="textareas" name="notes" readonly>'. $call[5] .'</textarea>
        <br>
      <p>
        <label for="problemtype">Problem Type:</label>
        <input list="typesDataList" value="'. $complaint[1] .'" readonly name="problemtype">
        <datalist id="typesDataList">
        <option value="Hardware Error">
        <option value="Software Error">
        </datalist>
      </p>	
      <p>	
        <label for="specialist">Specialist:</label>
        <input type="radio" id="specialistYes" name="specialist" value="yes" disabled>
        <label for="specialistYes">YES</label>
        <input type="radio" id="specialistNo" name="specialist" value="no" disabled>
        <label for="specialistNo">NO</label>
          
      </p>
      <p>
          <label for="specialistSelection">Specialist Selection:</label>
          <input list="specialistDataList" readonly value="'.$complaint[8].'">
          <datalist id="specialistDataList">
            <option value="1112">
            <option value="1113">
            <option value="1114">
            <option value="1115">
            <option value="1116">
            <option value="1117">
          </datalist>   
      </p>	
          
      </fieldset>
        </div>
        
      <div class = "fieldset_style">
      <fieldset>
          <div class = "legend_style"><legend>FINAL PHASE</legend></div>
        <p> 
            <label for="completionDate">End Date</label>
            <input type="date" id="completionDate" name="completionDate" value="'. $complaint[5] .'" readonly>
      </p>  
        <br>
      <p>	
        <label for="howSolved">Related comments:</label>
        <br>
          
        <textarea class="textareas" name="howSolved" readonly>'. $complaint[6] .'</textarea>
      </p>
          
        <br>
      <p>
          <label for="howMuchTime">Hours Taken</label>
          <input type="text" id="howMuchTime" name="howMuchTime" value="'. $complaint[7] .'" readonly>
      </p> 
      </fieldset>
        </div>
    </form>';
  }
  else{ //If not, it is editable
    $output = '<div class="form_style">
    <form method="post" action="display.php">
        <div class = "fieldset_style">
      <fieldset>
          <div class = "legend_style"><legend>CALL INFO</legend></div>
      <p>
          <label for="callid">Call ID:</label>
          <input type="text" class = "block" id="callid" name="callid" value="'. $call[0] .'" readonly>
      </p>	
      <p>	
        <label for="startcall">Call date:</label>
        <input type="date"  class = "block" id="calldate" name="calldate" value="'. $call[3] .'">
      </p>	
      <p>	
        <label for="startcall">Start call time:</label>
        <input type="time"  class = "block" step="1" id="startcall" name="startcall" value="'. $call[2] .'">
      </p>	
      </fieldset>
        </div>
    
      <div class = "fieldset_style">
      <fieldset>
          <div class = "legend_style"><legend>TECHNICAL INFO</legend></div>
          
      <p>
          <label for="employeeid">Employee ID:</label>
          <input type="text" class = "block" id="employeeid" name="employeeid" value="'. $call[1] .'">
      </p>
      <p>
          <label for="operatorid">Operator ID:</label>
          <input type="text" class = "block" id="operatorid" name="operatorid" value="'. $call[4] .'">
      </p>	
      <p>
          <label for="hardware">Hardware:</label>
          <input type="text" class = "block" id="hardware" name="hardware" value="'. $complaint[2] .'">
      </p>
      </fieldset>
        </div>
        
      <div class = "fieldset_style">
      <fieldset>
          <div class = "legend_style"><legend>PROBLEM INFO</legend></div>
      <p>
          <label for="problemn">Problem Nº:</label>
          <input type="text" id="problemn" name="problemn" value="'. $complaint[0] .'" readonly>
      </p>
        <br>
        <label for="Reason for call">Reason for the call or cause of the problem:</label>
        <br>
          <textarea class="textareas" name="notes" placeholder="NOTES">'. $call[5] .'</textarea>
        <br>
      <p>
        <label for="problemtype">Problem Type:</label>
        <input list="typesDataList" value="'. $complaint[1] .'" name="problemtype">
        <datalist id="typesDataList">
        <option value="Hardware Error">
        <option value="Software Error">
        </datalist>
      </p>	
      <p>	
        <label for="specialist">Specialist:</label>
        <input type="radio" id="specialistYes" name="specialist" value="yes" required="true">
        <label for="specialistYes">YES</label>
        <input type="radio" id="specialistNo" name="specialist" value="no">
        <label for="specialistNo">NO</label>
          
      </p>
      <p>
          <label for="specialistSelection">Specialist Selection:</label>
          <input list="specialistDataList" name="specialistselection" value="'.$complaint[8].'">
          <datalist id="specialistDataList">
            <option value="1112">
            <option value="1113">
            <option value="1114">
            <option value="1115">
            <option value="1116">
            <option value="1117">
          </datalist>   
      </p>	
          
      </fieldset>
        </div>
        
      <div class = "fieldset_style">
      <fieldset>
          <div class = "legend_style"><legend>FINAL PHASE</legend></div>
        <p> 
            <label for="completiondate">End Date</label>
            <input type="date" id="completiondate" name="completiondate">
      </p>  
        <br>
      <p>	
        <label for="howSolved">Related comments:</label>
        <br>
          
        <textarea class="textareas" name="howsolved" placeholder="How was it solved?">'. $complaint[6] .'</textarea>
      </p>
          
        <br>
      <p>
          <label for="hourstaken">Hours Taken</label>
          <input type="text" id="hourstaken" name="hourstaken">
      </p> 
      </fieldset>
        </div>
      <p>
          <input type="submit" name="submit" value="Save changes">
        </p>	

			<div id="editor"></div>
        </div>
    </form>';
  }

  if(isset($_SESSION) && $_SESSION['Job_ID']!=NULL){ //Security and block editable info in some cases (specialists)
  
    if($complaint[0]==NULL){
      echo '<script>window.alert("Access denied for the user.");</script>';
      header("Refresh:0, url=index.php");
    }
    else{
      switch($_SESSION['Job_ID']){
          case 999:
        break;
        case 876: if($complaint[4]==0){
          echo '<script>window.alert("Access denied for the user.");</script>';
          header("Refresh:0, url=index.php");
        }
        break;
          case 543:if($call[4] != session_id()){
            echo '<script>window.alert("Access denied for the user.");</script>';
            header("Refresh:0, url=index.php");
          }
        break;
          case 111: if($complaint[8] != session_id()){
              echo '<script>window.alert("Access denied for the user.");</script>';
              header("Refresh:0, url=index.php");
          }
          echo '<script>var items = document.getElementsByClassName("block");for(i=0;i<items.length;i++){items.item(i).setAttribute("readonly","");}</script>';
        break;
          default: echo '<script>window.alert("Access denied for the user.");</script>';
          header("Refresh:0, url=index.php");
          break;
      }
  }
  }
  else{
    echo '<script>window.alert("Access denied for the user.");</script>';
    header("Refresh:0, url=index.php");
  }

  include ("html/display.html");
  echo $output;

  if($complaint[3]==1){ //Check the specialist selection ratio button
    echo '<script>document.getElementById("specialistYes").setAttribute("checked", "");</script>';
  }
  else{
    echo '<script>document.getElementById("specialistNo").setAttribute("checked", "");</script>';
  }

}

CloseCon($conn);

?>
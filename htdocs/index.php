<?php
include 'php.php';
$conn = OpenCon();

session_start();

if(isset($_POST['submit'])){ //if log in has been executed
    $query = 'SELECT Job_ID, First_Name, Last_Name FROM EMPLOYEE WHERE Employee_ID = "' . $_POST['login'] . '" AND User_Password = AES_ENCRYPT("' . $_POST['password'] . '",VERSION())'; 
    $result = $conn->query($query);
    if ($result->num_rows > 0) { //Help Desk / Manager / Statistics 
        while($row = $result->fetch_assoc()) {
            $element = $row["Job_ID"];//0
            $element1 = $row["First_Name"];//1
            $element2 = $row["Last_Name"];//2
        }
        session_unset();
        session_destroy();
        session_id($_POST['login']);
        session_start();
        $_SESSION['Job_ID'] = $element;
        $_SESSION['Name'] = $element1.' '.$element2;
        header("Refresh:0, url=index.php");
    }
    else{ //Specialist
        $query = 'SELECT First_Name, Last_Name FROM SPECIALIST WHERE Specialist_ID = "' . $_POST['login'] . '" AND User_Password = AES_ENCRYPT("' . $_POST['password'] . '",VERSION())'; 

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $element = 111;//0
                $element1 = $row["First_Name"];//1
                $element2 = $row["Last_Name"];//2
            }
            session_unset();
            session_destroy();
            session_id($_POST['login']);
            session_start();
            $_SESSION['Job_ID'] = $element;
            $_SESSION['Name'] = $element1.' '.$element2;
            header("Refresh:0, url=index.php");
        }
        else{ //Incorrect user
            echo "<script type='text/javascript'>alert('The user or password are incorrect. Please try again.');</script>";
        }
    }
}

include ("html/index.html");

if(isset($_GET["action"])){ //when log out
    $action = $_GET["action"];
    if($action == 'logOut'){
        session_unset();
        session_destroy();
        header("Refresh:0, url=index.php");
    }
}

if(isset($_SESSION['Job_ID'])){ //when log in, load the html depending on the role of the user
    switch($_SESSION['Job_ID']){
        case 999: echo '<div class="signin_title"><p>'.$_SESSION['Name'].' - MANAGEMENT</p></div>';
        include ("html/index_999.html");
        break;
        case 543: echo '<div class="signin_title"><p>'.$_SESSION['Name'].' - HELP DESK</p></div>';
        include ("html/index_543.html");
        break;
        case 876: echo '<div class="signin_title"><p>'.$_SESSION['Name'].' - RESEARCH AND DEVELOPMENT</p></div>';
        include ("html/index_876.html");
        break;
        case 111: echo '<div class="signin_title"><p>'.$_SESSION['Name'].' - SPECIALIST</p></div>';
        include ("html/index_111.html");
        break;
    }
}

CloseCon($conn);

?>
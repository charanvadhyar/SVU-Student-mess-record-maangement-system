<?php
    
if (isset($_POST["Login"])){
    $month = $_POST["month"];
   
    require_once "database.php";
  $sql = "SELECT * FROM messdetailsinsertion1 WHERE student_id = '$studentID' and timeline = '$month'";
  $result = $connect->query($sql);
  

  if ($result && $result->num_rows > 0) {
      $studentinfo = mysqli_fetch_array($result);
  }
  else{
    echo "No student information";
  }
}
      ?>
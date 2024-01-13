
<?php
session_start();
if (isset($_SESSION["user"])){
    $_SESSION['studentID'] = $user['student_id'];
    header("Location:studentdashboard.php");

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SVU MESS RECORDS MANAGEMENT</title>
  <link rel="stylesheet" href="homepage.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="validationscript.js"></script>
</head>
<body>
  <h1 id = "title">SVU STUDENT MESS RECORD MANEGEMENT SYSTEM</h1>
  <div class="container">
  <div class="wrapper">
    <div class="form1">
      <form action="studentdetailsinsertion.php" method="post">
        <h1> Student</h1>
        <div class="input-box">
        <input type="text" class="form-control" placeholder="Full Name" name ="Name">
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          
          <input type="text" placeholder="Student Id" name = "StudentID" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Password" name = "password" required>
          <i class='bx bxs-lock-alt' ></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Password" name = "repeat_password" required>
          <i class='bx bxs-lock-alt' ></i>
        </div>
        
        <button type="submit"  class="btn" id = "myBtn" name = "submit" >Register</button>
        <div class="register-link">
          <p>Already Registered<a href="homepage.php">Login</a></p>
        </div>
        </form>
      </div>
      
      
    
  </div>
</body>
</html>
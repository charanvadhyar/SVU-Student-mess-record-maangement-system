
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
      <form action="studentloginvalidation.php" method="post">
        <h1> Student</h1>
        <div class="input-box">
          <input type="text" placeholder="Student Id" name = "StudentId" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Password" name = "password" required>
          <i class='bx bxs-lock-alt' ></i>
        </div>
        
        <button type="submit"  class="btn" id = "myBtn" name = "Login" >Login</button>
        <div class="register-link">
          <p>Dont have an account? <a href="register.php">Register</a></p>
        </div>
        </form>
      </div>
   
      
    
  </div>
  <div class="wrapper1">
    <div class="option"
    > <h3> LOGIN</h3></div>
  </div>
  <div class="wrapper">
    <div class="form2">
      <form action="managementvalidation.php" method="post">
        <h1>Manangement</h1>
        <div class="input-box">
          <input type="text" placeholder="Management Id" name = "Employeeid" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="password" name = "password" required>
          <i class='bx bxs-lock-alt' ></i>
        </div>
      
        <button type="submit" class="btn" id = "myBtn2" name = "Login">Login</button>
        <div class="register-link">
          <p>Dont have an account? consult the Database Admin</p>
        </div>
        </form>
      </div>
   </div>
  </div>
    
  </div>
</body>
</html>
<?php
  session_start(); // Ensure this is the first thing in your script

  if (isset($_SESSION['user']) ) {
    
      
  } else {
      header('Location: login.php');
      exit; // Add exit here to stop script execution
  }
  if (isset($_SESSION['studentID'])) {
    $studentID = $_SESSION['studentID'];

  }
  else{
    echo "student id not retrieved";
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Mess Details</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="studentdashboard.css">
</head>

<body>
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
      
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Mess Mangement</a>
                </div>
            </div>
           <!--- <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Task</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                        <i class="lni lni-layout"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                Two Links
                            </a>
                            <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 1</a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="#" class="sidebar-link">Link 2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Notification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            !--->
            <div class="sidebar-footer">
                <a href="logout.php" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
            <div class="text-center">
                <h1>
                    Student Mess Details
                </h1>
                <form method="post" action ="studentdashboard.php">
                <div class="calendar">
                <label for = "month">Select the Month</label>
                <input type = "month" name = "month" id = "month" required>
            </div>
            <div class="form-btn">
                <button  class = "btn btn-primary" id = "myBtn3" name ="Login" placeholder="submit">Submit</button>
                </div>

               
                </form>
            </div>
            <div class="card-continer">
                <h3 class="title">
                    This Month Data
                </h3>
                <div class="card-wrapper">
                    <div class="present-days">
                        <div class="present-days-header">
                            <div class="days">
                                <span class="title">No.of Days</span>
                                <span class="title">Present</span>
                            </div>
                        
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                        <div class="value">
                        
                            <?php
                            if(isset($studentinfo))
                            {
                            echo "<h1>".htmlspecialchars($studentinfo['days_present']). "</h1>";
                            }
                            else
                            echo "<h1> </h1>";


                            ?>
                        </div>

                    </div>
                    <div class="present-days">
                        <div class="present-days-header">
                            <div class="days">
                                <span class="title">No.of Days</span>
                                <span class="title">Absent</span>
                            </div>
                        
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                        <div class="value">
                        <?php
                            if(isset($studentinfo)){
                            echo "<h1>".htmlspecialchars($studentinfo['days_absent']). "</h1>";
                            }
                            else
                            {
                                echo "<h1> </h1>";
                            }


                            ?>
                        </div>

                    </div>
                    <div class="present-days">
                        <div class="present-days-header">
                            <div class="days">
                                <span class="title">No.of Non-veg</span>
                                <span class="title">Days</span>
                            </div>
                        
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                        <div class="value">
                        
                        <?php
                            if(isset($studentinfo)){
                            echo "<h1>".htmlspecialchars($studentinfo['non_veg']). "</h1>";
                            }
                            else
                            {
                                echo "<h1> <h1>";
                            }


                            ?>
                        </div>

                    </div>
                    <div class="present-days">
                        <div class="present-days-header">
                            <div class="days">
                                <span class="title">No.of veg</span>
                                <span class="title">Days</span>
                            </div>
                        
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                        <?php
                            if(isset($studentinfo)){
                            echo "<h1>".htmlspecialchars($studentinfo['veg']). "</h1>";
                            }
                            else{
                                echo "<h1> </h1>";
                            }


                            ?>

                    </div>
                    <div class="present-days">
                        <div class="present-days-header">
                            <div class="days">
                                <span class="title">Food charges for the Month</span>
                                
                            </div>
                        
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
                        <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"/>
                        </svg>
                        
                        <div class="value">
                        
                        <?php
                            if(isset($studentinfo)){
                            echo "<h1>".htmlspecialchars($studentinfo['food_charges']). "</h1>";
                            }
                            else
                            {
                                echo "<h1> </h1>";
                            }
                            
                            ?>
                        </div>

                    </div>
                    <div class="present-days">
                        <div class="present-days-header">
                            <div class="days">
                                <span class="title">Non veg charges for the Month</span>
                               
                            </div>
                        
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
                        <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"/>
                        </svg>
                        <div class="value">
                        
                        <?php
                            if(isset($studentinfo)){
                            echo "<h1>".htmlspecialchars($studentinfo['non_veg_charges']). "</h1>";
                            }
                            else
                            {
                                echo "<h1> </h1>";                            }

                            ?>
                        </div>

                    </div>
                    <div class="present-days">
                        <div class="present-days-header">
                            <div class="days">
                                <span class="title">veg charges for the Month</span>
                               
                            </div>
                        
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
                        <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"/>
                        </svg>
                        <div class="value">
                        
                        <?php
                            if(isset($studentinfo))
                            {
                            echo "<h1>".htmlspecialchars($studentinfo['veg_charges']). "</h1>";
                            }
                            else{
                                echo "<h1> </h1>";
                            }


                            ?>
                            </div>

                    </div>
                    <div class="present-days">
                        <div class="present-days-header">
                            <div class="days">
                                <span class="title">Room charges for the Month</span>
                               
                            </div>
                        
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
                        <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"/>
                        </svg>
                        <div class="value">
                        
                        <?php
                            if(isset($studentinfo)){
                            echo "<h1>".htmlspecialchars($studentinfo['room_charges']). "</h1>";
                            }
                            else
                            {
                                echo "<h1> </h1>";
                            }

                            ?>
                        </div>

                    </div>
                    <div class="present-days">
                        <div class="present-days-header">
                            <div class="days">
                                <span class="title">Total charges for the Month</span>
                               
                            </div>
                        
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
                        <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"/>
                        </svg>
                        <div class="value">
                        <?php
                            if(isset($studentinfo))
                            {
                            
                            echo "<h1>".htmlspecialchars($studentinfo['total']). "</h1>";
                            }
                            else
                            {
                                echo "<h1> </h1>";
                            }

                            ?>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>


  <!--  The code to fetch and link the php file that fetches the studsent details-->

  
</body>

</html>
<?php
        if(isset($_POST["submit"])){
            $fullName = $_POST["Name"];
            $StudentId = $_POST["StudentID"];
            $password = $_POST["password"];
            $repeatpassword = $_POST["repeat_password"];
            $passwordhash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();
            if(empty($fullName) || empty($StudentId) || empty($password) || empty($repeatpassword)) {
                array_push($errors, "All fields are required");
            }
            if(!filter_var($StudentId, FILTER_VALIDATE_INT))
            {
                array_push($errors,"Student Id  Invalid , Please Provide a valid Student Id");
            }
            if(strlen($password) < 8)
            {
                array_push($errors,"Password must be at least 8 characters");
            }
            if($password != $repeatpassword)
            {
                array_push($errors,"Passwords do not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE student_id = $StudentId";
            $result = $connect->query($sql);
            $rowcount = mysqli_num_rows($result);

            if($rowcount > 0)
            {
                array_push($errors,"The Student Id exists already in the database");
            }


            if(count($errors) > 0)
            {
                foreach($errors as $error)
                {
                    echo "<div class='alert alert-danger'>$error</div>";
                
                }
            }
            else
            {
                require_once "database.php";
                $sql = "INSERT INTO  users (full_name,student_id,Password) VALUES(?,?,?)";
                $init = mysqli_stmt_init($connect);
                $preparestmt = mysqli_stmt_prepare($init, $sql);
                if($preparestmt)
                {
                    mysqli_stmt_bind_param($init,"sss", $fullName,$StudentId,$passwordhash);
                    mysqli_stmt_execute($init);
                    echo "<h1 style = text-align :center><div class ='alert alert-success'>You have successfully Registered</div></h1>";
                    echo "<h1 style = text-align :center><p>Go Back To Login Page <a href = 'homepage.php'>Login</a></p></h1>";
                    
                }
                else
                    die("Something went wrong");

            
            }
    
        }


        ?>


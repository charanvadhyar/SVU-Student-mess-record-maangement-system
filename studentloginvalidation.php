<?php

if (isset($_POST["Login"])){
    $StudentId = $_POST["StudentId"];
    $password = $_POST["password"];
    require_once "database.php";
    $sql = "SELECT * FROM users WHERE student_id = $StudentId";
    $result = $connect->query($sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($user)
    {
        if(password_verify($password, $user["Password"])){
            session_start();
            $_SESSION["user"] = "yes";
            $_SESSION['studentID'] = $user['student_id'];
            header("Location:studentdashboard.php");
            die();
    }
    else{
        echo "<div class='alert alert-danger'>The Password is Incorrect</div>";

    }
}

    else{
        echo "<div class='alert alert-danger'>The Student Id Doesn't Exist</div>";
    }



}
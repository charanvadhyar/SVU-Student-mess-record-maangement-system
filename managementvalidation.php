<?php

if (isset($_POST["Login"])){
    $Employeeid = $_POST["Employeeid"];
    $password = $_POST["password"];
    require_once "database.php";
    $sql = "SELECT * FROM admins WHERE employee_id = $Employeeid";
    $result = $connect->query($sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($user)
    {
        if($password == $user["Password"]){
            session_start();
            $_SESSION["user"] = "yes";
            header("Location:detailsentry.php");
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

?>
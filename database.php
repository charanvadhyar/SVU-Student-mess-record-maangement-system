<?php

$hostname = "localhost";
$dbuser ="root";
$dbpassword = "";
$dbname = "register_login";

$connect = mysqli_connect($hostname, $dbuser, $dbpassword, $dbname);

if(!$connect)
{
    die("Something went wrong");
}


?>
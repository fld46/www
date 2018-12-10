<?php
if(!isset($_SESSION['auth']->droits)){
    require "inc/bootstrap.php";
    App::redirectr('/v6/index.php');
}

//session_start();

$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "sitejeuxv2";

try
{
     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}

include_once 'class/User.class.php';
$user = new User($DB_con);


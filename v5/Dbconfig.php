<?php
if(!isset($_SESSION['auth']->droits)){
    require "inc/bootstrap.php";
    App::redirectr('/v4/index.php');
}

//session_start();

$DB_host = "sql.free.fr";
$DB_user = "webfld";
$DB_pass = "gtt7021y";
$DB_name = "webfld";

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


<?php
if(!isset($_SESSION['auth']->droits)){
    require "inc/bootstrap.php";
    App::redirectr('/index.php');
}
$pdo= new PDO('mysql:dbname=sitejeuxv2;hostname=localhost','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


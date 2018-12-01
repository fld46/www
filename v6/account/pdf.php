<?php
require "pdf/fpdf.php";
if(!isset($_SESSION['auth']->droits)){
    require "../inc/bootstrap.php";
    App::redirectr('/v6/index.php');
}
$auth= App::getAuth();
$auth->restrict(Session::getInstance());
$db = App::getDatabase();
$stats = new Accountstat($db, $_SESSION['auth']->id);
$stats->getListtopdf();
?>







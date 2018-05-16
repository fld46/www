<?php
require'../inc/bootstrap.php';
require'../account/function.php';
$auth=App::getAuth()->restrict();
?>

<h1>votre compte</h1>
<?php
debug($_SESSION);

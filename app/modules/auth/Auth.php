<?php
namespace limb\app\modules\auth;
require "../../autoload.php";

if($_POST['nameForm'] == 'reg')
{
	$reg = new AuthPage(false);
	$reg -> newUser($_POST);
}
elseif($_POST['nameForm'] == 'auth')
{
	$reg = new AuthPage(false);
	$reg -> AuthUser($_POST);
}
elseif($_POST['nameForm'] == 'newpassword')
{
	$reg = new AuthPage(false);
	$reg -> NewPasswordOnPost($_POST);
}


?>
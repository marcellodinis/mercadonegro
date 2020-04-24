<?php 
session_start();
require_once("vendor/autoload.php"); //Carregar as dependências do Composer.

use \Slim\Slim;
use \Mercadonegro\Page;
use \Mercadonegro\PageAdmin; 
use \Mercadonegro\Model\User;
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;
use \Mercadonegro\Mailer;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");
});



$app->get('/mandachuva', function() {

	User::verifyLogin();

	$page = new PageAdmin();
	
	$page->setTpl("index");
});



$app->get('/mandachuva/login', function() {

	 $page = new PageAdmin([
		"header"=>false,
		"footer"=>false
]);
	 


	 $page->setTpl("login");
});



$app->post('/mandachuva/login', function() {

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /mandachuva");
	exit;
});



$app->get('/mandachuva/logout', function() {

	User::logout();
	
	header("Location: /mandachuva/login");
	exit;
});



$app->get("/mandachuva/users", function() {

	User::verifyLogin();

	$users = User::listAll();

	$page = new PageAdmin();
	
	$page->setTpl("users", array(
		"users"=>$users

	));
});



$app->get("/mandachuva/users/create", function() {

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("users-create");
	

});



$app->get("/mandachuva/users/:iduser/delete", function($iduser) {

	User::verifyLogin();

	$user = new User();
	
	$user->get((int)$iduser);

	$user->delete();

	header("Location: /mandachuva/users");
	exit;

	

});



$app->get('/mandachuva/users/:iduser', function($iduser){
     
	User::verifyLogin();
  
	$user = new User();
  
	$user->get((int)$iduser);
  
	$page = new PageAdmin();
  
	$page ->setTpl("users-update", array(
		 "user"=>$user->getValues()
	 ));
  
 });



$app->post("/mandachuva/users/create", function() {

	User::verifyLogin();

   $user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

	$_POST['despassword'] = password_hash($_POST["despassword"], PASSWORD_DEFAULT, [

		"cost"=>12

	]);

	$user->setData($_POST);

	$user->save();

	header("Location: /mandachuva/users");
	exit;


});



$app->post("/mandachuva/users/:iduser", function($iduser) {

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0; 

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /mandachuva/users");
	exit;

});



$app->get("/mandachuva/forgot", function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot");

	});



$app->post("/mandachuva/forgot", function(){


	$user = User::getForgot($_POST["email"]);

	header("Location /mandachuva/forgot/sent");
	exit;

});



$app->get("/mandachuva/forgot/sent", function(){

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-sent");	

});

$app->get("/mandachuva/forgot/reset", function(){ 

	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset", array(
		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));

});

$app->post("/mandachuva/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);

	User::setForgotUsed($forgot["idrecover"]);

	$password = password_hash($_POST["password"], PASSWORD_DEFAULT, [

		"cost"=>12]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$user->setPassword($_POST["password"]);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset-success");
});



$app->run();



?>
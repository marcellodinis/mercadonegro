<?php

use \Mercadonegro\PageAdmin; 
use \Mercadonegro\Model\User;
use \Mercadonegro\Model\Category;


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

?>

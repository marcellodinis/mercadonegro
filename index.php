<?php 
session_start();
require_once("vendor/autoload.php"); //Carregar as dependências do Composer.

use \Slim\Slim;
use \Mercadonegro\Page;
use \Mercadonegro\PageAdmin; 
use \Mercadonegro\Model\User;

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

$app->run();

?>
<?php 

require_once("vendor/autoload.php"); //Carregar as dependências do Composer.

use \Slim\Slim;
use \Mercadonegro\Page;
use \Mercadonegro\PageAdmin;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");

});

$app->get('/mandachuva', function() {

	$page = new PageAdmin();
	
	$page->setTpl("index");
	
	


});

$app->run();

?>
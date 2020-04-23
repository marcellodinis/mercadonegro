<?php 

require_once("vendor/autoload.php"); //Carregar as dependências do Composer.

use \Slim\Slim;
use \Mercadonegro\Page;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");

    
/*	$sql = new Mercadonegro\DB\Sql();

	$results = $sql->select("SELECT * FROM tb_users");

	echo json_encode($results);

*/// Só para testes de ligação à DB.

});

$app->run();

?>
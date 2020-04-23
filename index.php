<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");
    
/*	$sql = new Mercadonegro\DB\Sql();

	$results = $sql->select("SELECT * FROM tb_users");

	echo json_encode($results);

////FINS DE TESTE SÓ
*/
});

$app->run();

 ?>
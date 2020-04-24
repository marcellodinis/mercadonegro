<?php

use \Slim\Slim;
use \Mercadonegro\Page;
use \Mercadonegro\PageAdmin; 
use \Mercadonegro\Model\User;
use \Mercadonegro\Model\Category;
use \Mercadonegro\Mailer;

$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");
});


?>

<?php 
session_start();
require_once("vendor/autoload.php"); //Carregar as dependências do Composer.

use \Slim\Slim;
use \Mercadonegro\Page;
use \Mercadonegro\PageAdmin; 
use \Mercadonegro\Model\User;
use \Mercadonegro\Model\Category;
use \Mercadonegro\Mailer;

$app = new Slim();

$app->config('debug', true);

require_once("site.php");
require_once("admin.php");
require_once("admin-user.php");
require_once("categories.php");
require_once("products.php");

$app->run();



?>
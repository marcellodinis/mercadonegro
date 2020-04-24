<?php

use \Mercadonegro\Page;
use \Mercadonegro\PageAdmin; 
use \Mercadonegro\Model\User;
use \Mercadonegro\Model\Category;


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

?>

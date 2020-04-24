<?php

use \Slim\Slim;
use \Mercadonegro\Page;
use \Mercadonegro\PageAdmin; 
use \Mercadonegro\Model\User;
use \Mercadonegro\Model\Category;
use \Mercadonegro\Model\Product;




$app->get("/mandachuva/products", function(){

    User::verifyLogin();

    $products = Product::listAll();

    $page = new PageAdmin();

    $page->setTpl("products", [
        "products"=>$products

    ]);
});



$app->get("/mandachuva/products/create", function(){

    User::verifyLogin();

    $page = new PageAdmin();

    $page->setTpl("products-create");

    });



$app->post("/mandachuva/products/create", function(){

    User::verifyLogin();
    
    $product = new Product();
    
    $product->setData($_POST);

    $product->save();

    header("Location: /mandachuva/products");
    exit;
    
    });


$app->get("/mandachuva/products/:idproduct", function($idproduct){

    User::verifyLogin();
    
    $product = new Product();

    $product->get((int)$idproduct);

    $page = new PageAdmin();
    
    $page->setTpl("products-update", [
        'product'=>$product->getValues()
    ]);
    
    });



$app->post("/mandachuva/products/:idproduct", function($idproduct){

    User::verifyLogin();
        
    $product = new Product();
    
    $product->get((int)$idproduct);

    $product->setData($_POST);

    $product->save();
    
    if($_FILES["file"]["name"] !== "") $product->setPhoto($_FILES["file"]);

    header('Location: /mandachuva/products');
    exit;
    });


$app->get("/mandachuva/products/:idproduct/delete", function($idproduct){

    User::verifyLogin();
        
    $product = new Product();
    
    $product->get((int)$idproduct);
    
    $product->delete();
        
    header('Location: /mandachuva/products');
    exit;
        
    });


?>
<?php
include'../aplication/controller/ConsultaController.php';
	
$post = $_POST;
$get = $_GET;	

$_SERVER['POST'];


$controller;

if(isset($get)){
	$this->controller = new ConsultaController($get);
}else if(isset($post)){
	$this->controller = new ConsultaController($post);
}



?>
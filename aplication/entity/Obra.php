<?php

class Obra {

	private $objref;
	private $codecad;
	private $titulo;
	private $dtRegistro;




public function setObjref($objref){
	$this->objref = $objref;

}	

public function getObjref(){
	return $this->objref;

}	


public function setCodecad($codecad){
	$this->codecad = $codecad;

}	

public function getCodecad(){
	return $this->codecad;

}


public function setTitulo($titulo){
	$this->titulo = $titulo;

}	

public function getTitulo(){
	return $this->titulo;

}



public function setDtRegistro($dtRegistro){
	$this->dtRegistro = $dtRegistro;

}	

public function getDtRegistro(){
	return $this->dtRegistro;

}







}


?>
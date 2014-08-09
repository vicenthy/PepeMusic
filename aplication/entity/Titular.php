<?php

 class Titular {

private $objref;
private $nome;
private $codecad;
private $tipopessoa;
private $nomeFantasia;
private $sexo;
private $dtNascimento;






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


public function setNome($nome){
	$this->nome = $nome;

}	

public function getNome(){
	return $this->nome;

}

public function setNomeFantasia($nomeFantasia){
	$this->nomeFantasia = $nomeFantasia;

}	

public function getNomeFantasia(){
	return $this->nomeFantasia;

}


public function setTipoPessoa($tipopessoa){
	$this->tipopessoa = $tipopessoa;

}	

public function getTipoPessoa(){
	return $this->tipopessoa;

}




public function setSexo($sexo){
	$this->sexo = $sexo;

}	

public function getSexo(){
	return $this->sexo;

}

public function setDtNascimento($dtNascimento){
	$this->dtNascimento = $dtNascimento;

}	

public function getDtNascimento(){
	return $this->dtNascimento;

}






	
}


?>
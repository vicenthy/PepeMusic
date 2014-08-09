<?php

class ObraTitular {
	
private $objref;
private $obra;
private $titular;
private $portentual;



public function setObjref($objref){
	$this->objref = $objref;

}	

public function getObjref(){
	return $this->objref;
}	


public function setPercentual($percentual){
	$this->percentual = $percentual;
}	

public function getPercentual(){
	return $this->percentual;
}	


public function setObra($obra){
	$this->obra = $obra;
}	

public function getObra(){
	return $this->obra;
}



public function setTitular($titular){
	$this->titular = $titular;
}	

public function getTitular(){
	return $this->titular;
}


}



?>
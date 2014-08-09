<?php

include'../entity/Titular.php';
include'../entity/Obra.php';
include'../entity/ObraTitular.php';



class LerArquivo{

protected    $arquivo;
protected    $linha;
protected  $diretorio = "c:\\pepe.txt";
public $link; 
private $obra;
private $titular;
private $obraTitular;
public $porcentagem;
private $cadastro1Obra = "0661OBM1";
private $cadastro2ObraTitulares = "0661OBM2";
private $fimRegistro = "0669OBM0";


function lerArquivo(){

$arquivo = fopen($this->diretorio, "r");

while(!feof($arquivo)){

$linha = fgetss($arquivo);


if(substr($linha, 0,8)==$this->cadastro1Obra){

$this->obterObra($linha);

}if(substr($linha, 0,8)==$this->cadastro2ObraTitulares){

$this->obraTitular = new ObraTitular();
$this->obterTitular($linha);

}if(substr($linha, 0,8)==$this->fimRegistro){
	
	//$this->inserirObratitular($obraTitular);

}


}

fclose($arquivo);

}





public function conexao(){

$this->link = new mysqli("localhost","root","","pepemusic");
if($this->link->connect_error){
	 die("Error ao conectar");
}
//$link->query("insert into titular values (null,'teste','123','f','teste','masculino','1989-03-03')");


}





function obterTitular($linha){

$codecad = $this->obterCampoLayout($linha, 36, 13);
$nome = $this->obterCampoLayout($linha, 64, 70);
$nomeFantasia = $this->obterCampoLayout($linha, 226, 45);
$tipoPessoa = $this->obterCampoLayout($linha, 134, 1);
$this->porcentagem = $this->obterCampoLayout($linha, 181, 5);

	$titular = new Titular();
	$titular->setObjref(null);
	$titular->setNome($nome);
	$titular->setNomeFantasia($nomeFantasia);
	$titular->setCodecad($codecad);
	$titular->setTipoPessoa($tipoPessoa);
	$this->porcentagem = ltrim($this->converterPercentual($this->porcentagem),'0');

	$this->obraTitular->setObra($this->obra);
	$this->obraTitular->setTitular($titular);
	$this->obraTitular->setPercentual($this->porcentagem);


	print("========================================================================</br>");		
	print("OBRA-> ".$this->obraTitular->getObra()->getTitulo()."</br>");
    print("TITULAR DA OBRA-> ".$this->obraTitular->getTitular()->getNome()."</br>");		
	print("TITULAR PERCENTUAL-> ".$this->obraTitular->getPercentual()."</br>");		
	print("========================================================================</br>");		
	$this->inserirObratitular($this->obraTitular);


if(!$this->buscarTitular($codecad)){
$this->inserirTitular($titular);
}


}



function obterObra($linha){

$codecad = $this->obterCampoLayout($linha, 9, 13);
$titulo= $this->obterCampoLayout($linha, 36, 95);
$obra = new Obra();
$obra->setTitulo($titulo);
$obra->setCodecad($codecad);

$this->obra = $obra;

if(!$this->buscarObra($codecad)){
$this->inserirObra($obra);
}

}




function obterCampoLayout($registro, $posini, $posfim){
return substr($registro, $posini, $posfim);

}


function inserirTitular($titular){

$this->link->query("insert into titular values (null,'".ltrim($titular->getNome(),'0')."','".ltrim($titular->getCodecad(),'0')."','".ltrim($titular->getTipoPessoa(),'0')."','".ltrim($titular->getNomeFantasia(),'0')."','null','null')");	
print("RESGITRO INSERIDO </br>");
print("LINHA NOME TITULAR:  -> :  ".ltrim($titular->getNome(),'0')."</br>");
print("LINHA NOME FANTASIA TITULAR:  -> :  ".ltrim($titular->getNomeFantasia(),'0')."</br>");
print("LINHA TIPO PESSOA TITULAR:  -> :  ".ltrim($titular->getTipoPessoa(),'0')."</br>");
print("LINHA CODECAD TITULAR:  -> :  ".ltrim($titular->getCodecad(),'0')."</br>");
print("LINHA PERCENTUAL:  -> :  ".$this->porcentagem."</br>");

}


function inserirObra($obra){

$this->link->query("insert into obra values (null,'".$obra->getTitulo()."', '".ltrim($obra->getCodecad(),'0')."',null)") or die("erro no sql");	

print("RESGITRO INSERIDO </br>");
print("LINHA CODECAD OBRA:  -> :  ".ltrim($obra->getCodecad(),'0')."</br>");
print("LINHA TITULO:  -> :  ".$obra->getTitulo()."</br>");

}


function inserirObratitular($obratitular){
	
$objreftitular = $this->obterIdTitular($obratitular->getTitular()->getCodecad());
$objrefobra = $this->obterIdObra($obratitular->getObra()->getCodecad());

$this->link->query("insert into obratitular values (null,".$objreftitular.", ".$objrefobra.", ".$obratitular->getPercentual().")") or die("Erro no sql ".mysql_error());	
	print("OBRA TITULAR INSEIDA COM SUCESSO!</br>");		

}

function buscarTitular($codecad){

$this->conexao();
$sql = "select * from titular where codecad = ".$codecad;

$resultado = $this->link->query($sql);

if($resultado->fetch_object()){
	print("Achei!!!!"."</br>");
$resultado->free();
	return true;
}
	print("Achei Nada!!!!"."</br>");
		$resultado->free();
return false;
}



function obterIdTitular($codecad){
$objreftitular;
$this->conexao();
$sql = "select * from titular where codecad = ".$codecad;
$resultado = $this->link->query($sql);

if($resultado = $resultado->fetch_object()){
$objreftitular = $resultado->objref;

}

print($objreftitular."</br>");

return $objreftitular;
}


function obterIdObra($codecad){
$objrefobra;
$this->conexao();
$sql = "select * from obra where codecad = ".$codecad;
$resultado = $this->link->query($sql);

if($resultado = $resultado->fetch_object()){
$objrefobra = $resultado->objref;

}

print($objrefobra."</br>");

return $objrefobra;

}



function buscarObra($codecad){

$this->conexao();
$sql = "select * from obra where codecad = ".$codecad;

$resultado = $this->link->query($sql);

if($resultado->fetch_object()){
	print("Achei!!!!"."</br>");
$resultado->free();
	return true;
}
	print("Achei Nada!!!!"."</br>");
		$resultado->free();
return false;
}





function  converterPercentual($valor){

$valor1 = substr($valor, 0,3);
$valor2 = substr($valor, 3,strlen($valor));

return $valor1.".".$valor2;

}




}





$ler = new LerArquivo();
$ler->conexao();
$ler->lerArquivo();


?>
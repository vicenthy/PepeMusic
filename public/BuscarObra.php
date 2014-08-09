<?php



try{

if($_GET["action"]=="listObra"){


$link = new mysqli("localhost","root","","pepemusic");

if($link->connect_error){
	 die("Error ao conectar");
}

$sqlObra= "SELECT o.objref as obraobjref, o.titulo as titulo, o.codecad as obracodecad FROM obra o" 
		." INNER JOIN obratitular ot"  
		." ON o.objref = ot.objref_obra"
		." INNER JOIN titular t ON t.objref = ot.objref_titular"
		." WHERE t.objref = ".$_GET["objref"];


$resultadoObra = $link->query($sqlObra);
		while($rowObra = $resultadoObra->fetch_array())
		{
		    $rowsObra[] = $rowObra;
		}

		$jTableResultObra = array();
		$jTableResultObra['Result'] = "OK";
		$jTableResultObra['Records'] = $rowsObra;

		print json_encode($jTableResultObra);



}



}catch(Exception $ex){
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}



?>
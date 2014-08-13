<?php




try{

if($_GET["action"]=="listObra"){

$link = new mysqli("192.185.216.114","pepemusi_atila","26642115","pepemusi_consulta");

if($link->connect_error){
	 die("Error ao conectar");
}


$sqlObra= "SELECT  t.nome as nometitular, ot.percentual as" 
	    ." percentual FROM obra o" 
		." INNER JOIN obratitular ot"  
		." ON o.objref = ot.objref_obra"
		." INNER JOIN titular t ON t.objref = ot.objref_titular"
		." WHERE o.objref = ".$_GET["objref"];


$resultadoObra = $link->query($sqlObra) or trigger_error($link->error."[$sqlObra]");
		while($rowObra = $resultadoObra->fetch_array())
		{
		    $rowsObra[] = $rowObra;
		}

			print json_encode($rowsObra);



}



}catch(Exception $ex){
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}



?>
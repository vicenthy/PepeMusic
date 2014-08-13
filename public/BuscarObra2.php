<?php



try{

if($_GET["action"]=="listObra"){

$link = new mysqli("192.185.216.114","pepemusi_atila","26642115","pepemusi_consulta");

if($link->connect_error){
	 die("Error ao conectar");
}



$resultadoObra = $link->query( "SELECT COUNT(*) AS RecordCount FROM obra "
						." WHERE  ".$_POST["parametroObra"]." like '%".$_POST["nomeObra"]."%'" );

		$rowObra = $resultadoObra->fetch_array() or trigger_error($link->error);
		$recordCount = $rowObra['RecordCount'];			




$sqlObra= "SELECT o.objref as obraobjref, o.titulo as titulo, o.codecad as obracodecad FROM obra o" 
		." WHERE  o.".$_POST["parametroObra"]." like '%".$_POST["nomeObra"]."%'"
		." order by o.titulo asc LIMIT ".$_GET["jtStartIndex"].", ".$_GET["jtPageSize"];



$resultadoObra = $link->query($sqlObra) or trigger_error($link->error."[$sqlObra]");		
		while($rowObra = $resultadoObra->fetch_array())
		{
		    $rowsObra[] = $rowObra;
		}


		$jTableResultObra = array();
		$jTableResultObra['Result'] = "OK";
		$jTableResultObra['TotalRecordCount'] = $recordCount;
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
<?php



try{



if($_GET["action"]=="list"){

$link = new mysqli("192.185.216.114","pepemusi_atila","26642115","pepemusi_consulta");

if($link->connect_error){
	 die("Error ao conectar");
}


	$resultado = $link->query("SELECT COUNT(*) AS RecordCount FROM titular where ".$_POST["parametro"]." like '%".$_POST["nome"]."%'" );
		$row = $resultado->fetch_array()or trigger_error($link->error);;
		$recordCount = $row['RecordCount'];			
		

$sql = "select * from titular where ".$_POST["parametro"]." like '".$_POST["nome"]."%' "." order by nome asc LIMIT ".$_GET["jtStartIndex"].", ".$_GET["jtPageSize"];

$resultado = $link->query($sql) or trigger_error($link->error."[$sql]");		


		while($row = $resultado->fetch_array())
		{
		 
		    $rows[] = $row;

		}


		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);

	
}



}catch(Exception $ex){
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = "teste";
	print json_encode($jTableResult);
}




?>
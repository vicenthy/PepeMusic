<?php

class BuscarTitular{

private $link;
	

	public function cmd(){


$link = new mysqli("192.185.216.114","pepemusi_atila","26642115","pepemusi_consulta");

if($link->connect_error){
	 die("Error ao conectar");
}


print("BANCO CONECTADO");


		if($_GET["action"]=="list"){
			$this->listar();
		}


	}




	public function listar(){

	$resultado = $this->link->query("SELECT COUNT(*) AS RecordCount FROM titular where ".$_POST["parametro"]." like '%".$_POST["nome"]."%'" );
		
		$row = $resultado->fetch_array() or trigger_error($link->error);
		$recordCount = $row['RecordCount'];

$sql = "select * from titular"." WHERE ".$_POST["parametro"]." LIKE '%".$_POST["nome"]."%'"." LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] ;
$resultado = $this->link->query($sql) or trigger_error($link->error."[$sql]");
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






public function conexao(){


}

}


?>
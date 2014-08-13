<?php

class ConsultaController{
	

private $cmd;



	public ConsultaController($cmd){
		$this->cmd = $cmd;
		$this->obterParametro()
	}	

	public void obterParametro(){	
	if($this->cmd['action'] == 'titular'){

		//Intancia da Classe que trata dados do Titular

	}else if($this->cmd['action'] == 'obra'){
		//Intancia da Classe que trata dados da Obra

	}
	
	}

}


?>
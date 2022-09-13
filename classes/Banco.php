<?php
require_once "InterfaceBanco.php";
class Banco implements InterfaceBanco {
	//Atributos
	private $host;
	private $dbname;
	private $user;
	private $senha;
	private $charset;

	//Metodos
	public function __construct($host, $dbname, $user, $senha, $charset = "utf8"){
		$this->host = $host;
		$this->dbname = $dbname;
		$this->user = $user;
		$this->senha = $senha;
		$this->charset = $charset;
	}

	public function connect(){
		try {
		return new \PDO("mysql: host={$this->host}; dbname={$this->dbname}; charset={$this->charset}", $this->user, $this->senha);
		} catch (\PDOException $erro) {
			echo "<h4>Erro! Problema ao tentar conectar com o banco de dados</h5><hr>";
			echo "<h5> Arquivo: " . $erro->getFile() . "<br/>";
			echo " Linha: " . $erro->getLine() . "<br/>";
			echo " Mensagem: " . $erro->getMessage() . "<br/>";
			echo " Informações adicionais: " . $erro->getMessage() . "<br/>" . $erro->getCode() . "<br/>" . $erro->getPrevious() . "<br/></h5>";
		
			die();
		}
	}
}
<?php
require_once "InterfaceCrianca.php";
require_once "InterfaceBanco.php";

class CrudCrianca {
	//Atributos
	private $banco;
	private $crianca;

	//Metodos

	//Construtor
	public function __construct (InterfaceBanco $banco, InterfaceCrianca $crianca){
		$this->banco = $banco->connect();
		$this->crianca = $crianca;
	}

    
	public function save(){
		if (!empty($this->crianca->getDataCad())){
			
		$sql = "INSERT INTO `crianca` (`nome`, `sobrenome`,`codigo`,`telefone`,`endereco`, `data_cad`, `data_nasc`, `cpf`,`nome_responsavel`, `turma`, `periodo`, `cei` ) VALUES (:nome,:sobrenome,:codigo,:telefone,
		:email,:data_cad,:data_nasc,:cpf,:nome_responsavel,:turma, :periodo,:cei)";

		}else{
		$sql = "INSERT INTO `crianca` (`nome`, `sobrenome`,`codigo`,`telefone`,`endereco`,  `data_nasc`,`data_cad`, `cpf`,`nome_responsavel`, `turma`, `periodo`, `cei` ) VALUES (:nome,:sobrenome,:codigo,:telefone,
		:email,:data_nasc, now() ,:cpf,:nome_responsavel,:turma, :periodo,:cei)";
		}
		$stmt = $this->banco->prepare($sql);

		$stmt->bindValue(':nome', $this->crianca->getNome());
		$stmt->bindValue(':sobrenome', $this->crianca->getSobrenome());
		$stmt->bindValue(':codigo', $this->crianca->getCodigo());
		$stmt->bindValue(':telefone', $this->crianca->getTelefone());
		$stmt->bindValue(':email', $this->crianca->getEmail());
		$stmt->bindValue(':data_nasc', $this->crianca->getdataNasc());
		$stmt->bindValue(':cpf', $this->crianca->getCpf());
		$stmt->bindValue(':nome_responsavel', $this->crianca->getNomeResponsavel());
		$stmt->bindValue(':turma', $this->crianca->getTurma());
		$stmt->bindValue(':periodo', serialize($this->crianca->getPeriodo()));
		$stmt->bindValue(':cei', serialize($this->crianca->getCei()));
		if (!empty($this->crianca->getDataCad())){

		$stmt->bindValue(':data_cad', $this->crianca->getDataCad());
		}
		//echo $stmt->execute();
		$resultado = $stmt->execute();

		if(!$resultado){
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "</pre>";
			return false;
		} else {
			return $this->banco->lastInsertId();
		}

	
	


	}


	public function delete(int $id){
		//sei que não precisa validar. 
		$id = filter_var($id, FILTER_VALIDATE_INT);

		if($id === 0 && !is_int($id) && $id <= 0 && !$id){
			return false;
		}

		$query = "DELETE FROM `crianca` where id = :id";
		$stmt = $this->banco->prepare($query);
		$stmt->bindValue(':id', $id);
		$resultado = $stmt->execute();
		if(!$resultado){
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "</pre>";
			return false;
		} else {
			return $stmt->rowCount();
		}
	}


	public function update(){
		//sei que não precisa validar. 		
		$id = filter_var($this->crianca->getId(), FILTER_VALIDATE_INT);
		if($id === 0 && !is_int($id) && $id <= 0 && !$id){
			return false;
		}

		$sql = "UPDATE crianca set motivo_desativado = "."'".$this->crianca->getMotivo()."'"." , usuario = ".$this->crianca->getUsuario()." , data_desativado = now() , ativo = 0 
		where id = '".$this->crianca->getId()."'" ;

		$stmt = $this->banco->prepare($sql);
		//echo $sql;
	
         
		$resultado = $stmt->execute();
		//echo $resultado;
		if(!$resultado){
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "</pre>";
			return false;		
		} else {
			return $resultado;
		}

	}

    
	public function list(){
		$sql = "SELECT * FROM `crianca` ";
		$sql = "select *, CASE turma
		WHEN '0'     THEN     'Berçário 1'
		WHEN '1'     THEN     'Berçário 2'
		WHEN '2'     THEN     'Maternal'
		WHEN '3'     THEN     'Jardim'
		WHEN '4'     THEN     'Pré 1'
		WHEN '5'     THEN     'Berçário 1'
		ELSE 'erro' END as turma
        from crianca ";
		$stmt = $this->banco->prepare($sql);
		$stmt->execute();
		$arraycrianca = array();

		foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $value){
			$crianca = new Crianca();
			$crianca->setId($value["id"])->setNome($value["nome"])->setSobrenome($value["sobrenome"])->setTurma($value["turma"])->
			setCei(unserialize($value["cei"]))->setCpf($value["cpf"])->setDataNasc($value["data_nasc"])->setEmail($value["endereco"])->
			setNomeResponsavel($value["nome_responsavel"])->setPeriodo(unserialize($value["periodo"]))->setTelefone($value["telefone"])->
			setCodigo($value["codigo"])->setDataCad($value["data_cad"])->setStatus($value["ativo"])->setMotivo($value["motivo_desativado"]);
			array_push($arraycrianca,$crianca);
	    }
		return $arraycrianca;
	}

	public function listAtivos(){
		$sql = "SELECT * FROM `crianca` ";
		$sql = "select *, CASE turma
		WHEN '0'     THEN     'Berçário 1'
		WHEN '1'     THEN     'Berçário 2'
		WHEN '2'     THEN     'Maternal'
		WHEN '3'     THEN     'Jardim'
		WHEN '4'     THEN     'Pré 1'
		ELSE 'erro' END as turma
        from crianca where ativo = 1 order by id";
		$stmt = $this->banco->prepare($sql);
		$stmt->execute();
		$arraycrianca = array();

		foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $value){
			$crianca = new Crianca();
			$crianca->setId($value["id"])->setNome($value["nome"])->setSobrenome($value["sobrenome"])->setTurma($value["turma"])->
			setCei(unserialize($value["cei"]))->setCpf($value["cpf"])->setDataNasc($value["data_nasc"])->setEmail($value["endereco"])->
			setNomeResponsavel($value["nome_responsavel"])->setPeriodo(unserialize($value["periodo"]))->setTelefone($value["telefone"])->
			setCodigo($value["codigo"])->setDataCad($value["data_cad"])->setStatus($value["ativo"]);
			array_push($arraycrianca,$crianca);
	    }
		return $arraycrianca;
	}

	public function find(int $id){
		//sei que não precisa validar. 
		$id = filter_var($id, FILTER_VALIDATE_INT);
		$sql = "SELECT * FROM `crianca` where id = :id";

		$stmt = $this->banco->prepare($sql);
		$stmt->bindValue(':id', $id);
		$resultado = $stmt->execute();
		if(!$resultado){
			echo "<pre>";
				print_r($stmt->errorInfo());
			echo "<;pre>";
			return false;
		} else {
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}

	}

}
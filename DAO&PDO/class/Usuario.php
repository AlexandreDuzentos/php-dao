<?php
class Usuario  {
	private $idusuario;
	private $deslogin;
	private $dtcadastro;
	private $desenha;

	public function setIdusuario($idusuario){
           $this->idusuario=$idusuario;
	}

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setDeslogin($deslogin){
         $this->deslogin=$deslogin;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDtcadastro($dtcadastro){
               $this->dtcadastro=$dtcadastro;
	}
	public function getDtcadastro(){
               return $this->dtcadastro;
	}

		public function getDesenha(){
		return $this->desenha;
	}

	public function setDesenha($desenha){
               $this->desenha=$desenha;
	}

    //retorna apenas um usuario do banco
	public function loadById($id){
		$sql=new Sql();
		$results=$sql->select("SELECT * FROM tb_usuarios WHERE idusuario=:ID",array(

           ':ID'=> $id,
       ));

           if(count($results)>0){
           	$row = $results[0];
           $this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
            $this->setDesenha($row['desenha']);
           $this->setDtcadastro(new DateTime($row['dtcadastro']));

		}
		
	}
	//retorna todos os usuarios do banco
	public static function getList(){
		$sql=new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	//buscar um usuario específico
	public static function search($login){
     $sql=new Sql();
     return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH order by deslogin" ,array(
        ':SEARCH'=>"%".$login."%",
     ));
	}
	public static function login($login,$password){
		$sql=new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND desenha = :PASSWORD", array(
            ':LOGIN' => $login,
            ':PASSWORD' => $password
		));
		if(count($results)>0){
			$row=$results[0];
			$this->setIdusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
            $this->setDesenha($row['desenha']);
           $this->setDtcadastro(new DateTime($row['dtcadastro']));
		}else{
			throw new Exception("Login e/ou senha inválidos");
		}
	}

      public function setData($data){
           $this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
            $this->setDesenha($data['desenha']);
           $this->setDtcadastro(new DateTime($data['dtcadastro']));
      }
      
	//inserindo dados no banco de dados e armazenado com stored procedures
	public function insert(){
		$sql=new Sql();
		$results=$sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)",array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDesenha(),
		));
		if(count($results)>0){
			$this->setData($results[0]);
		}
	}
	//Atualizando dados da tabela
	public function update($login,$password){
		$this->setDeslogin($login);
		$this->setDesenha($password);
		$sql=new Sql();
		$sql->select("UPDATE tb_usuarios SET deslogin = :LOGIN,desenha = :PASSWORD WHERE idusuario = :ID", array(
			':LOGIN' => $this->getDeslogin(),
			':PASSWORD' => $this->getDesenha(),
			':ID' => $this->getIdusuario(),
		));
	}
	public function delete(){
		$sql=new Sql();
		$sql->select("DELETE FROM tb_usuarios WHERE idusuario = :ID",array(
             ':ID'=>$this->getIdusuario(),
		));
		$this->setIdusuario(0);
		$this->setDeslogin(null);
		$this->setDesenha(null);
		$this->setDtcadastro(new DateTime());
		
	}
public function __construct($login="",$password=""){
	$this->setDeslogin($login);
	$this->setDesenha($password);
}
public function __toString(){
	return json_encode(array(
		'idusuario'=>$this->getIdusuario(),
		'deslogin'=>$this->getDeslogin(),
		'desenha'=>$this->getDesenha(),
		'dtcadastro'=>$this->getDtcadastro()->format("d/m/Y"),

	));
}
}
?>
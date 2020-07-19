<?php
class Sql extends PDO {
	private $conn;

	public  function __construct(){
         $this->conn=new PDO("mysql:host=localhost;dbname=dbphp7","root","");
	}

	public function query($rawQuery,$params=array()){
          $stmt=$this->conn->prepare($rawQuery);

          foreach($params as $key =>$value){
          	$stmt->bindparam($key,$value);
          }
          
          $stmt->execute();
          return $stmt;
      }

      public function select($rawQuery,$parameters=array()):array{
      	$stmt= $this->query($rawQuery,$parameters);
      	$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
      	return $result;
      }

}
?>
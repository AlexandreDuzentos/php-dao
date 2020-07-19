<?php
$con=new mysqli("localhost","root","","dbphp7");

if($con->connect_error){
	echo "Error: ".$con->connect_error;
}
$stmt=$con->prepare("INSERT INTO tb_usuarios(deslogin,desenha) VALUES(?,?)");

$stmt->bind_param("ss",$login,$pass);
$login="user";
$pass="12345";
$stmt->execute();
$login="root";
$pass="fj4f8wu";
$stmt->execute();
$result=$con->query("SELECT * FROM tb_usuarios ORDER BY deslogin");
$data=array();
while($row = $result->fetch_array()){
	array_push($data,$row);
}
echo json_encode($data);


?>
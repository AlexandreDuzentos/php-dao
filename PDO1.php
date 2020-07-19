<?php
$con=new PDO("mysql:dbname=dbphp7;host:localhost","root","");


$stmt=$con->prepare("SELECT * FROM tb_usuarios ORDER BY deslogin ");
$stmt->execute();

$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $key => $value){
	var_dump($key);
	var_dump($value);

}
echo "----------------------------";
var_dump($results);

?>
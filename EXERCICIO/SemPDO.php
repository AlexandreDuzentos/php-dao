<?php
$connection=new PDO("mysql:host=localhost;dbname=casa","Alexandre","");
$statement=$connection->prepare("SELECT * FROM pessoalDeCasa ORDER BY nome");
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $key => $value){
	var_dump($key);
	var_dump($value);
}



?>
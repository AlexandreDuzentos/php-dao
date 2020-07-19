<?php
$connection=new PDO("mysql:dbname=person;host:localhost","root","");


$statemnt=$connection->prepare("SELECT * FROM persondata order by idade");

$statemnt->execute();

$result=$statemnt->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $key =>$value){
	var_dump($key);
	var_dump($value);
}
var_dump($result);

?>
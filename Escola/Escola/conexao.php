<?php

$server = "127.0.0.1";
$user = "root";
$pwd = "";
$db = "escola";

$con = new mysqli($server, $user, $pwd, $db);

if($con->connect_errno){
	echo "Falha na conexão";
}
else {
}

?>
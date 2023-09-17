<?php
require 'pdoconfig.php';


$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

?>
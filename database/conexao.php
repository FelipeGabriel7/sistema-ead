<?php

$server = 'localhost';
$db = 'escola_ead';
$user = 'root';
$password = '';


$mysqli = new mysqli($server, $user, $password, $db);

if ($mysqli->connect_errno) {
        die("Ocorreu um erro ao realizar a conexão com o BD, tente novamente" . ' ' . $mysqli->error);
}

<?php

require('../../modelo/m_conexionPage.php');
$link = conexion();

$user = $_POST["username"];

$html = '';

$username = mysqli_real_escape_string($link, $user);

$sql = "SELECT count(*) from usuario u where u.usuario = '$username'";
$result = mysqli_query($link, $sql);

while ($row = mysqli_fetch_row($result)) {
    $contUsuarios = $row[0];
}

if ($contUsuarios == 1) {
    $html .= 'El nombre de usuario ingresado ya existe. Intente nuevamente';
}

echo $html;

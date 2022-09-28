<?php

require('../../modelo/m_conexionPage.php');
$link = conexion();

$email = $_POST["correo"];

$html = '';

$correo = mysqli_real_escape_string($link, $email);

$sql = "SELECT count(*) from usuario u where u.correo = '$correo'";
$result = mysqli_query($link, $sql);

while ($row = mysqli_fetch_row($result)) {
    $contCorreos = $row[0];
}

if ($contCorreos == 1) {
    $html .= 'El correo ingresado ya esta registrado por un usuario. Intente nuevamente';
}

echo $html;

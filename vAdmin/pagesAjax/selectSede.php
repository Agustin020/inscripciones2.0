<?php

require('../../modelo/m_conexionPage.php');
$link = conexion();

$codCarrera = $_POST["carrera"];

$sql = "SELECT * FROM sede WHERE codigo IN (SELECT codigoSede FROM sede_carrera WHERE codigoCarrera3 
        IN (SELECT codigo FROM carrera WHERE codigo = '$codCarrera'))";
$result = mysqli_query($link, $sql);

if ($codCarrera == '') {
    $cadena = '<option value="">Primero debe seleccionar la carrera</option';
} else {
    $cadena = '<option value="">Seleccione...</option>';
    while ($res = mysqli_fetch_row($result)) {
        $cadena = $cadena . '<option value=' . $res[0] . '>' . $res[1] . '</option>';
    }
}

echo $cadena;

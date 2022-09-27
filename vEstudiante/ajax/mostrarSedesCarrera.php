<?php

require('../../modelo/m_conexionPage.php');
$link = conexion();

$codCarrera = $_POST['carrera'];

$sql = "SELECT s.codigo, CONCAT(s.nombre, ' (', d.nombre, ')') FROM sede s, departamentos d
        WHERE s.codigo IN (SELECT codigoSede FROM sede_carrera WHERE codigoCarrera3 
        IN (SELECT codigo FROM carrera WHERE codigo = '$codCarrera')) and s.codPostal3 = d.codPostal";

$result = mysqli_query($link, $sql);

if ($codCarrera == '') {
    $html = '<option value="">Primero debe seleccionar la carrera</option>';
} else {

    $html = '<option value="">Seleccione la sede</option>';
    while ($row = mysqli_fetch_row($result)) {
        $html .= '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
}
echo $html;

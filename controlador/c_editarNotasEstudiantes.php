<?php
error_reporting(0);
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_POST['dni'];
$codMateria = $_POST['materia'];
$notaParcial = $_POST['notaParcial'];
$notaRecup = $_POST['notaRecup'];
$notaParcial2 = $_POST['notaParcial2'];
$notaRecup2 = $_POST['notaRecup2'];
$notaGlobal = $_POST['notaGlobal'];
$notaFinal = $_POST['notaFinal'];
$fechaFinal = $_POST['fechaFinal'];
$notaFinal2 = $_POST['notaFinal2'];
$fechaFinal2 = $_POST['fechaFinal2'];
$notaFinal3 = $_POST['notaFinal3'];
$fechaFinal3 = $_POST['fechaFinal3'];
$condicion = $_POST['condicion'];

if ($notaParcial == '') {
    $notaParcial = 'null';
}
if ($notaRecup == '') {
    $notaRecup = 'null';
}
if ($notaParcial2 == '') {
    $notaParcial2 = 'null';
}
if ($notaRecup2 == '') {
    $notaRecup2 = 'null';
}
if ($notaGlobal == '') {
    $notaGlobal = 'null';
}
if ($notaFinal == '') {
    $notaFinal = 'null';
}
if ($fechaFinal == '') {
    $fechaFinal = 'null';
} else {
    $fechaFinal = "'" . $fechaFinal . "'";
}
if ($notaFinal2 == '') {
    $notaFinal2 = 'null';
}
if ($fechaFinal2 == '') {
    $fechaFinal2 = 'null';
} else {
    $fechaFinal2 = "'" . $fechaFinal2 . "'";
}
if ($notaFinal3 == '') {
    $notaFinal3 = 'null';
}
if ($fechaFinal3 == '') {
    $fechaFinal3 = 'null';
} else {
    $fechaFinal3 = "'" . $fechaFinal3 . "'";
}
if ($condicion == '') {
    $condicion = null;
}

/*echo 'notaParcial: ' . $notaParcial . '<br>';
echo 'notaRecup: ' . $notaRecup . '<br>';
echo 'notaParcial2: ' . $notaParcial2 . '<br>';
echo 'notaRecup2: ' . $notaRecup2 . '<br>';
echo 'notaGlobal: ' . $notaGlobal . '<br>';
echo 'notaFinal: ' . $notaFinal . '<br>';
echo 'fechaFinal: ' . $fechaFinal . '<br>';
echo 'notaFinal2: ' . $notaFinal2 . '<br>';
echo 'fechaFinal2: ' . $fechaFinal2 . '<br>';
echo 'notaFinal3: ' . $notaFinal3 . '<br>';
echo 'fechaFinal3: ' . $fechaFinal3 . '<br>';
echo 'condicion: ' . $condicion . '<br>';*/

if ($co->editarCalificacionesEstudiante($dni, $codMateria, $notaParcial, $notaRecup, $notaParcial2, $notaRecup2, $notaGlobal, $notaFinal, $fechaFinal, $notaFinal2, $fechaFinal2, $notaFinal3, $fechaFinal3, $condicion)) {
    $_SESSION['notasModificadas'] = true;
    header('Location: ../vAdmin/index.php?accion=verCalificaciones&dni=' . $dni);
}

<?php
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_POST['dni'];
$motivo = $_POST['retroalimentacion'];


if ($co->rechazarInscripcion($motivo, $dni)) {
    $_SESSION['rechazado'] = true;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

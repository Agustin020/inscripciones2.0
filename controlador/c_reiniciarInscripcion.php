<?php
session_start();
require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_GET['dni'];

if($co->resetearInscripcion($dni)){
    $_SESSION['inscrReseteada'] = true;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
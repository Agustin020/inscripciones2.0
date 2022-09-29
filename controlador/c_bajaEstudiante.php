<?php
session_start();
error_reporting(0);
require('../modelo/m_consultas.php');
$co = new Consultas();

$motivoBaja = $_POST['motivoBaja'];
$dni = $_POST['dni'];

$rol = $_POST['rolUsuario'];

if($co->bajaUsuario($motivoBaja, $dni)){
    $_SESSION['estudianteBaja'] = true;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

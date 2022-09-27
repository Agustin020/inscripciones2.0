<?php
error_reporting(0);
require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_GET['dni'];

if ($co->altaUsuarioEstudiante($dni)) {
    if ($co->altaEstudiante($dni)) {
        session_start();
        $_SESSION['altaOk'] = true;
        header('Location: ../vAdmin/index.php?accion=listarSolicitudAlta');
    }
}

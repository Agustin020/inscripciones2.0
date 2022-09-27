<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_GET['dni'];

if($co->eliminarSolicitud($dni)){
    session_start();
    $_SESSION['eliminadoOk'] = true;
    header('Location: ../vAdmin/index.php?accion=listarSolicitudAlta');
}
?>
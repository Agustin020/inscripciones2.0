<?php
session_start();
error_reporting(0);
require('../modelo/m_consultas.php');
$co = new Consultas();

$motivoBaja = $_POST['motivoBaja'];
$anio = $_POST['anio'];
$sede = $_POST['sede'];
$dni = $_POST['dni'];

$rolPreceptor = $_POST['rolPreceptor'];

if ($_SESSION['rol'] == 2) {
    if ($co->bajaUsuario($motivoBaja, $dni)) {
        $_SESSION['bajaOk'] = true;
        header('Location: ../vAdmin/index.php?accion=listarEstudiantes&anio&anio=' . $anio . '&sede=' . $sede);
    }
} else if ($_SESSION['rol'] == 3) {
    if ($rolPreceptor == 2) {
        if ($co->bajaUsuario($motivoBaja, $dni)) {
            $_SESSION['bajaPreceptorOk'] = true;
            header('Location: ../vAdmin/index.php?accion=listarPreceptores');
        }
    } else {
        if ($co->bajaUsuario($motivoBaja, $dni)) {
            $_SESSION['bajaOk'] = true;
            header('Location: ../vAdmin/index.php?accion=listarEstudiantesAdmin&anio=' . $anio);
        }
    }
}

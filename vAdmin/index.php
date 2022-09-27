<?php
session_start();
$accion = $_GET['accion'];

switch ($accion) {
    case 'listarBajas':
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->listarBajasContr();
        break;
    case 'agregarUsuario':
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->pageAgregarUsuarioContr();
        break;
    case 'listarEstudiantes':
        $anioCursado = $_GET['anio'];
        $codSede = $_GET['sede'];
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->listarEstudiantesContr($anioCursado, $codSede);
        break;
    case 'verCalificaciones':
        $dni = $_GET['dni'];
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->verCalificacionesContr($dni);;
        break;
    case 'asignarCalificacion':
        $materia = $_GET['materia'];
        $dni = $_GET['dni'];
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->asignarCalificacionContr($materia, $dni);
        break;
    case 'verHistorialAcademico':
        $dni = $_GET['dni'];
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->verHistorialAcademicoContr($dni);
        break;
    case 'listarSolicitudAlta':
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->listarSolicitudesAltaContr();
        break;
    case 'listarInscripciones':
        $anio = $_GET['anio'];
        $sedeActual = $_GET['sede'];
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->listarInscripcionesContr($anio, $sedeActual);
        break;
    case 'inscribirEstudiante':
        $dni = $_GET['dni'];
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->inscribirEstudianteContr($dni);
        break;

    case 'listarEstudiantesAdmin':
        $anio = $_GET['anio'];
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->listarEstudiantesAdminContr($anio);
        break;
    case 'listarPreceptores':
        require('../controlador/c_gestion.php');
        $controlador = new ControladorGestion();
        $controlador->listarPreceptoresContr();
        break;
}

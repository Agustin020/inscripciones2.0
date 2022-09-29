<?php

class ControladorGestion
{

    public function listarBajasContr()
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Listado de Bajas</title>';
        $listBajas = $co->listarBajas();
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('listarBajas.php');
    }

    public function listarEstudiantesSinCarreraContr()
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Listado de estudiantes sin carrera</title>';
        $listEstudiantesSC = $co->listarEstudiantesSinCarrera();
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('listarEstSinCarrera.php');
    }

    public function pageAgregarUsuarioContr()
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Agregar Usuario</title>';
        $listRoles = $co->listarTipoUsuarios();
        $listDepartamentos = $co->listarDepartamentos();
        $listCarreras = $co->listarCarrera();
        $listSedes = $co->listarSedes();
        $listAnios = $co->listarAnioCursado();
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('agregarUsuario.php');
    }

    public function listarEstudiantesContr($anioCursado, $codSede)
    {
        error_reporting(0);
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Listado de alumnos</title>';
        $listSedesPreceptor = $co->verificarCarrerasSedePreceptor($_SESSION['username']['usuario']);
        $listaEstudiantes = $co->listarEstudiantes($anioCursado, $codSede);
        $listCarrera = $co->listarCarrera();
        $anio = $anioCursado;
        $codigoSede = $codSede;
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('listarEstudiantes.php');
    }

    public function verCalificacionesContr($dni)
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Calificaciones</title>';
        $listCalifEstudiante = $co->listarCalificacionesEstudiante($dni);
        $estudiante = $co->mostrarNombreApellidoDni($dni);
        $anioCursadoEstudiante = $co->listarAnioCursadoEstudiante($dni);
        $carreraEstudiante = $co->listarCarreraEstudiante($dni);
        $dniEstudiante = $dni;
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('calificaciones.php');
    }

    public function asignarCalificacionContr($materia, $dni){
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Calificaciones</title>';
        $materiaEstudiante = $co->listarCalificacionMateriaEstudiante($materia, $dni);
        $estudiante = $co->mostrarNombreApellidoDni($dni);
        require('libreria.php');
        if(isset($_SESSION['rol'])){
            require('header.php');
        }
        require('asignacionCalificaciones.php');
    }

    public function verHistorialAcademicoContr($dni)
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Historial Académico</title>';
        $estudiante = $co->mostrarNombreApellidoDni($dni);
        $historial = $co->listarHistorialAcademico($dni);
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('historialAcademico.php');
    }

    public function listarSolicitudesAltaContr()
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Listado de solicitudes de alta</title>';
        $listSolicitudAlta = $co->listarSolicitudAlta();
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('listarRegistros.php');
    }

    public function listarInscripcionesContr($anio, $sedeActual)
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Listado de inscripciones</title>';
        $listInscripcion = $co->listarInscripciones($anio, $sedeActual);
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('listarInscripciones.php');
    }

    public function inscribirEstudianteContr($dni)
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Inscribir estudiante</title>';
        $listInscripcion = $co->listarInscripcionEstudiante($dni);
        $listAnioCursado = $co->listarAnioCursado();
        $listCarrera = $co->verificarCarrerasSedePreceptor($_SESSION['username']['usuario']);
        $listEstudiantes = $co->listarEstudiantesCargados();
        $listMateriasEstudiantes = $co->listarMateriasEstudiantes($dni);
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('inscribirEstudiante.php');
    }

    //ADMIN
    public function listarEstudiantesAdminContr($anio)
    {
        require('../modelo/m_consultas.php');
        echo '<title>Listado de estudiantes</title>';
        $co = new Consultas();
        $listEstudiantes = $co->listarEstudiantesAdmin($anio);
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('listarEstudiantesAdmin.php');
    }

    public function listarPreceptoresContr()
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Listado de preceptores</title>';
        $listPreceptores = $co->listarPreceptores();
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('listarPreceptores.php');
    }

    public function listarAdminsContr()
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Listado de administradores</title>';
        $listAdmin = $co->listarAdmin($_SESSION['dni']);
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('listarAdmins.php');
    }
}

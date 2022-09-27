<?php
class ControladorVistasEstudiantes
{

    public function pageInscripcion()
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Inscripción</title>';
        $anioInscripto = $co->listarAnioInscriptoEstudiante($_SESSION['dni']);
        $inscripto = $co->verificarInscripcionEstudiante($_SESSION['dni']);
        $listInscripcion = $co->listarInscripcionEstudiante($_SESSION['dni']);

        $carreraInscripto = $co->verificarCarreraInscripto($_SESSION['dni']);
        $sedeInscripto = $co->verificarSedeInscripto($_SESSION['dni']);

        $anioActual = $co->anioActual();

        $listCarreras = $co->listarCarrera();
        $listSedes = $co->listarSedes();
        $listAnios = $co->listarAnioCursado();

        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('inscripcion.php');
    }

    public function verCalificacionesContr($dni)
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Calificaciones</title>';
        $listNotas = $co->listarCalificacionesEstudiante($dni);
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('calificaciones.php');
    }

    public function verHistorialAcademicoContr($dni)
    {
        require('../modelo/m_consultas.php');
        $co = new Consultas();
        echo '<title>Historial Académico</title>';
        $historialAcademico = $co->listarHistorialAcademico($dni);
        require('libreria.php');
        if (isset($_SESSION['rol'])) {
            require('header.php');
        }
        require('historialAcademico.php');
    }
}

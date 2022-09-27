<?php

require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_POST['dni'];

$codCarrera = $_POST['selectCarreras'];
$codSede = $_POST['selectSede'];
$anioCursado = $_POST['anioCursado'];
$materias = $_POST['materias'];
$inscripto = $_POST['inscripto'];

$materiasInscriptas = '';
foreach ($materias as $materia) {
    $materiasInscriptas .= $materia . ', ';
}
if ($co->agregarInscripcion($dni, $codCarrera, $codSede, $anioCursado, $materiasInscriptas, $inscripto)) {
    session_start();
    $_SESSION['inscripcionOk'] = true;
    header('Location: ../vEstudiante/index.php?accion=inscripcion');
}


/*echo 'Dni: ' . $dni . '<br>' .
'Codigo Carrera: ' . $codCarrera . '<br>' .
'Codigo Sede: ' . $codSede . '<br>' .
'Año Cursado: ' . $anioCursado . '<br>' . 
'Materias: ' . $materiasInscriptas . '<br>' .
'Inscripto: ' . $inscripto;*/

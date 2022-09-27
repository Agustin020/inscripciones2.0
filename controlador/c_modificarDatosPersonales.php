<?php
session_start();
error_reporting(0);
require('../modelo/m_consultas.php');
$co = new Consultas();

$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$domicilio = $_POST['domicilio'];
$codPostalDep = $_POST['codPostalDep'];
$codPostal = $_POST['cPostal'];
$lugarNac = $_POST['lugarNac'];
$fechaNac = $_POST['fechaNac'];
$cel = $_POST['cel'];
$correo = $_POST['correo'];
$username = $_POST['username'];

if ($_POST['pass'] != '' || $_POST['pass'] != null) {
    $contrasenia = $_POST['pass'];
} else {
    $contrasenia = '';
}

if ($_SESSION['rol'] == 1) {
    if ($co->modificarDatosPersonales($nombre, $apellido, $domicilio, $codPostalDep, $codPostal, $lugarNac, $fechaNac, $cel, $correo, $username, $contrasenia, $dni)) {
        session_start();
        $_SESSION['datosModificadosOk'] = true;
        header('Location: ../vEstudiante/gestion.php');
    }
}else if($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3){
    if ($co->modificarDatosPersonales($nombre, $apellido, $domicilio, $codPostalDep, $codPostal, $lugarNac, $fechaNac, $cel, $correo, $username, $contrasenia, $dni)) {
        session_start();
        $_SESSION['datosModificadosOk'] = true;
        header('Location: ../vAdmin/gestion.php');
    }
}


/*echo 'Dni: ' . $dni . '<br>' .
'Nombre: ' . $nombre . '<br>' .
'Apellido: ' . $apellido . '<br>' .
'domicilio: ' . $domicilio . '<br>' .
'codPostalDep: ' . $codPostalDep . '<br>' .
'codPostal: ' . $codPostal . '<br>' .
'lugarNac: ' . $lugarNac . '<br>' .
'fechaNac: ' . $fechaNac . '<br>' .
'cel: ' . $cel . '<br>' .
'correo: ' . $correo . '<br>' .
'username: ' . $username . '<br>' .
'pass: ' . $contrasenia . '<br>';*/

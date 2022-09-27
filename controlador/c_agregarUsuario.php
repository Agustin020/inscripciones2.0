<?php
require('../modelo/m_consultas.php');
$co = new Consultas();

$contador = 0;

$rol = $_POST['rolUser'];


/*$asignarEstudiante = $co->asignarEstudiante($dni, $anioCursado);
$asignarCarreraUsuario = $co->asignarCarreraUsuario($dni, $codCarrera);
$asignarSedeUsuario = $co->asignarSedeUsuario($dni, $codSede);
$asignarCalificaciones = $co->asignarCalificacionesEstudiante($dni, $codMateria);*/

switch ($rol) {
    case 1:
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $dom = $_POST['domicilio'];
        $departamento = $_POST['departamento'];
        $codPostal = $_POST['codPostal'];
        $lugarNac = $_POST['lugarNac'];
        if(!isset($_POST['fechaNac'])){
            $fechaNac = '';
        }else{
            $fechaNac = $_POST['fechaNac'];
        }
        $celular = $_POST['cel'];

        $domicilio = str_replace("'", "\"", $dom);

        $agregarUsuarioEstudiante = $co->agregarUsuario($dni, $nombre, $apellido, $correo, $usuario, $pass, $domicilio, $codPostal, $departamento, $lugarNac, $fechaNac, $celular, 1);
        if ($agregarUsuarioEstudiante) {
            if ($co->asignarEstudiante($dni)) {
                session_start();
                $_SESSION['estudianteAgregado'] = true;
                header('Location: ../vAdmin/index.php?accion=agregarUsuario');
            }
        } else {
            session_start();
            $_SESSION['usuarioError'] = true;
            header('Location: ../vAdmin/index.php?accion=agregarUsuario');
        }

        /*echo 'dni: ' . $dni . '<br>' .
        'nombre: ' . $nombre . '<br>' .
        'apellido: ' . $apellido . '<br>' .
        'correo: ' . $correo . '<br>' .
        'usuario: ' . $usuario . '<br>' .
        'pass: ' . $pass . '<br>' . 
        'domicilio: ' . $domicilio . '<br>' . 
        'departamento: ' . $departamento . '<br>' . 
        'codPostal: ' . $codPostal . '<br>' . 
        'lugarNac: ' . $lugarNac . '<br>' . 
        'fechaNac: ' . $fechaNac . '<br>' . 
        'tipoUser: ' . $rol . '<br>' . 
        'celular: ' . $celular . '<br>'; */
        break;
    case 2:
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $dom = $_POST['domicilio'];
        $departamento = $_POST['departamento'];
        $codPostal = $_POST['codPostal'];
        $lugarNac = $_POST['lugarNac'];
        if(!isset($_POST['fechaNac'])){
            $fechaNac = '';
        }else{
            $fechaNac = $_POST['fechaNac'];
        }
        $celular = $_POST['cel'];
        $codSede = $_POST['selectSede'];

        $domicilio = str_replace("'", "\"", $dom);

        $agregarUsuarioPreceptor = $co->agregarUsuario($dni, $nombre, $apellido, $correo, $usuario, $pass, $domicilio, $codPostal, $departamento, $lugarNac, $fechaNac, $celular, 2);
        if ($agregarUsuarioPreceptor) {
            if ($co->asignarSedeUsuario($dni, $codSede)) {
                session_start();
                $_SESSION['preceptorAgregado'] = true;
                header('Location: ../vAdmin/index.php?accion=agregarUsuario');
            }
        }
        break;
    case 3:
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $dom = $_POST['domicilio'];
        $departamento = $_POST['departamento'];
        $codPostal = $_POST['codPostal'];
        $lugarNac = $_POST['lugarNac'];
        if(!isset($_POST['fechaNac'])){
            $fechaNac = '';
        }else{
            $fechaNac = $_POST['fechaNac'];
        }
        $celular = $_POST['cel'];

        $domicilio = str_replace("'", "\"", $dom);

        $agregarUsuarioAdmin = $co->agregarUsuario($dni, $nombre, $apellido, $correo, $usuario, $pass, $domicilio, $codPostal, $departamento, $lugarNac, $fechaNac, $celular, 3);
        if ($agregarUsuarioAdmin) {
            session_start();
            $_SESSION['adminAgregado'] = true;
            header('Location: ../vAdmin/index.php?accion=agregarUsuario');
        }
}

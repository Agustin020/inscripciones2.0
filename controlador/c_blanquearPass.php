<?php
session_start();
require('../modelo/m_conexionPage.php');

$link = conexion();

$emailRec = $_POST['email'];

$sql = "SELECT count(*) FROM usuario u WHERE u.correo = '$emailRec'";

$result = mysqli_query($link, $sql);
try {

    while ($row = mysqli_fetch_row($result)) {
        $correo = $row[0];
    }

    if ($correo == 1) {
        $pass = substr(md5(microtime()), 1, 10);
        $email = $_POST['email'];

        $sqlUp = "UPDATE usuario SET contraseña='$pass' WHERE correo='$email'";

        $resultUp = mysqli_query($link, $sqlUp);

        $to = $_POST['email'];
        $from = "Sistema Registro";
        $subject = "Recuperar contraseña.";
        $message = "El sistema le asignó la siguiente contraseña " . $pass . ".";

        if (mail($to, $subject, $message, $from)) {
            $_SESSION['correoOk'] = true;
            header('location: ../login.php');
        }
    } else {
        $_SESSION['correoError'] = true;
        header('location: ../login.php');
    }
} catch (Exception $e) {
    echo 'Excepción capturada: ', $e->getMessage();
}

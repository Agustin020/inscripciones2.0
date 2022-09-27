<?php

require('../../modelo/m_conexionPage.php');
$link = conexion();

$correo = $_POST["correo"];

$sql = "SELECT * from usuario u where u.correo = '$correo'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
    echo 'Al parecer el correo ingresado ya esta registrado por un usuario. Intente nuevamente
    <script>
        $("#btnSubmit").prop("disabled", true);
    </script>';
}else{
    echo '<script>
    $("#btnSubmit").prop("disabled", false);
    </script>';
}

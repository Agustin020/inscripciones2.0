<?php
function conexion()
{
    $link = mysqli_connect("localhost", "id19276062_root", "Proyecto2022.", "id19276062_inscripciones");
    return $link;
}
?>
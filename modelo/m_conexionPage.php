<?php
function conexion()
{
    $link = mysqli_connect("localhost", "root", "", "inscripciones2.0");
    return $link;
}
?>
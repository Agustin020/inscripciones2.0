<?php

require('../../modelo/m_conexionPage.php');
$link = conexion();

$codCarrera = $_POST['carrera'];

$html = '<p class="fs-6">Selecciona el Espacio Curricular al cual se inscribe</p>';

$sql1 = "SELECT m.codigo, m.nombre, m.idAnioCursado from materia m where m.codigo in (select mc.codigoMateria from materia_carrera mc
        where mc.codigoCarrera2 in (select c.codigo from carrera c where c.codigo = '$codCarrera')) and m.idAnioCursado = 1";

$sql2 = "SELECT m.codigo, m.nombre, m.idAnioCursado from materia m where m.codigo in (select mc.codigoMateria from materia_carrera mc
        where mc.codigoCarrera2 in (select c.codigo from carrera c where c.codigo = '$codCarrera')) and m.idAnioCursado = 2";

$sql3 = "SELECT m.codigo, m.nombre, m.idAnioCursado from materia m where m.codigo in (select mc.codigoMateria from materia_carrera mc
        where mc.codigoCarrera2 in (select c.codigo from carrera c where c.codigo = '$codCarrera')) and m.idAnioCursado = 3";

$result1 = mysqli_query($link, $sql1);
if (mysqli_num_rows($result1)) {
    $html .= '<p class="fs-6">Espacios curriculares de 1er Año</p>';
    while ($row = mysqli_fetch_row($result1)) {

        $html .= '<div class="list-group">
                <label class="list-group-item">
                    <input class="form-check-input me-1" name="materias[]" type="checkbox" value="' . $row[1] . '">
                    ' . $row[1] . '
                  </label>
                  </div>';
    }
}

$result2 = mysqli_query($link, $sql2);
if (mysqli_num_rows($result2)) {
    $html .= '<br><p class="fs-6">Espacios curriculares de 2do Año</p>';
    while ($row = mysqli_fetch_row($result2)) {
        $html .= '<div class="list-group">
                    <label class="list-group-item">
                    <input class="form-check-input me-1" name="materias[]" type="checkbox" value="' . $row[1] . '">
                    ' . $row[1] . '
                  </label></div>';
    }
}

$result3 = mysqli_query($link, $sql3);
if (mysqli_num_rows($result3)) {
    $html .= '<br><p class="fs-6">Espacios curriculares de 3er Año</p>';
    while ($row = mysqli_fetch_row($result3)) {

        $html .= '<div class="list-group">
                    <label class="list-group-item">
                    <input class="form-check-input me-1" name="materias[]" type="checkbox" value="' . $row[1] . '">
                    ' . $row[1] . '
                  </label></div>';
    }
}

echo $html;

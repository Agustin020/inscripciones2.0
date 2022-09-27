<?php

require('../../modelo/m_conexionPage.php');
$link = conexion();

$anio = $_POST['anio'];
$codCarrera = $_POST['carrera'];

$html = '<p class="fs-6">Selecciona el Espacio Curricular al cual se inscribio</p>
            <div class="list-group">';
switch ($anio) {
    case 1:
        $sql = "SELECT codigo, nombre FROM materia WHERE idAnioCursado = 1 AND codigo IN 
                (SELECT codigoMateria FROM materia_carrera WHERE codigoCarrera2 IN
                (SELECT codigo FROM carrera WHERE codigo = '$codCarrera'))";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_row($result)) {

            $html .= '<label class="list-group-item">
                    <input class="form-check-input me-1" name="materias[]" type="checkbox" value="' . $row[0] . '">
                    ' . $row[1] . '
                  </label></div>';
        }
        break;
    case 2:
        $sql = "SELECT codigo, nombre FROM materia WHERE idAnioCursado = 2 AND codigo IN 
                (SELECT codigoMateria FROM materia_carrera WHERE codigoCarrera2 IN
                (SELECT codigo FROM carrera WHERE codigo = '$codCarrera'))";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_row($result)) {

            $html .= '<label class="list-group-item">
                        <input class="form-check-input me-1" name="materias[]" type="checkbox" value="' . $row[0] . '">
                        ' . $row[1] . '
                      </label></div>';
        }
        break;
    case 3:
        $sql = "SELECT codigo, nombre FROM materia WHERE idAnioCursado = 3 AND codigo IN 
                (SELECT codigoMateria FROM materia_carrera WHERE codigoCarrera2 IN
                (SELECT codigo FROM carrera WHERE codigo = '$codCarrera'))";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_row($result)) {

            $html .= '<label class="list-group-item">
                            <input class="form-check-input me-1" name="materias[]" type="checkbox" value="' . $row[0] . '">
                            ' . $row[1] . '
                          </label></div>';
        }
        break;
}

echo $html;

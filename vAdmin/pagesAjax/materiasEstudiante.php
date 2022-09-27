<?php

require('../../modelo/m_conexionPage.php');
$link = conexion();

$dni = $_POST['dni'];

$html = '';

//Materias Inscriptas
$sql = "SELECT m.codigo, m.nombre from materia m where m.codigo in (select c.codigoMateria2 from calificaciones c where c.dniEstudiante2 in 
        (select e.dni from estudiante e where e.dni in (select u.dni from usuario u where u.dni = '$dni')))";

$result = mysqli_query($link, $sql);

//Año Cursado
$sqlAnio = "SELECT u.dni, u.nombre, u.apellido, e.idAnioCursado3 from usuario u, estudiante e, aniocursado a
            where u.dni = e.dni and e.idAnioCursado3 = a.id and e.dni = '$dni'";

$resultAnio = mysqli_query($link, $sqlAnio);

if (mysqli_num_rows($resultAnio) > 0) {
    if ($row = mysqli_fetch_row($resultAnio)) {
        $html .= '<p class="fs-6"><b>Año de cursado actual:</b> ' . $row[3] . '° Año<br>';
    }
}

//Carrera
$sqlCarrera = "SELECT u.dni, c.nombre 
                from usuario u, estudiante e, usuario_carrera uc, carrera c
                where u.dni = e.dni and u.dni = uc.dniUsuario3 and uc.codigoCarrera = c.codigo and u.dni = '$dni'";

$resultCarrera = mysqli_query($link, $sqlCarrera);

if (mysqli_num_rows($resultCarrera) > 0) {
    if ($row = mysqli_fetch_row($resultCarrera)) {
        $html .= '<b>Carrera:</b> ' . $row[1] . '<br>';
    }
}

//Sede
$sqlSede = "SELECT u.dni, concat(s.nombre,', ', d.nombre) as sede  
            from usuario u, estudiante e, usuario_sede us, sede s, departamentos d 
            where u.dni = e.dni and u.dni = us.dniUsuario4 and us.codigoSede3 = s.codigo and s.codPostal3 = d.codPostal and u.dni = '$dni'";

$resultSede = mysqli_query($link, $sqlSede);

if (mysqli_num_rows($resultSede) > 0) {
    if ($row = mysqli_fetch_row($resultSede)) {
        $html .= '<b>Sede:</b> ' . $row[1] . '</p>';
    }
}

if (mysqli_num_rows($result) > 0) {
    $html .= '<p class="fs-6">Materias al que se encuentra inscripto el estudiante</p>';
    while ($row = mysqli_fetch_row($result)) {
        $html .= '<div class="form-check">
        <input class="form-check-input" type="checkbox" value="' . $row[0] . '" id="flexCheckDefault' . $row[0] . '" checked="checked" disabled>
        <label class="form-check-label" for="flexCheckDefault' . $row[0] . '">
          ' . $row[1] . '
        </label>
        </div>';
    }
    echo $html;
} else {
    echo $html;
}

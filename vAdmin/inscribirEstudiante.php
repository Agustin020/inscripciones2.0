<?php
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 2) {
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>

            <style>
                .container-fields,
                .container-input {
                    width: 50%;
                }

                #fields {
                    position: relative;
                    width: 80%;
                    margin: 0 5%;
                }

                #input {
                    position: relative;
                    width: 90%;
                    margin: 0 5%;
                }

                .list-group-item {
                    background-color: transparent;
                }

                section {
                    padding: 15px;
                }

                form #btnEnviar {
                    display: flex;
                    justify-content: flex-end;
                }
            </style>

            <script>
                $(document).ready(function() {
                    $("#estudiantesSelect").select2({
                        theme: "classic",
                        maximumSelectionLength: 1,
                        language: {
                            noResults: function() {
                                return "No hay resultados";
                            },
                            searching: function() {
                                return "Buscando..";
                            },
                            maximumSelected: function() {
                                return "Solo puedes seleccionar un estudiante";
                            }
                        }
                    });
                });
            </script>

            <script>
                function buscarEstudianteMaterias(valor) {
                    var dni = valor.value;
                    $.ajax({
                        type: 'POST',
                        url: 'pagesAjax/materiasEstudiante.php',
                        data: 'dni=' + dni,
                        success: function(r) {
                            $('#resultadoMateriasInscripto').html(r);
                        }
                    });
                }

                function mostrarMateriasCarrera(selectCarrera) {
                    var codCarrera = selectCarrera.value;
                    if(codCarrera === ''){
                        $('#seccionMaterias').hide();
                    }else{
                        $('#seccionMaterias').show();
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'pagesAjax/mostrarMateriasCarreras.php',
                        data: 'carrera=' + codCarrera,
                        success: function(r) {
                            $('#divisor').show();
                            $('#resultadoMaterias').html(r);
                        }
                    })
                }
            </script>

        </head>

        <body>
            <?php
            error_reporting(0);

            if ($_SESSION['rechazado']) {
            ?>

                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Confirmado',
                        text: 'La solicitud del estudiante ha sido rechazada'
                    })
                </script>

            <?php
                unset($_SESSION['rechazado']);
            }

            if ($_SESSION['estudianteInscripto']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Confirmado',
                        text: 'El estudiante ha sido inscripto'
                    })
                </script>
            <?php
                unset($_SESSION['estudianteInscripto']);
            }
            if ($_SESSION['errorMateriasInscriptas']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'Algunas materias que selecciono para el estudiante no se han ' +
                            'podido asignar ya que el estudiante está inscripto en esas materias. Intente nuevamente.'
                    })
                </script>
            <?php
                unset($_SESSION['errorMateriasInscriptas']);
            }

            if ($_SESSION['fechaActualIgual']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El estudiante ya ha sido inscripto hoy, intente inscribirlo mañana nuevamente'
                    })
                </script>
            <?php
                unset($_SESSION['fechaActualIgual']);
            }
            ?>

            <section id="container">
                <p class="fs-5">Inscribir estudiante</p>
                <hr>
                <p class="fs-6">
                    Completar la inscripción al estudiante a buscar <br>
                    En caso de rechazar la inscripción, click en el botón <b>Rechazar</b> <br>
                    En caso de aceptar la inscripción, llenar con los datos correspondientes en la sección derecha.
                </p>
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        foreach ($listInscripcion as $datoInscripcion) {
                        ?>
                            <div class="container-fields">
                                <div class="col" id="fields">

                                    <form class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputDni" class="form-label">DNI</label>
                                            <input type="number" value="<?php echo $datoInscripcion[0]; ?>" class="form-control" id="inpuDni" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputApellido" class="form-label">Nombre y Apellido</label>
                                            <input type="text" value="<?php echo $datoInscripcion[1]; ?>" class="form-control" id="inputApellido" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="inputEmail" value="<?php echo $datoInscripcion[2]; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputTelefono" class="form-label">Teléfono</label>
                                            <input type="number" class="form-control" id="inputTelefono" value="<?php echo $datoInscripcion[3]; ?>" readonly>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputCarrera" class="form-label">Carrera</label>
                                            <input type="text" class="form-control" id="inputCarrera" value="<?php echo $datoInscripcion[4]; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputAnio" class="form-label">Año al que se inscribe</label>
                                            <input type="text" class="form-control" id="inputAnio" value="<?php echo $datoInscripcion[5]; ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputSede" class="form-label">Sede</label>
                                            <input type="text" class="form-control" id="inputSede" value="<?php echo $datoInscripcion[6]; ?>" readonly>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="textareaMaterias" class="form-label">Materias</label>
                                            <textarea class="form-control" id="textareaMaterias" rows="6" readonly><?php echo $datoInscripcion[7]; ?></textarea>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="inputInscrip" class="form-label">Fecha de Inscripción</label>
                                            <input type="date" class="form-control" id="inputInscrip" value="<?= $datoInscripcion[8] ?>" readonly>
                                        </div>

                                        <hr>

                                        <?php
                                        $datoEstadoInscripcion = $datoEstadoInscripcion[10];
                                        if ($datoInscripcion[10] == '' || $datoInscripcion[10] == null) {
                                            $estado = 'En espera de una acción';
                                        } else if ($datoInscripcion[10] == 0) {
                                            $estado = 'Rechazado';
                                        } else if ($datoInscripcion[10] == 1) {
                                            $estado = 'Aceptado';
                                        }
                                        ?>

                                        <div class="col-xxl-6 mb-3">
                                            <label for="inputInscrip" class="form-label">Estado de la inscripción</label>
                                            <input type="text" class="form-control" id="inputInscrip" value="<?= $estado ?>" readonly>
                                        </div>

                                        <?php
                                        if ($datoInscripcion[11] != '' || $datoInscripcion[11] != null) {
                                        ?>

                                            <div class="col-xxl-12 mb-3">
                                                <label for="inputInscrip" class="form-label">Retroalimentación</label>
                                                <textarea type="text" class="form-control" rows="5" readonly><?= $datoInscripcion[11] ?></textarea>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                        <?php
                                        if ($datoInscripcion[10] == '' || $datoInscripcion[10] == null) {
                                        ?>

                                            <div class="col-auto-12 d-flex justify-content-end">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalRechazo">Rechazar</button>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                    </form>

                                    <!-- Modal Rechazo Inscripcion -->
                                    <div class="modal fade" id="modalRechazo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Motivo del rechazo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../controlador/c_rechazar_inscr.php" method="POST">
                                                    <div class="modal-body">

                                                        <div class="container">

                                                            <input type="hidden" name="dni" value="<?= $_GET['dni']; ?>">

                                                            <div class="row">
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Razón del rechazo de la inscripción</label>
                                                                    <textarea class="form-control" name="retroalimentacion" id="" rows="5" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Enviar motivo</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <?php
                            if ($datoInscripcion[10] == '') {
                            ?>
                                <div class="container-input">
                                    <form action="../controlador/c_inscribirEstudiante.php" id="frmInscribir" method="post">
                                        <div class="col" id="input">

                                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                                            <input type="hidden" name="dniInscripcion" value="<?php echo $_GET['dni']; ?>">

                                            <input type="hidden" name="">

                                            <p class="fs-6">Buscar Estudiante</p>

                                            <div class="row mb3">

                                                <select class="form-select" name="dni" onchange="validarEstudiante(this); buscarEstudianteMaterias(this);" id="estudiantesSelect" multiple="multiple" required>
                                                    <optgroup label="Estudiantes">
                                                        <?php
                                                        foreach ($listEstudiantes as $estudiante) {
                                                        ?>
                                                            <option value="<?php echo $estudiante[0]; ?>">
                                                                <?php echo $estudiante[0] . ' - ' . $estudiante[1] . ' ' . $estudiante[2] . ' - ' . $estudiante[3] . ' - ' . $estudiante[4]; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </optgroup>

                                                </select>
                                                <small id="estudianteError" class="form-text text-danger"></small>
                                            </div>

                                            <div class="container-fluid">

                                                <input type="hidden" name="sede" value="<?php echo $_SESSION['sedeActual']; ?>">

                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">

                                                        <div id="resultadoMateriasInscripto">

                                                        </div>
                                                    </li>
                                                    <div class="row mb-3">
                                                        <label for="selectAnio">Año de cursado a inscribir</label>
                                                        <select class="form-select" id="selectAnio" name="selectAnio" aria-label="Default select example" required>
                                                            <option value="" selected>Seleccione...</option>
                                                            <?php
                                                            foreach ($listAnioCursado as $anio) {
                                                            ?>
                                                                <option value="<?php echo $anio[0]; ?>"><?php echo $anio[1]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <small id="anioError" class="form-text text-danger"></small>
                                                    </div>

                                                    <div class="row mb-3">

                                                        <p class="fs-6">Las materias se desplegarán al momento de seleccionar la carrera</p>

                                                        <label for="">Carrera a inscribir</label>
                                                        <select class="form-select" id="selectCarrera" name="selectCarrera" onchange="mostrarMateriasCarrera(this);" aria-label="Default select example" required>
                                                            <option value="" selected>Seleccione...</option>
                                                            <?php
                                                            foreach ($listCarrera as $carrera) {
                                                            ?>
                                                                <option value="<?php echo $carrera[0]; ?>"><?php echo $carrera[1]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <small id="carreraError" class="form-text text-danger"></small>

                                                    </div>

                                                    <div class="row mb-3" id="seccionMaterias" style="display: none;">

                                                        <div id="resultadoMaterias">

                                                        </div>

                                                        <small id="errorMaterias" class="form-text text-danger"></small>

                                                    </div>

                                                </ul>
                                                <div id="btnEnviar">
                                                    <button type="submit" id="btnSubmit" class="btn btn-primary">Aceptar</button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <script type="text/javascript" src="../js/validarInscribirEstudiante.js"></script>
        </body>

        </html>

    <?php
    }
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                background: linear-gradient(to right, lightskyblue, darkturquoise);
                padding: 10px;
            }
        </style>
    </head>

    <body>
        <p class="fs-5">Para acceder a esta sección. debe iniciar sesión. <a href="../login.php">Click Aquí</a></p>
    </body>

    </html>
<?php
}
?>
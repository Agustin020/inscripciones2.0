<?php
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 1) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <style>
                section {
                    padding: 15px;
                }

                #frmInscripcion {
                    margin: 0 20px;
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    column-gap: 50px;
                }

                #frmInscripcion #selectCarreras {
                    grid-row: 6/7;
                }

                #frmInscripcion #selectSedes {
                    grid-row: 6/7;
                }

                #frmInscripcion #anioCursado {
                    grid-row: 7/8;
                }

                #frmInscripcion #materias {
                    grid-row: 8/9;
                }

                #frmInscripcion #btnEnviar {
                    grid-row: 9/10;
                    grid-column: 2/3;
                    display: flex;
                    justify-content: flex-end;
                }
            </style>

            <script>
                function mostrarSelectSedes(carrera) {
                    var codCarrera = carrera.value;
                    mostrarSedesAjax(codCarrera);
                }

                function mostrarMateriasCarrera(carrera) {
                    if (carrera.value != '') {
                        $('#materias').show(200);
                        mostrarMateriasCarreraAjax(carrera.value);
                    } else {
                        $('#materias').hide(200);
                    }
                }

                //AJAX
                function mostrarSedesAjax(codCarrera) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajax/mostrarSedesCarrera.php',
                        data: 'carrera=' + codCarrera,
                        success: function(r) {
                            $('#sedes').html(r);
                        }
                    });
                }

                function mostrarMateriasCarreraAjax(codCarrera) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajax/mostrarMateriasCarreras.php',
                        data: 'carrera=' + codCarrera,
                        success: function(r) {
                            $('#materias').html(r);
                        }
                    });
                }
            </script>

        </head>

        <body>
            <?php
            if ($_SESSION['inscripcionOk']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Listo',
                        text: 'La inscripción se ha realizado'
                    })
                </script>
            <?php
                unset($_SESSION['inscripcionOk']);
            }
            ?>
            <section id="container">
                <p class="fs-5">Inscripción</p>
                <hr>

                <?php
                if ($anioInscripto != $anioActual) {
                ?>

                    <p class="fs-6">Llenar los datos para completar la inscripción</p>

                    <form id="frmInscripcion" action="../controlador/c_es_agregarInscripcion.php" method="post">

                        <input type="hidden" name="dni" value="<?= $_SESSION['dni']; ?>">

                        <?php
                        if ($inscripto == false) {
                        ?>
                            <div class="form-floating mb-3" id="selectCarreras">
                                <select class="form-select selectCarrera" onchange="mostrarSelectSedes(this); mostrarMateriasCarrera(this);" name="selectCarreras" id="carrera" aria-label="Floating label select example" required>
                                    <option value="">Seleccione...</option>
                                    <?php
                                    foreach ($listCarreras as $carrera) {
                                    ?>
                                        <option value="<?php echo $carrera[0]; ?>"><?php echo $carrera[1]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label for="floatingSelect">Seleccione la carrera al cual se inscribe</label>
                                <small id="carreraError" class="form-text text-danger"></small>
                            </div>

                            <div class="form-floating mb-3" id="selectSedes">
                                <select class="form-select" name="selectSede" id="sedes" aria-label="Floating label select example" required>
                                    <option value="">Primero seleccione la carrera</option>
                                </select>
                                <label for="floatingSelect">Seleccione la sede en la que va a cursar</label>
                                <small id="sedeError" class="form-text text-danger"></small>
                            </div>

                            <div class="form-floating mb-3" id="anioCursado">
                                <select class="form-select selectAnio" name="anioCursado" id="anio" aria-label="Floating label select example" required>
                                    <option value="">Seleccione...</option>
                                    <?php
                                    foreach ($listAnios as $anioCursado) {
                                    ?>
                                        <option value="<?php echo $anioCursado[0]; ?>"><?php echo $anioCursado[1]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label for="floatingSelect">Seleccione el año de cursado</label>
                                <small id="anioError" class="form-text text-danger"></small>
                            </div>

                            <input type="hidden" name="inscripto" id="inscripto" value="<?= $inscripto; ?>">

                            <?php
                        } else {
                            if (!$carreraInscripto) {
                            ?>

                                <p class="fs-6">No te encuentras registrado en una carrera</p>

                            <?php
                            } else {
                            ?>

                                <div class="form-floating mb-3" id="selectCarreras">
                                    <select class="form-select selectCarrera" onchange="mostrarMateriasCarrera(this);" name="selectCarreras" id="carrera" aria-label="Floating label select example" required>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        foreach ($carreraInscripto as $carrera) {
                                        ?>
                                            <option value="<?php echo $carrera[0]; ?>"><?php echo $carrera[1]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingSelect">Seleccione la carrera</label>
                                    <small id="carreraError" class="form-text text-danger"></small>
                                </div>

                                <input type="hidden" name="selectSede" value="<?= $sedeInscripto; ?>">

                                <div class="form-floating mb-3" id="anioCursado">
                                    <select class="form-select selectAnio" name="anioCursado" id="anio" aria-label="Floating label select example" required>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        foreach ($listAnios as $anioCursado) {
                                        ?>
                                            <option value="<?php echo $anioCursado[0]; ?>"><?php echo $anioCursado[1]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingSelect">Seleccione el año de cursado</label>
                                    <small id="sedeError" class="form-text text-danger"></small>
                                </div>

                                <input type="hidden" name="inscripto" id="inscripto" value="<?= $inscripto ?>">

                        <?php
                            }
                        }
                        ?>

                        <div id="materias">
                            
                        </div>

                        <div id="btnEnviar">
                            <button type="submit" id="btnEnviar" class="btn btn-primary">Enviar inscripción</button>
                        </div>

                    </form>

                <?php
                } else {
                ?>

                    <p class="fs-6">Ya has llenado los datos de la inscripción!</p>

                    <div class="container">

                        <?php
                        foreach ($listInscripcion as $inscripcion) {
                        ?>

                            <div class="row">

                                <div class="col-xxl-6">

                                    <div class="row">

                                        <div class="mb-3">
                                            <label for="" class="form-label">Carrera</label>
                                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" value="<?= $inscripcion[4]; ?>" placeholder="" disabled>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Año al que se inscribe</label>
                                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" value="<?= $inscripcion[5]; ?>" placeholder="" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Sede</label>
                                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" value="<?= $inscripcion[6]; ?>" placeholder="" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Materias inscriptas</label>
                                            <textarea class="form-control" name="" id="" rows="7" disabled><?= $inscripcion[7]; ?></textarea>
                                        </div>
                                    </div>

                                    <?php
                                    $date = date_create($inscripcion[8]);
                                    $fechaInscripcion = date_format($date, 'd/m/Y');
                                    ?>

                                    <div class="row">
                                        <div class="mb-3 col-xxl-auto">
                                            <label for="" class="form-label">Fecha de inscripción</label>
                                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" value="<?= $fechaInscripcion; ?>" placeholder="" disabled>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xxl-6">

                                    <?php
                                    if ($inscripcion[10] == '' || $inscripcion == null) {
                                        $estado = '<p class="fs-6">Tu solicitud de inscripción está siendo analizada.</p>';
                                    } else if ($inscripcion[10] == 1) {
                                        $estado = '<p class="fs-6 text-success">La solicitud de tu inscripción ha sido aceptada.</p>';
                                    } else if ($inscripcion[10] == 0) {
                                        $estado = '<p class="fs-6 text-danger">La solicitud de tu inscripción ha sido rechazada.</p>';
                                    }
                                    ?>

                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Estado</label>
                                            <?= $estado; ?>
                                        </div>
                                    </div>

                                    <?php
                                    if ($inscripcion[11] != '') {
                                        $retroalimentacion = $inscripcion[11];
                                    } else {
                                        $retroalimentacion = 'No especificado';
                                    }

                                    if ($inscripcion[11] != '') {
                                    ?>

                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Retroalimentación</label>
                                                <p class="fs-6"><?= $retroalimentacion; ?></p>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>

                            </div>

                        <?php
                        }
                        ?>
                    </div>

                <?php
                }
                ?>


            </section>

            <script type="text/javascript" src="../js/validarInscripcion.js"></script>

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
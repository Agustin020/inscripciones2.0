<?php
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) {
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
            </style>
        </head>

        <body>

            <section id="container">
                <?php
                foreach ($materiaEstudiante as $califMateria) {
                ?>

                    <p class="fs-5">Asignar calificación: <?= $califMateria[0] ?></p>
                    <hr>
                    <p class="fs-6">Nombre: <?= $estudiante ?></p>
                    <p class="fs-6">Completar según corresponda</p>

                    <form action="../controlador/c_editarNotasEstudiantes.php" id="frmNotas" method="post">

                        <input type="hidden" name="dni" value="<?= $califMateria[15] ?>">
                        <input type="hidden" name="materia" value="<?= $califMateria[13] ?>">

                        <div class="container border p-3">
                            <div class="row d-flex justify-content-center">
                                <div class="col-xxl-3 d-flex flex-column justify-content-center">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Calificación 1er Parcial</label>
                                        <input type="text" class="form-control" name="notaParcial" id="notaParcial" value="<?= $califMateria[1] ?>" maxlength="2" aria-describedby="helpId" placeholder="">
                                        <small id="parcialError"></small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Calificación Recuperatorio</label>
                                        <input type="text" class="form-control" name="notaRecup" id="notaRecup" value="<?= $califMateria[2] ?>" maxlength="2" aria-describedby="helpId" placeholder="">
                                        <small id="recError"></small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Calificación 2do Parcial</label>
                                        <input type="text" class="form-control" name="notaParcial2" id="notaParcial2" value="<?= $califMateria[3] ?>" maxlength="2" aria-describedby="helpId" placeholder="">
                                        <small id="parcial2Error"></small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Calificación Recuperatorio</label>
                                        <input type="text" class="form-control" name="notaRecup2" id="notaRecup2" value="<?= $califMateria[4] ?>" maxlength="2" aria-describedby="helpId" placeholder="">
                                        <small id="recup2Error"></small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Calificación Global</label>
                                        <input type="text" class="form-control" name="notaGlobal" id="notaGlobal" value="<?= $califMateria[5] ?>" maxlength="2" aria-describedby="helpId" placeholder="">
                                        <small id="globalError"></small>
                                    </div>
                                </div>

                                <div class="col-xxl-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Calificación 1er Final</label>
                                        <input type="text" class="form-control" name="notaFinal" id="notaFinal" value="<?= $califMateria[6] ?>" maxlength="2" aria-describedby="helpId" placeholder="">
                                        <small id="finalError"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha 1er Final</label>
                                        <input type="date" class="form-control" name="fechaFinal" id="fechaFinal" value="<?= $califMateria[7] ?>" aria-describedby="helpId" min="2022-01-01" placeholder="">
                                        <small id="fechaError"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Calificación 2do Final</label>
                                        <input type="text" class="form-control" name="notaFinal2" id="notaFinal2" value="<?= $califMateria[8] ?>" maxlength="2" aria-describedby="helpId" placeholder="">
                                        <small id="finalError2"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha 2do Final</label>
                                        <input type="date" class="form-control" name="fechaFinal2" id="fechaFinal2" value="<?= $califMateria[9] ?>" aria-describedby="helpId" placeholder="">
                                        <small id="fechaError2"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Calificación 3er Final</label>
                                        <input type="text" class="form-control" name="notaFinal3" id="notaFinal3" value="<?= $califMateria[10] ?>" maxlength="2" aria-describedby="helpId" placeholder="">
                                        <small id="finalError3"></small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha 3er Final</label>
                                        <input type="date" class="form-control" name="fechaFinal3" id="fechaFinal3" value="<?= $califMateria[11] ?>" aria-describedby="helpId" placeholder="">
                                        <small id="fechaError3"></small>
                                    </div>
                                </div>

                                <div class="col-xxl-3 d-flex flex-column justify-content-center">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Condición</label>
                                        <select class="form-select" name="condicion" id="condicion">
                                            <?php
                                            if ($califMateria[12] != '') {
                                            ?>
                                                <option value="<?= $califMateria[12] ?>" selected><?= $califMateria[12] ?> (Actual)</option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="" selected>Seleccione...</option>
                                            <?php
                                            }
                                            ?>
                                            <option value="Aprobado">Aprobado</option>
                                            <option value="Reprobado">Reprobado</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Recursante">Recursante</option>
                                            <option value="Libre">Libre</option>
                                            <option value="">Dejar la lista vacía</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-end">
                                <div class="col-xxl-auto">
                                    <button type="button" id="btneditar" class="btn btn-warning">Editar</button>
                                </div>
                                <div class="col-xxl-auto">
                                    <button type="submit" class="btn btn-primary">Aplicar cambios</button>
                                </div>
                            </div>
                        </div>
                    </form>

                <?php
                }
                ?>
            </section>
            <script type="text/javascript" src="../js/validarFrmNotas.js"></script>
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
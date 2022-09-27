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

                body {
                    background-color: lightskyblue;
                }

                section #informacion {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    justify-items: end;
                }

                section #informacion .col1 {
                    justify-self: start;
                }


                th,
                td {
                    vertical-align: middle;
                    text-align: center;
                }

                .dataTables_length {
                    margin-bottom: 10px;
                }

            </style>
            <script>
                $(document).ready(function() {
                    function addZero(i) {
                        if (i < 10) {
                            i = "0" + i;
                        }
                        return i;
                    }

                    const dNow = new Date();
                    let h = addZero(dNow.getHours());
                    let m = addZero(dNow.getMinutes());

                    let time = h + ":" + m;
                    var localdate = dNow.getDate() + '/' + (dNow.getMonth() + 1) + '/' + dNow.getFullYear() + ' ' + time;
                    var estudiante = document.getElementById('estudiante').innerText;

                    $('#tablaDinamicaLoad').DataTable({
                        dom: 'Bfrtip',
                        paging: false,
                        aaSorting: [],
                        buttons: [{
                                extend: 'excelHtml5',
                                title: 'Calificaciones',
                                messageTop: 'Reporte: ' + localdate,
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                orientation: 'landscape',
                                pageSize: 'A4',
                                download: 'open',
                                title: 'Calificaciones',
                                messageTop: 'Reporte: ' + localdate + '\n' + estudiante,
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
                                }
                            },
                        ],
                        language: {
                            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                        }
                    })
                })
            </script>

            <script>
                function capturarFechaFinal() {
                    var fechaFinal = $('input[name=fechaFinal]').val();
                    var fechaFinal2 = $('input[name=fechaFinal2]').val();
                    var fechaFinal3 = $('input[name=fechaFinal3]').val();

                    $('input[name=fechaFinal2]').prop('min', fechaFinal);
                    $('input[name=fechaFinal3]').prop('min', fechaFinal2);

                    if (fechaFinal !== '') {
                        if (fechaFinal === fechaFinal2) {
                            $('#btnGuardar').prop('disabled', true);
                            $('#fechaIgual2').show();

                        } else {
                            $('#btnGuardar').prop('disabled', false);
                            $('#fechaIgual2').hide();
                            $('input[name=fechaFinal2]').prop('disabled', false);
                        }
                    } else if (fechaFinal === '') {
                        $('input[name=fechaFinal2]').prop('disabled', true);
                        $('input[name=fechaFinal3]').prop('disabled', true);
                        $('input[name=fechaFinal2]').val('');
                        $('input[name=fechaFinal3]').val('');
                    }

                    if (fechaFinal2 !== '') {
                        if (fechaFinal2 === fechaFinal3) {
                            $('#btnGuardar').prop('disabled', true);
                            $('#fechaIgual3').show();
                        } else {
                            $('#btnGuardar').prop('disabled', false);
                            $('#fechaIgual3').hide();
                            $('input[name=fechaFinal3]').prop('disabled', false);
                        }
                    } else if (fechaFinal2 === '') {
                        $('input[name=fechaFinal3]').prop('disabled', true);
                        $('input[name=fechaFinal3]').val('');
                    }

                }
            </script>
        </head>

        <body>

            <?php
            error_reporting(E_ALL ^ E_NOTICE || E_WARNING);
            if ($_SESSION['notasModificadas']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Listo',
                        text: 'Las calificaciones han sido modificadas'
                    })
                </script>
            <?php
                unset($_SESSION['notasModificadas']);
            }
            ?>

            <section id="container">

                <p class="fs-5">Calificaciones</p>
                <hr>
                <div id="informacion">
                    <p class="fs-6 col1" id="estudiante">Calificaciones de <b><?php echo $estudiante; ?></b><br></p>
                    <p class="fs-6">
                        <?php
                        foreach ($carreraEstudiante as $carrera) {
                        ?>
                            Carrera: <?php echo $carrera[1] ?>
                        <?php
                        }
                        ?>
                    </p>
                    <p class="fs-6 col1">
                        <?php
                        foreach ($anioCursadoEstudiante as $anio) {
                        ?>
                            Año de Cursado: <?php echo $anio[1] ?>
                        <?php
                        }
                        ?>
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-light" id="tablaDinamicaLoad">
                        <thead class="table-dark">
                            <th>Materias</th>
                            <th>1er Parcial</th>
                            <th>Recup.</th>
                            <th>2do Parcial</th>
                            <th>Recup.</th>
                            <th>Global</th>
                            <th>1er Final</th>
                            <th style="width: 100px;">Fecha Final</th>
                            <th>2do Final</th>
                            <th style="width: 100px;">Fecha Final</th>
                            <th>3er Final</th>
                            <th style="width: 100px;">Fecha Final</th>
                            <th>Condición</th>
                            <th>Acción</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listCalifEstudiante as $calif) {
                            ?>
                                <tr>
                                    <td><?php echo $calif[0]; ?></td>
                                    <td><?php echo $calif[1]; ?></td>
                                    <td><?php echo $calif[2]; ?></td>
                                    <td><?php echo $calif[3]; ?></td>
                                    <td><?php echo $calif[4]; ?></td>
                                    <td><?php echo $calif[5]; ?></td>
                                    <td><?php echo $calif[6]; ?></td>
                                    <td>
                                        <?php
                                        if ($calif[7] != '') {
                                            $date = date_create($calif[7]);
                                            $fechaFinal = date_format($date, 'd/m/Y');
                                            echo $fechaFinal;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $calif[8]; ?></td>
                                    <td>
                                        <?php
                                        if ($calif[9] != '') {
                                            $date = date_create($calif[9]);
                                            $fechaFinal2 = date_format($date, 'd/m/Y');
                                            echo $fechaFinal2;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $calif[10]; ?></td>
                                    <td>
                                        <?php
                                        if ($calif[11] != '') {
                                            $date = date_create($calif[11]);
                                            $fechaFinal3 = date_format($date, 'd/m/Y');
                                            echo $fechaFinal3;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $calif[12]; ?></td>
                                    <td>
                                        <a role="button" class="btn btn-outline-primary" href="index.php?accion=asignarCalificacion&materia=<?= $calif[13] ?>&dni=<?= $calif[15] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                            </svg>
                                            Editar
                                            </button>
                                    </td>
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop<?php echo $calif[13]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Editar Calificación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form action="../controlador/c_editarNotasEstudiantes.php" id="frmNotas" method="post">

                                                    <div class="modal-body">

                                                        <p class="fs-6">Materia: <?php echo $calif[0]; ?></p>

                                                        <input type="hidden" name="dni" value="<?php echo $dniEstudiante; ?>">
                                                        <input type="hidden" name="materia" value="<?php echo $calif[13]; ?>">

                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="notaParcial" value="<?php echo $calif[1]; ?>" class="form-control" id="notaParcial<?= $calif[0] ?>" placeholder="ejemplo">
                                                            <label for="floatingInput">1er Parcial</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="notaRecup" value="<?php echo $calif[2]; ?>" class="form-control" id="notaRecup" placeholder="ejemplo">
                                                            <label for="floatingInput">Recuperatorio 1er Parcial</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="notaParcial2" value="<?php echo $calif[3]; ?>" class="form-control" id="notaParcial2" placeholder="ejemplo">
                                                            <label for="floatingInput">2do Parcial</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="notaRecup2" value="<?php echo $calif[4]; ?>" class="form-control" id="notaRecup2" placeholder="ejemplo">
                                                            <label for="floatingInput">Recuperatorio 2do Parcial</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="notaGlobal" value="<?php echo $calif[5]; ?>" class="form-control" id="notaGlobal" placeholder="ejemplo">
                                                            <label for="floatingInput">Global</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="notaFinal" value="<?php echo $calif[6]; ?>" class="form-control" id="notaFinal" placeholder="ejemplo">
                                                            <label for="floatingInput">1er Final</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="date" name="fechaFinal" value="<?php echo $calif[7]; ?>" class="form-control" min="2022-01-01" id="fechaFinal" placeholder="ejemplo">
                                                            <label for="floatingInput">Fecha 1er Final</label>
                                                            <small class="form-text text-danger" style="display: none;">Las fechas de los finales son iguales</small>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="notaFinal2" value="<?php echo $calif[8]; ?>" class="form-control" id="notaFinal2" placeholder="ejemplo">
                                                            <label for="floatingInput">2do Final</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="date" name="fechaFinal2" value="<?php echo $calif[9]; ?>" class="form-control" id="fechaFinal2" placeholder="ejemplo">
                                                            <label for="floatingInput">Fecha 2do Final</label>
                                                            <small class="form-text text-danger" id="fechaIgual2" style="display: none;">Las fechas de los finales son iguales</small>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="number" name="notaFinal3" value="<?php echo $calif[10]; ?>" class="form-control" id="notaFinal3" placeholder="ejemplo">
                                                            <label for="floatingInput">3er Final</label>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="date" name="fechaFinal3" value="<?php echo $calif[11]; ?>" class="form-control" id="fechaFinal3" placeholder="ejemplo">
                                                            <label for="floatingInput">Fecha 3er Final</label>
                                                            <small class="form-text text-danger" id="fechaIgual3" style="display: none;">Las fechas de los finales son iguales</small>
                                                        </div>

                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="condicion" value="<?php echo $calif[12]; ?>" class="form-control" id="condicion" placeholder="ejemplo">
                                                            <label for="floatingInput">Condición</label>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </section>

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
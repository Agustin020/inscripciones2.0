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
        </head>

        <style>
            section {
                padding: 15px;
            }

            table th,
            td {
                vertical-align: middle;
                font-size: 15px;
            }

            table #accion {
                text-align: center;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('#tablaDinamicaLoad').DataTable({
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                    }
                })
            })
        </script>

        <body>
            <?php
            error_reporting(0);
            if ($_SESSION['inscrReseteada']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Confirmado!',
                        text: 'El estudiante ya puede inscribirse nuevamente'
                    })
                </script>
            <?php
                unset($_SESSION['inscrReseteada']);
            }
            ?>
            <section id="container">
                <p class="fs-5">Listado de inscripciones para <?php echo $_GET['anio']; ?>° Año</p>
                <hr>
                <div class="table-responsive-xxl" id="tPrincipal">
                    <table class="table table-hover table-light" id="tablaDinamicaLoad">
                        <thead class="table-dark">
                            <tr>
                                <th>DNI</th>
                                <th>Nombre y Apellido</th>
                                <th>Correo</th>
                                <th>Celular</th>
                                <th>Carrera</th>
                                <th>Sede</th>
                                <th>Fecha inscripto</th>
                                <th>Estado de inscripción</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listInscripcion as $dato) {
                            ?>
                                <tr>
                                    <td><?php echo $dato[0] ?></td>
                                    <td><?php echo $dato[1] ?></td>
                                    <td><?php echo $dato[2] ?></td>
                                    <td><?php echo $dato[3] ?></td>
                                    <td><?php echo $dato[4] ?></td>
                                    <td><?php echo $dato[6] ?></td>
                                    <td>
                                        <?php
                                        if ($dato[8] != '') {
                                            $date = date_create($dato[8]);
                                            $fechaInscripcion = date_format($date, 'd/m/Y');
                                        }
                                        ?>
                                        <?= $fechaInscripcion ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($dato[10] == '' || $dato[10] == null) {
                                            $estado = 'En espera de una acción';
                                        } else if ($dato[10] == 1) {
                                            $estado = 'Aceptado';
                                        } else {
                                            $estado = 'Rechazado';
                                        }

                                        echo $estado;
                                        ?>
                                    </td>
                                    <td id="accion">
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acción
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li>
                                                    <a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#modalInfoInscripcion<?php echo $dato[0]; ?>">
                                                        Ver más info
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" role="button" href="index.php?accion=inscribirEstudiante&dni=<?php echo $dato[0]; ?>">
                                                        Ver inscripción
                                                    </a>
                                                </li>

                                                <?php
                                                if ($dato[10] != '' && $dato[10] == 0) {
                                                ?>
                                                    <li>
                                                        <a class="dropdown-item" role="button" href="../controlador/c_reiniciarInscripcion.php?dni=<?= $dato[0] ?>">
                                                            Permitir inscribirse nuevamente
                                                        </a>
                                                    </li>

                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!--Modal Ver Info-->
                                <div class="modal fade" id="modalInfoInscripcion<?php echo $dato[0]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Info de inscripción: <?php echo $dato[1]; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $dato[0]; ?>" name="dni" id="floatingLabel" placeholder="Dni" readonly>
                                                    <label for="floatingInput">Dni</label>
                                                </div>


                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $dato[1]; ?>" name="nombreApellido" id="nombre" placeholder="..." readonly>
                                                    <label for="floatingInput">Nombre y Apellido</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $dato[2]; ?>" name="fechaNac" id="fechaNac" placeholder="..." readonly>
                                                    <label for="floatingInput">Correo</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $dato[3]; ?>" name="cel" id="cel" placeholder="..." readonly>
                                                    <label for="floatingInput">Celular</label>
                                                </div>


                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $dato[4]; ?>" name="carrera" id="carrera" placeholder="..." readonly>
                                                    <label for="floatingInput">Carrera</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $dato[5]; ?>" name="anio" id="anio" placeholder="..." readonly>
                                                    <label for="floatingInput">Año en el que se inscribe</label>
                                                </div>

                                                <div class="form-floating mb-3" id="correo">
                                                    <input type="email" class="form-control" value="<?php echo $dato[6]; ?>" name="sede" id="sede" placeholder="..." readonly>
                                                    <label for="floatingInput">Sede</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="matInscr" style="height: 200px;" placeholder="Leave a comment" id="floatingTextarea" readonly><?php echo $dato[7]; ?></textarea>
                                                    <label for="floatingTextarea">Materias inscriptas</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?= $fechaInscripcion ?>" name="fechaInscr" id="fechaInscr" placeholder="fechaInscr" readonly>
                                                    <label for="floatingInput">Fecha de inscripción</label>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
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
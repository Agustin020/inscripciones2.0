<?php
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 3) {
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

                td,
                th {
                    vertical-align: middle;
                }
            </style>

            <script>
                $(document).ready(function() {
                    $('#tablaDinamicaLoad').DataTable({
                        aaSorting: [],
                        lengthMenu: [25, 50, 75, 100, 200],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
                        }
                    })
                });
            </script>

        </head>

        <body>

            <?php
            error_reporting(0);
            if ($_SESSION['bajaOk']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Confirmado',
                        text: 'El estudiante ha sido dado de baja'
                    })
                </script>
            <?php
                unset($_SESSION['bajaOk']);
            }
            ?>

            <section id="container">
                <p class="fs-5">Lista de todos los estudiantes</p>
                <hr>

                <div class="table-responsive-xxl">
                    <table class="table table-hover table-light" id="tablaDinamicaLoad">
                        <thead class="table-dark">
                            <th>Dni</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Carrera</th>
                            <th>Sede</th>
                            <th>Año</th>
                            <th>Acción</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listEstudiantes as $estudiante) {
                            ?>
                                <tr>
                                    <td><?php echo $estudiante[0]; ?></td>
                                    <td><?php echo $estudiante[1]; ?></td>
                                    <td><?php echo $estudiante[2]; ?></td>
                                    <td><?php echo $estudiante[3]; ?></td>
                                    <td><?php echo $estudiante[4]; ?></td>
                                    <td><?php echo $estudiante[5]; ?></td>
                                    <td><?php echo $estudiante[6]; ?></td>
                                    <td><?php echo $estudiante[7]; ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acción
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li>
                                                    <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalInfo<?php echo $estudiante[0]; ?>">
                                                        Ver más info
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#modalBaja<?php echo $estudiante[0]; ?>">
                                                        Dar de baja
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Info -->
                                <?php
                                require_once('../modelo/m_consultas.php');
                                $co = new Consultas();
                                $listMateriasInscriptas = $co->listarMateriasEstudiantes($estudiante[0]);
                                ?>
                                <div class="modal fade" id="modalInfo<?php echo $estudiante[0] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Info del estudiante: <?php echo $estudiante[1] . ' ' . $estudiante[2]; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $estudiante[0]; ?>" name="dni" placeholder="Nombre" readonly>
                                                    <label for="floatingInput">Dni</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $estudiante[1]; ?>" name="nombre" placeholder="..." readonly>
                                                    <label for="floatingInput">Nombre</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $estudiante[2]; ?>" name="apellido" placeholder="..." readonly>
                                                    <label for="floatingInput">Apellido</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $estudiante[3]; ?>" name="correo" placeholder="..." readonly>
                                                    <label for="floatingInput">Correo</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $estudiante[4]; ?>" name="celular" placeholder="..." readonly>
                                                    <label for="floatingInput">Celular</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $estudiante[5]; ?>" name="carrera" placeholder="..." readonly>
                                                    <label for="floatingInput">Carrera</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $estudiante[6]; ?>" name="sede" placeholder="..." readonly>
                                                    <label for="floatingInput">Sede</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" value="<?php echo $estudiante[7]; ?>" name="anio" placeholder="..." readonly>
                                                    <label for="floatingInput">Año de cursado actual</label>
                                                </div>

                                                <p class="fs-6">Total de materias inscriptas</p>
                                                <?php
                                                foreach ($listMateriasInscriptas as $materia) {
                                                ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="<?php echo $materia[0]; ?>" id="flexCheckDefault<?php echo $materia[0]; ?>" checked disabled>
                                                        <label class="form-check-label" for="flexCheckDefault<?php echo $materia[0]; ?>">
                                                            <?php echo $materia[1]; ?>
                                                        </label>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Baja -->
                                <div class=" modal fade" id="modalBaja<?php echo $estudiante[0] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Dar de baja: <?php echo $estudiante[1] . ' ' . $estudiante[2]; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="../controlador/c_bajaUsuario.php" method="post" style="display: none;">
                                                <div class="modal-body">

                                                    <p class="fs-6">Para continuar debe especificar el motivo de la baja.</p>

                                                    <input type="hidden" name="dni" value="<?php echo $estudiante[0] ?>">

                                                    <input type="hidden" name="anio" value="<?php echo $_GET['anio'] ?>">

                                                    <div class="form-floating">
                                                        <textarea class="form-control" name="motivoBaja" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                                        <label for="floatingTextarea2">Motivo de la baja</label>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-danger">Aceptar</button>
                                                </div>
                                            </form>

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
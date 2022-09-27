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
            <title></title>
        </head>

        <style>
            section {
                padding: 15px;
            }

            section table th,
            td {
                vertical-align: middle;
            }

            section table #accion {
                text-align: center;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('#tablaDinamicaLoad').DataTable({
                    language: {
                        "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                    }
                })
            })
        </script>

        <body>
            <?php
            error_reporting(0);
            if ($_SESSION['altaOk']) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'El usuario ha sido dado de alta en el Sistema',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['altaOk']);
            }
            if ($_SESSION['eliminadoOk']) {
            ?>
                <script>
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'La solicitud del usuario ha sido eliminada',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            <?php
                unset($_SESSION['eliminadoOk']);
            }
            ?>
            <section id="container">
                <p class="fs-5">Solicitud de alta de usuarios</p>
                <hr>
                <div class="table-responsive-xxl" id="tPrincipal">
                    <table class="table table-hover table-light" id="tablaDinamicaLoad">
                        <thead class="table-dark">
                            <tr>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Celular</th>
                                <th>Nombre de Usuario</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listSolicitudAlta as $solicitud) {
                            ?>
                                <tr>
                                    <td><?php echo $solicitud[0] ?></td>
                                    <td id="nombre"><?php echo $solicitud[1] ?></td>
                                    <td id="apellido"><?php echo $solicitud[2] ?></td>
                                    <td><?php echo $solicitud[3] ?></td>
                                    <td><?php echo $solicitud[4] ?></td>
                                    <td><?php echo $solicitud[5] ?></td>
                                    <td id="accion">
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Acción
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <li>
                                                    <a class="dropdown-item" role="button" href="../controlador/c_altaUsuario.php?dni=<?php echo $solicitud[0]; ?>">
                                                        Dar de alta
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" role="button" href="../controlador/c_eliminarSolicitud.php?dni=<?php echo $solicitud[0]; ?>">
                                                        Eliminar
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
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
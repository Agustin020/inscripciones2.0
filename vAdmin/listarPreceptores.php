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
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
                        }
                    })
                })
            </script>
        </head>

        <body>
            <?php
            error_reporting(0);
            if ($_SESSION['bajaPreceptorOk']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Confirmado',
                        text: 'El preceptor ha sido dado de baja'
                    })
                </script>
            <?php
                unset($_SESSION['bajaPreceptorOk']);
            }
            ?>

            <section id="container">
                <p class="fs-5">Lista de Preceptores</p>
                <hr>

                <div class="table-responsive-xxl">
                    <table class="table table-hover table-light" id="tablaDinamicaLoad">
                        <thead class="table-dark">
                            <th>Dni</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Sede que administra</th>
                            <th>Acci??n</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listPreceptores as $preceptor) {
                            ?>
                                <tr>
                                    <td><?php echo $preceptor[0]; ?></td>
                                    <td><?php echo $preceptor[1]; ?></td>
                                    <td><?php echo $preceptor[2]; ?></td>
                                    <td><?php echo $preceptor[3]; ?></td>
                                    <td><?php echo $preceptor[4]; ?></td>
                                    <td><?php echo $preceptor[5]; ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBaja<?php echo $preceptor[0]; ?>">Dar de baja</button>
                                    </td>
                                </tr>

                                <!-- Modal Baja -->
                                <div class=" modal fade" id="modalBaja<?php echo $preceptor[0] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Dar de baja: <?php echo $preceptor[1] . ' ' . $preceptor[2]; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form action="../controlador/c_bajaUsuario.php" method="post" style="display: none;">
                                                <div class="modal-body">

                                                    <p class="fs-6">Para continuar debe especificar el motivo de la baja.</p>
                                                    
                                                    <input type="hidden" name="dni" value="<?php echo $preceptor[0]; ?>">

                                                    <input type="hidden" name="rolUsuario" value="<?php echo $preceptor[6]; ?>">

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
        <p class="fs-5">Para acceder a esta secci??n. debe iniciar sesi??n. <a href="../login.php">Click Aqu??</a></p>
    </body>

    </html>
<?php
}
?>
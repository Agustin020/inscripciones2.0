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

                th,
                td {
                    vertical-align: middle;
                }
            </style>

            <script>
                $(document).ready(function() {
                    $('#tablaDinamicaLoad').DataTable({
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                        }
                    });
                });
            </script>
        </head>

        <body>
            <section id="container">
                <p class="fs-5">Listado de bajas</p>
                <hr>
                <p class="fs-6">Se muestran los resultados de los usuarios que han sido dados de baja con su respectivo motivo</p>

                <div class="table-responsive-xxl">
                    <table class="table table-hover table-light" id="tablaDinamicaLoad">
                        <thead class="table-dark">
                            <th>Dni</th>
                            <th>Nombre y Apellido</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Sede</th>
                            <th>Fecha Baja</th>
                            <th>Motivo baja</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listBajas as $usuario) {
                            ?>
                                <tr>
                                    <td><?php echo $usuario[0]; ?></td>
                                    <td><?php echo $usuario[1]; ?></td>
                                    <td><?php echo $usuario[2]; ?></td>
                                    <td><?php echo $usuario[3]; ?></td>
                                    <td><?php echo $usuario[4]; ?></td>
                                    <td>
                                        <?php
                                        if ($usuario[5] != '') {
                                            $date = date_create($usuario[5]);
                                            $fechaBaja = date_format($date, 'd/m/Y');
                                            echo $fechaBaja;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $usuario[6]; ?></td>
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
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

            th,
            td {
                vertical-align: middle;
            }
        </style>

        <script>
            $(document).ready(function() {
                $('#tablaDinamicaLoad').DataTable({
                    dom: 'Bfrtip',
                    paging: false,
                    aaSorting: [],
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Historial académico del estudiante <?php echo $estudiante ?> ',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            orientation: 'landscape',
                            pageSize: 'A4',
                            download: 'open',
                            title: 'Historial académico del estudiante <?php echo $estudiante ?> ',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                            }
                        },
                    ],
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
                    }
                })
            })
        </script>

        <body>
            <section id="container">
                <p class="fs-5">Historial Académico</p>
                <hr>

                <p class="fs-6">Materias cursadas en total por el estudiante <b><?php echo $estudiante ?></b> con sus respectivas calificaciones</p>

                <div class="table-responsive-xxl">

                    <table class="table table-hover table-light" id="tablaDinamicaLoad">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th>Materias</th>
                                <th>Año materia</th>
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
                                <th>Fecha inscripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($historial as $calificacion) {
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $calificacion[0] ?></td>
                                    <td><?php echo $calificacion[1] ?></td>
                                    <td><?php echo $calificacion[2] ?></td>
                                    <td><?php echo $calificacion[3] ?></td>
                                    <td><?php echo $calificacion[4] ?></td>
                                    <td><?php echo $calificacion[5] ?></td>
                                    <td><?php echo $calificacion[6] ?></td>
                                    <td><?php echo $calificacion[7] ?></td>
                                    <td>
                                        <?php
                                        if ($calificacion[8] != '') {
                                            $date = date_create($calificacion[8]);
                                            $final1 = date_format($date, 'd/m/Y');
                                            echo $final1;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $calificacion[9] ?></td>
                                    <td>
                                        <?php
                                        if ($calificacion[10] != '') {
                                            $date = date_create($calificacion[10]);
                                            $final2 = date_format($date, 'd/m/Y');
                                            echo $final2;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $calificacion[11] ?></td>
                                    <td>
                                        <?php
                                        if ($calificacion[12] != '') {
                                            $date = date_create($calificacion[12]);
                                            $final3 = date_format($date, 'd/m/Y');
                                            echo $final3;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $calificacion[13] ?></td>
                                    <td>
                                        <?php
                                        if ($calificacion[14] != '') {
                                            $date = date_create($calificacion[14]);
                                            $fechaInscripto = date_format($date, 'd/m/Y');
                                            echo $fechaInscripto;
                                        }
                                        ?>
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
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
        </head>

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
                    paging: false,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
                    }
                })
            })
        </script>

        <body>
            <section id="container">
                <p class="fs-5">Calificaciones</p>
                <hr>
                <p class="fs-6">Se muestran las calificaciones del año de cursado actual</p>

                <div class="table-responsive-xxl">
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
                        </thead>

                        <tbody>
                            <?php
                            foreach ($listNotas as $nota) {
                            ?>
                                <tr>
                                    <td><?php echo $nota[0]; ?></td>
                                    <td><?php echo $nota[1]; ?></td>
                                    <td><?php echo $nota[2]; ?></td>
                                    <td><?php echo $nota[3]; ?></td>
                                    <td><?php echo $nota[4]; ?></td>
                                    <td><?php echo $nota[5]; ?></td>
                                    <td><?php echo $nota[6]; ?></td>
                                    <td>
                                        <?php
                                            if($nota[7] != ''){
                                                $date = date_create($nota[7]);
                                                $fechaFinal = date_format($date, 'd/m/Y');
                                                echo $fechaFinal;
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $nota[8]; ?></td>
                                    <td>
                                        <?php
                                            if($nota[9] != ''){
                                                $date = date_create($nota[9]);
                                                $fechaFinal2 = date_format($date, 'd/m/Y');
                                                echo $fechaFinal2;
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $nota[10]; ?></td>
                                    <td>
                                        <?php
                                            if($nota[11] != ''){
                                                $date = date_create($nota[11]);
                                                $fechaFinal3 = date_format($date, 'd/m/Y');
                                                echo $fechaFinal3;
                                            }
                                        ?>    
                                    </td>
                                    <td><?php echo $nota[12]; ?></td>
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
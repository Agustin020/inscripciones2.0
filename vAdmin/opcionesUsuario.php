<?php
session_start();
if (isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gestión de usuarios</title>

            <?php require('libreria.php'); ?>
            <style type="text/css">
                section {
                    padding: 15px;
                }

                section .tarjetas {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-evenly;
                }
            </style>

            <script>
                function confirmarAlta() {
                    var nombre = document.getElementsByTagName("td")[1].innerHTML;
                    var apellido = document.getElementsByTagName("td")[2].innerHTML;
                    event.preventDefault();
                    Swal.fire({
                        title: 'Aviso',
                        text: 'Desea dar de alta al estudiante ' + nombre + ' ' + apellido + '?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var btnAlta = document.getElementById('altabtn');
                            location.href = btnAlta;
                        }
                        return false;

                    });
                }


                function confirmarBaja() {
                    var nombre = document.getElementsByTagName("td")[1].innerHTML;
                    var apellido = document.getElementsByTagName("td")[2].innerHTML;
                    event.preventDefault();
                    Swal.fire({
                        title: 'Aviso',
                        text: 'Eliminar al estudiante ' + nombre + ' ' + apellido + '?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var btnBaja = document.getElementById('bajabtn');
                            location.href = btnBaja;
                        }
                        return false;

                    });
                }
            </script>
        </head>

        <body>
            <?php require('header.php'); ?>
            <section id="container">
                <?php
                ?>

                <p class="fs-5">Gestión de Usuarios</p>

                <div class="tarjetas">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Agregar Usuario</h5>
                            <p class="card-text">Añadir un usuario al Sistema y asignarle el rol correspondiente.</p>
                            <a href="index.php?accion=agregarUsuario" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Lista de Estudiantes</h5>
                            <p class="card-text">Mostrar el listado de todos los estudiantes en el Sistema</p>
                            <a href="index.php?accion=listarEstudiantesAdmin&anio=1" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Lista de Preceptores</h5>
                            <p class="card-text">Mostrar el listado de todos los preceptores en el Sistema</p>
                            <a href="index.php?accion=listarPreceptores" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>

            </section>
        </body>

        </html>

<?php
    }
}
?>
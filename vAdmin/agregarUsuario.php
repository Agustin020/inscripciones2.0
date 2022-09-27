<?php
error_reporting(E_ALL ^ E_NOTICE || E_WARNING);
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
            <style type="text/css">
                section {
                    padding: 15px;
                }
            </style>

            <script>
                $(document).ready(function() {
                    $('#tipoUsuario').val('');
                    $('#camposForm').find('input, select').val('');
                });

                function mostrarOpcionesUsuario(valor) {
                    var tipoUsuario = valor.value;
                    $('#camposForm').show(300);
                    if (tipoUsuario == 1) {
                        $('#camposForm').find('input, select').val('');
                        $('.preceptor').hide().find('select').prop('disabled', true);
                    } else if (tipoUsuario == 2) {
                        $('#camposForm').find('input, select').val('');
                        $('.preceptor').show().find('select').prop('disabled', false);
                    } else if (tipoUsuario == 3) {
                        $('#camposForm').find('input, select').val('');
                        $('.preceptor').hide().find('select').prop('disabled', true);
                    } else {
                        $('#camposForm').find('input, select').val('');
                        $('#camposForm').hide();
                    }
                }

                //AJAX
                function recargarSedeAjax(codCarrera) {
                    $.ajax({
                        type: 'POST',
                        url: 'pagesAjax/selectSede.php',
                        data: 'carrera=' + codCarrera.value,
                        success: function(r) {
                            $('#sede').html(r);
                        }
                    });
                }

                function mostrarMateriasCarreraAjax(carrera) {
                    $.ajax({
                        type: 'POST',
                        url: 'pagesAjax/mostrarMateriasCarreras.php',
                        data: 'carrera=' + carrera.value,
                        success: function(r) {
                            $('#materias').html(r);
                        }
                    });
                }
                
                function validarCorreoExistente(correo) {
                    $.ajax({
                        type: 'POST',
                        url: 'pagesAjax/validarCorreoExistente.php',
                        data: 'correo=' + correo.value,
                        success: function(r) {
                            $('#correoError2').html(r);
                        }
                    });
                }
            </script>

        </head>

        <body>

            <?php
            if ($_SESSION['estudianteAgregado']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Listo',
                        text: 'El estudiante ha sido añadido al sistema'
                    })
                </script>
            <?php
                unset($_SESSION['estudianteAgregado']);
            }
            if ($_SESSION['preceptorAgregado']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Listo',
                        text: 'El preceptor ha sido añadido al sistema'
                    })
                </script>
            <?php
                unset($_SESSION['preceptorAgregado']);
            }
            if ($_SESSION['adminAgregado']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Listo',
                        text: 'El administrador ha sido añadido al sistema'
                    })
                </script>
            <?php
                unset($_SESSION['adminAgregado']);
            }
            if ($_SESSION['usuarioError']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Al parecer el usuario ya existe en el Sistema. Intente nuevamente con un dni distinto'
                    })
                </script>
            <?php
                unset($_SESSION['usuarioError']);
            }
            ?>

            <section id="container">

                <p class="fs-5">Agregar Usuario</p>
                <hr>

                <div class="container">

                    <div class="row">
                        <p class="fs-6">Los campos con (*) son obligatorios. El resto de datos pueden ser completados por el usuario posteriormente</p>
                    </div>

                    <form id="formulario" method="POST" action="../controlador/c_agregarUsuario.php">

                        <div class="row justify-content-center">

                            <div class="col-xxl-3 mt-4">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tipo de usuario</label>
                                    <select class="form-select" name="rolUser" id="tipoUsuario" onchange="mostrarOpcionesUsuario(this);">
                                        <option value="">Seleccione...</option>
                                        <?php
                                        foreach ($listRoles as $rol) {
                                            if ($_SESSION['rol'] == 2 && $rol[0] == 1) {
                                        ?>
                                                <option value="<?= $rol[0]; ?>"><?= $rol[1]; ?></option>
                                            <?php
                                            } else if ($_SESSION['rol'] == 3) {
                                            ?>
                                                <option value="<?= $rol[0]; ?>"><?= $rol[1]; ?></option>

                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="col-xxl-9">

                                <div id="camposForm" class="border mt-4 p-4" style="display: none;">

                                    <div class="row mb-3">

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Dni (*)</label>
                                            <input type="text" class="form-control" name="dni" id="dni2" aria-describedby="helpId" placeholder="" maxlength="8" required>
                                            <small id="dniError2"></small>
                                        </div>

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Nombre (*)</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre2" aria-describedby="helpId" placeholder="" maxlength="50" required>
                                            <small id="nombreError2"></small>
                                        </div>

                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Apellido (*)</label>
                                            <input type="text" class="form-control" name="apellido" id="apellido2" aria-describedby="helpId" placeholder="" maxlength="50" required>
                                            <small id="apellidoError2"></small>
                                        </div>

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Correo (*)</label>
                                            <input type="email" class="form-control" oninput="validarCorreoExistente(this);" name="correo" id="correo2" aria-describedby="helpId" placeholder="" maxlength="50" required>
                                            <small id="correoError2" class="text-danger"></small>
                                        </div>

                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Nombre de usuario (*)</label>
                                            <input type="text" class="form-control" name="usuario" id="username2" aria-describedby="helpId" placeholder="" maxlength="45" required>
                                            <small id="userError2"></small>
                                        </div>

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Contraseña (*)</label>
                                            <input type="password" class="form-control" name="pass" id="pass2" aria-describedby="helpId" placeholder="" maxlength="14" required>
                                            <small id="passError2"></small>
                                        </div>

                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Domicilio</label>
                                            <input type="text" class="form-control" name="domicilio" id="domicilio2" aria-describedby="helpId" placeholder="" maxlength="200">
                                            <small id="domicilioError2"></small>
                                        </div>

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Código Postal</label>
                                            <input type="text" class="form-control" name="codPostal" id="codPostal2" aria-describedby="helpId" placeholder="" maxlength="4">
                                            <small id="codPostalError2"></small>
                                        </div>

                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Departamento (*)</label>
                                            <select class="form-select" name="departamento" id="departamento2" required>
                                                <option value="" selected>Seleccione...</option>
                                                <?php
                                                foreach ($listDepartamentos as $departamento) {
                                                ?>
                                                    <option value="<?= $departamento[0]; ?>"><?= $departamento[1]; ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                            <small id="departamentoError2"></small>
                                        </div>

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Fecha de nacimiento</label>
                                            <input type="date" class="form-control" name="fechaNac" id="fechaNac2" aria-describedby="helpId" placeholder="">
                                            <small id="fechaNacError2" class="form-text text-danger"></small>
                                        </div>

                                        <div class="col-xxl">
                                            <label for="" class="form-label">Lugar de nacimiento</label>
                                            <input type="text" class="form-control" name="lugarNac" id="lugarNac2" aria-describedby="helpId" maxlength="60" placeholder="">
                                            <small id="lugarNacError2" text></small>
                                        </div>

                                    </div>

                                    <div class="row mb-3">

                                        <div class="col-xxl-6">
                                            <label for="" class="form-label">Celular (*)</label>
                                            <input type="text" class="form-control" name="cel" id="cel2" aria-describedby="helpId" placeholder="" maxlength="10" required>
                                            <small id="celError2"></small>
                                        </div>

                                    </div>


                                    <div class="row mb-3 preceptor">

                                        <div class="col-12">

                                            <label for="" class="form-label">Sede donde se desempeñará (*)</label>
                                            <select class="form-select" name="selectSede" id="sedePreceptor2" required>
                                                <option value="" selected>Seleccione...</option>
                                                <?php
                                                foreach ($listSedes as $sede) {
                                                ?>
                                                    <option value="<?= $sede[0]; ?>"><?= $sede[1]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <small id="sedePreceptorError2"></small>
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-end">

                                        <button type="submit" id="btnSubmit" class="btn btn-primary">Guardar</button>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </section>

            <script type="text/javascript" src="../js/validarAgregarUsuario.js"></script>

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
        <title>Acceder</title>
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
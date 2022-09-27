<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('vAdmin/libreria.php'); ?>
    <title>Acceder - Gestión inscripciones-calificaciones</title>
    <style>
        .contenedor {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(to right, lightskyblue, darkturquoise);
            background-color: darkturquoise;
        }

        form {
            margin-left: 20px;
        }

        form>* {
            margin: 10px 30px;
        }

        form h4,
        span {
            color: white;
        }

        form .btnGroup {
            display: flex;
            justify-content: space-between;
        }
    </style>
    
    <script>
        function validarCorreoExistente(correo) {
            $.ajax({
                type: 'POST',
                url: 'vAdmin/pagesAjax/validarCorreoExistente.php',
                data: 'correo=' + correo.value,
                success: function(r) {
                    $('#correoError').html(r);
                }
            });
        }
    </script>

</head>

<body>
    <?php
    error_reporting(0);
    if ($_SESSION['registro'] == true) {
    ?>
        <script>
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: 'Los datos han sido enviados',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    <?php
        unset($_SESSION['registro']);
    }
    if ($_SESSION['registroError']) {
    ?>

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Al parecer, ya existe este nombre de usuario con otro DNI. Intente nuevamente con otro',
            })
        </script>
    <?php
        unset($_SESSION['registroError']);
    }

    if ($_SESSION['correoOk']) {
    ?>

        <script>
            Swal.fire({
                icon: 'success',
                title: 'Enviado!!',
                text: 'La nueva contraseña ha sido enviada a su correo',
            })
        </script>

    <?php
        unset($_SESSION['correoOk']);
    }
    
    if($_SESSION['correoError']){
    ?>
        
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'El correo ingresado no se encuentra registrado. Intente nuevamente',
            })
        </script>
        
    <?php
        unset($_SESSION['correoError']);
    }
    ?>
    <div class="contenedor">
        <form action="controlador/c_login.php" method="post" class="border border-primary">
            <img src="https://www.iesmb.edu.ar/bel/wp-content/uploads/2018/06/onlylogo.png" alt="">
            <hr>
            <?php

            if ($_SESSION['autenticacionError']) {
            ?>
                <div class="alert alert-danger" role="alert" id="msjError">
                    Datos Erronéos.
                    <br>
                    Ingrese nuevamente
                </div>
            <?php
                unset($_SESSION['autenticacionError']);
            }
            ?>

            <h4>Iniciar Sesión</h4>
            <div class="form-floating">
                <input type="text" class="form-control" name="user" id="user" placeholder="Usuario" maxlength="30">
                <label for="floatingInput">Usuario</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Contraseña" maxlength="30">
                <label for="floatingInput">Contraseña</label>
            </div>
            <div class="btnGroup">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistro">Registrarse</button>

                <button type="submit" name="submit" class="btn btn-primary">Acceder</button>
            </div>

            <div>
                <a role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>

    <!-- Modal Registro-->
    <div class="modal fade" id="modalRegistro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <form action="controlador/c_registro.php" id="frmRegistro" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <p class="fs-6">
                            Nota: Los datos enviados se evaluarán de acuerdo a la documentación presentada.<br>
                            De acuerdo a lo enviado se le dara de alta al Sistema si es que corresponde.
                        </p>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" maxlength="50" required>
                            <label for="floatingInput">Nombre</label>
                            <small id="nombreError"></small>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido" maxlength="50" required>
                            <label for="floatingInput">Apellido</label>
                            <small id="apellidoError"></small>
                        </div>

                        <?php
                        require_once('modelo/m_consultas.php');
                        $co = new Consultas();
                        $listDepartamentos = $co->listarDepartamentos();
                        ?>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelect" name="codPostalDep" id="departamento" onchange="validarDepartamentos(this);" oninvalid="departamentoInvalido(this);" aria-label="Floating label select example" required>
                                <option value="" selected>Seleccione...</option>

                                <?php
                                foreach ($listDepartamentos as $departamento) {

                                ?>
                                    <option value="<?php echo $departamento[0]; ?>"><?php echo $departamento[1]; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                            <label for="floatingSelect">Departamento donde vive</label>
                            <small id="departamentoError"></small>
                        </div>

                        <div class="form-floating mb-3" id="correo">
                            <input type="email" class="form-control" oninput="validarCorreoExistente(this);" name="email" id="email" placeholder="Correo Electrónico" maxlength="50" maxlength="70" required>
                            <label for="floatingInput">Correo Electrónico</label>
                            <small id="correoError" class="form-text text-danger"></small>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="dni" id="dni" placeholder="Dni" maxlength="8" required>
                            <label for="floatingInput">DNI</label>
                            <small id="dniError"></small>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" name="cel" id="cel" maxlength="10" placeholder="Celular" required>
                            <label for="floatingInput">Celular</label>
                            <small id="celError"></small>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Nombre de usuario" maxlength="30" required>
                            <label for="floatingInput">Nombre de usuario</label>
                            <small id="userError"></small>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" maxlength="14" required>
                            <label for="floatingInput">Contraseña</label>
                            <small id="passError"></small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Enviar</button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Blanqueo de contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="controlador/c_blanquearPass.php" method="POST">
                        <p class="fs-6">Nota: Al introducir el correo, la nueva contraseña generada se enviará al mismo email introducido</p>
                        <hr>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Introduce tu e-mail:</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="E-mail" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Recuperar Contraseña">
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/validarFrmRegistro.js"></script>
</body>

</html>
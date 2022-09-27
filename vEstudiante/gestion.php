<?php
session_start();
if (isset($_SESSION['username']['usuario']) && isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] == 1) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Inicio</title>
            <?php require('libreria.php') ?>

            <style>
                section {
                    padding: 15px;
                }


                .news-grid {
                    position: relative;
                    background: #fff;
                    border-radius: 5px;
                    overflow: hidden;
                    border: 1px solid #ddd;
                    /*box-shadow: 0px 10px 30px 0px rgba(50, 50, 50, 0.16);*/
                    margin: 10px;
                }

                .news-grid-image {
                    width: 100%;
                    height: 280px;
                    overflow: hidden;
                }

                .news-grid-image img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: 0.5s;
                }

                .news-grid-box {
                    display: block;
                    position: absolute;
                    text-align: center;
                    background: #26ccca;
                    left: -80px;
                    top: 15px;
                    padding: 10px;
                    transition: 0.5s;
                }

                .news-grid-box h1 {
                    color: #fff;
                    font-size: 30px;
                    font-weight: 400;
                    letter-spacing: 2px;
                    padding-bottom: 5px;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                    margin-bottom: 5px;
                }

                .news-grid-box p {
                    color: #fff;
                    font-size: 14px;
                    font-weight: 400;
                    margin-bottom: 0px;
                }

                .news-grid-txt {
                    padding: 25px;
                }

                .news-grid-txt span {
                    color: #26ccca;
                    font-size: 13px;
                    font-weight: 500;
                    letter-spacing: 4px;
                    text-transform: uppercase;
                }

                .news-grid-txt h2 {
                    color: #111;
                    font-size: 20px;
                    font-weight: 500;
                    letter-spacing: 1px;
                    margin: 10px 0px 5px 0px;
                }

                .news-grid-txt ul li {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;

                }

                .news-grid-txt a {
                    color: #fff;
                    background: #26ccca;
                    padding: 8px 20px;
                    border-radius: 50px;
                    font-size: 14px;
                    font-weight: 300;
                    line-height: 30px;
                    letter-spacing: 1px;
                    text-decoration-line: none;
                    transition: 0.5s;
                }

                /*Hover-Section*/
                .news-grid:hover .news-grid-box {
                    left: 15px;
                    transition: 0.5s;
                }

                .news-grid:hover .news-grid-image img {
                    filter: grayscale(1);
                    transform: scale(1.1);
                    transition: 0.5s;
                }

                .news-grid:hover .news-grid-txt a {
                    text-decoration-line: none;
                    color: #fff;
                    letter-spacing: 2px;
                    transition: 0.5s;
                }

                /*OWL*/
                .owl-controls .owl-buttons {
                    position: relative;
                }

                .owl-controls .owl-prev {
                    position: absolute;
                    left: -40px;
                    bottom: 230px;
                    padding: 8px 17px;
                    background: #26ccca;
                    border-radius: 50px;
                    transition: 0.5s;
                }

                .owl-controls .owl-next {
                    position: absolute;
                    right: -40px;
                    bottom: 230px;
                    padding: 8px 17px;
                    background: #26ccca;
                    border-radius: 50px;
                    transition: 0.5s;
                }

                .owl-controls .owl-prev:after,
                .owl-controls .owl-next:after {
                    content: "\f104";
                    font-family: FontAwesome;
                    color: #fff;
                    font-size: 16px;
                }

                .owl-controls .owl-next:after {
                    content: "\f105";
                }

                .owl-controls .owl-prev:hover,
                .owl-controls .owl-next:hover {
                    background: #000;
                }
            </style>

            <script>
                $(document).ready(function() {
                    $("#news-slider").owlCarousel({
                        items: 3,
                        navigation: true,
                        navigationText: ["", ""],
                        autoPlay: true
                    });
                });
            </script>

        </head>

        <body>
            <?php
            error_reporting(0);
            if ($_SESSION['datosModificadosOk']) {
            ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Listo',
                        text: 'Tus datos personales han sido modificados'
                    })
                </script>
            <?php
                unset($_SESSION['datosModificadosOk']);
            }
            ?>

            <?php require('header.php'); ?>
            <!--Container-->

            <section id="container">
                <p class="fs-5">Bienvenido <?php echo $_SESSION['username']['datosUser']; ?></p>
                <p class="fs-6"><b>Nota:</b> Llenar los datos personales si no lo ha hecho. Click en el nombre de usuario ubicado en la parte superior derecha y luego click "Gestionar Usuario Actual."</p>
                <div class="container-fluid bar">

                    <div class="container-xxl">
                        <div class="row">
                            <div class="col-lg-12">

                                <div id="news-slider" class="owl-carousel">

                                    <div class="news-grid">
                                        <div class="news-grid-image"><img src="https://fce.uncuyo.edu.ar/cache/placa-web3_800_900.png" alt="">
                                        </div>
                                        <div class="news-grid-txt">
                                            <h2>Inscribirse</h2>
                                            <p>Inscribete para cursar un año, con sus respectivos espacios curriculares</p>
                                            <a href="index.php?accion=inscripcion">Ver...</a>
                                        </div>
                                    </div>

                                    <div class="news-grid">
                                        <div class="news-grid-image"><img src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_1080,h_675/https://www.gqdalya.com/wp-content/uploads/2018/12/calificaciones-blog.png" alt="">
                                        </div>
                                        <div class="news-grid-txt">
                                            <h2>Calificaciones</h2>
                                            <p>Ver los datos de las calificaciones de cada materia</p>
                                            <a href="index.php?accion=verCalificaciones">Ver...</a>
                                        </div>
                                    </div>

                                    <div class="news-grid">
                                        <div class="news-grid-image"><img src="https://sp-ao.shortpixel.ai/client/to_webp,q_glossy,ret_img,w_1080,h_675/https://www.gqdalya.com/wp-content/uploads/2018/12/calificaciones-blog.png" alt="">
                                        </div>
                                        <div class="news-grid-txt">
                                            <h2>Historial Académico</h2>
                                            <p>Ver los datos de las calificaciones cursadas hasta la actualidad</p>
                                            <a href="index.php?accion=verHistorialAcademico">Ver...</a>
                                        </div>
                                    </div>

                                    <!--<div class="news-grid">
                                        <div class="news-grid-image"><img src="https://www.frd.utn.edu.ar/wp-content/uploads/elementor/thumbs/student-social-internet-home-profession-p392dtdg10d8z1tfw83rfap7ltcuftrygetuqagr9c.jpg" alt="">
                                        </div>
                                        <div class="news-grid-txt">
                                            <h2>Solicitud de inscripción</h2>
                                            <p>Verifica los datos de la inscripción a un año enviado por el estudiante</p>
                                            <hr>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">Estudiantes 1er Año<a href="index.php?accion=listarInscripciones&anio=1&sede=<?php echo $_SESSION['sedeActual']; ?>">ir</a></li>
                                                <li class="list-group-item">Estudiantes 2do Año<a href="index.php?accion=listarInscripciones&anio=2&sede=<?php echo $_SESSION['sedeActual']; ?>">ir</a></li>
                                                <li class="list-group-item">Estudiantes 3er Año<a href="index.php?accion=listarInscripciones&anio=3&sede=<?php echo $_SESSION['sedeActual']; ?>">ir</a></li>
                                            </ul>
                                        </div>
                                    </div>-->

                                </div>
                            </div>
                        </div>
                    </div>
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
        <?php require('libreria.php'); ?>
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
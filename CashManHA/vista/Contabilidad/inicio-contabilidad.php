<?php
// IMPORTANDO MODELO DE CLIMA EN TIEMPO REAL -> API CLIMA OPENWEATHERMAP
require('../modelo/mAPIClima_Openweathermap.php');
// IMPORTANDO MODELO DE CONTEO NUMERO DE NOTIFICACIONES RECIBIDAS
require('../modelo/mConteoNotificacionesRecibidasUsuarios.php');
// IMPORTANDO MODELO DE CONTEO NUMERO DE MENSAJES RECIBIDOS
require('../modelo/mConteoMensajesBandejaEntrada_MensajeriaInterna.php');
// DATOS DE LOCALIZACION -> IDIOMA ESPAÑOL -> ZONA HORARIA Ecuador (UTC-5)
setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/Guayaquil');
// OBTENER HORA LOCAL
$hora = new DateTime("now");
// SI LOS USUARIOS INICIAN POR PRIMERA VEZ, MOSTRAR PAGINA DONDE DEBERAN REALIZAR EL CAMBIO OBLIGATORIO DE SU CONTRASEÑA GENERADA AUTOMATICAMENTE
if ($_SESSION['comprobar_iniciosesion_primeravez'] == "si") {
    header('location:../controlador/cGestionesCashman.php?cashmanhagestion=gestiones-nuevos-usuarios-registrados');
    // CASO CONTRARIO, MOSTRAR PORTAL DE USUARIOS -> SEGUN ROL DE USUARIO ASIGNADO
} else {
?>

    <!DOCTYPE html>
    <html lang="ES-SV">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>InversGlobal | Inicio</title>
        <!-- Favicon icon -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $UrlGlobal; ?>vista/images/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $UrlGlobal; ?>vista/images/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $UrlGlobal; ?>vista/images/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $UrlGlobal; ?>vista/images/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $UrlGlobal; ?>vista/images/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $UrlGlobal; ?>vista/images/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $UrlGlobal; ?>vista/images/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $UrlGlobal; ?>vista/images/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $UrlGlobal; ?>vista/images/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $UrlGlobal; ?>vista/images/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $UrlGlobal; ?>vista/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $UrlGlobal; ?>vista/images/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $UrlGlobal; ?>vista/images/favicon-16x16.png">
        <link rel="manifest" href="<?php echo $UrlGlobal; ?>vista/images/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo $UrlGlobal; ?>vista/images/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $UrlGlobal; ?>vista/vendor/chartist/css/chartist.min.css">
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?php echo $UrlGlobal; ?>vista/css/style.css" rel="stylesheet">
        <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link rel="stylesheet" href="/CashManHA/vista/icons/themify-icons/themify-icons.css">
        <link rel="stylesheet" href="/CashManHA/vista/icons/material-design-iconic-font/css/materialdesignicons.css">
        <link rel="stylesheet" href="/CashManHA/vista/vendor/bootstrap/scss/bootstrap.css">
        <link rel="stylesheet" href="/CashManHA/vista/vendor/bootstrap/dist/css/bootstrap.min.css">
    </head>
    <script src="https://kit.fontawesome.com/5ecb76baab.js" crossorigin="anonymous"></script>

    <body>

        <!--*******************
        Preloader start
    ********************-->
        <div id="preloader">
            <div class="sk-three-bounce">
                <div class="sk-child sk-bounce1"></div>
                <div class="sk-child sk-bounce2"></div>
                <div class="sk-child sk-bounce3"></div>
            </div>
        </div>
        <!--*******************
        Preloader end
    ********************-->

        <!--**********************************
        Main wrapper start
    ***********************************-->
        <div id="main-wrapper">

            <!--**********************************
            Nav header start
        ***********************************-->
            <div class="nav-header">
                <a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=iniciocontabilidad" class="brand-logo">
                    <img class="logo-abbr" src="<?php echo $UrlGlobal; ?>vista/images/logo.png" alt="">
                    <img class="logo-compact" src="<?php echo $UrlGlobal; ?>vista/images/logo-text.png" alt="">
                    <img class="brand-title" src="<?php echo $UrlGlobal; ?>vista/images/logo-text.png" alt="">
                </a>

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="line"></span><span class="line"></span><span class="line"></span>
                    </div>
                </div>
            </div>
            <!--**********************************
            Nav header end
        ***********************************-->

            <!--**********************************
            Header start
        ***********************************-->
            <div class="header">
                <div class="header-content">
                    <nav class="navbar navbar-expand">
                        <div class="collapse navbar-collapse justify-content-between">
                            <div class="header-left">
                                <div class="dashboard_bar">
                                    <h4 style="font-weight: 600;">Inicio</h4>
                                </div>
                            </div>

                            <ul class="navbar-nav header-right">
                                <li class="nav-item dropdown notification_dropdown">
                                    <a class="nav-link  ai-icon" href="#" role="button" data-toggle="dropdown">
                                        <svg fill="#6418C3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path d="M22 20H2v-2h1v-6.969C3 6.043 7.03 2 12 2s9 4.043 9 9.031V18h1v2zM5 18h14v-6.969C19 7.148 15.866 4 12 4s-7 3.148-7 7.031V18zm4.5 3h5a2.5 2.5 0 1 1-5 0z" />
                                        </svg>
                                        <span class="badge light text-white bg-primary"><?php echo NumeroNotificacionesRecibidasUsuarios($conectarsistema2, $_SESSION['id_usuario']); ?></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380">
                                            <ul class="timeline">
                                                <?php
                                                $ComprobarConsultaNotificaciones = 0;
                                                while ($filas = mysqli_fetch_array($consulta)) {
                                                    // SI EXISTEN REGISTROS, SI HAY CONSULTA QUE MOSTRAR
                                                    if ($ComprobarConsultaNotificaciones == 0)
                                                        $ComprobarConsultaNotificaciones = 1;
                                                    echo '
													<li>
													<div class="timeline-panel">
														<div class="media mr-2 media-';
                                                    if ($filas['clasificacionnotificacion'] == "nuevomensaje") {
                                                        echo 'info';
                                                    }
                                                    if ($filas['clasificacionnotificacion'] == "pagorecibido") {
                                                        echo 'danger';
                                                    }
                                                    echo '">
														';
                                                    if ($filas['clasificacionnotificacion'] == "nuevomensaje") {
                                                        echo '<svg fill="blue" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4.929 19.071A9.969 9.969 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10H2l2.929-2.929zM8 13a4 4 0 1 0 8 0H8z"/></svg>';
                                                    }
                                                    if ($filas['clasificacionnotificacion'] == "pagorecibido") {
                                                        echo '<svg fill="red" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-3.5-8v2H11v2h2v-2h1a2.5 2.5 0 1 0 0-5h-4a.5.5 0 1 1 0-1h5.5V8H13V6h-2v2h-1a2.5 2.5 0 0 0 0 5h4a.5.5 0 1 1 0 1H8.5z"/></svg>';
                                                    }
                                                    echo '</div>
														<div class="media-body">
															<h5 style="font-size: .8rem" class="mb-1">';
                                                    echo $filas['titulonotificacion'];
                                                    echo ': ';
                                                    echo $filas['descripcionnotificacion'];
                                                    echo '</h5>
															<small class="d-block"><time class="timeago" datetime="';
                                                    echo $filas['fechanotificacion'];
                                                    echo '"></time></small>
														</div>
													</div>
												</li>
											';
                                                }
                                                // SI NO EXISTEN REGISTROS, NO HAY CONSULTA QUE MOSTRAR
                                                if ($ComprobarConsultaNotificaciones == 0) {
                                                    echo '
												<div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
												<div class="card">
													<div class="card-body text-center ai-icon  text-primary">
														<img style="width: 80px" class="img-fluid" src="';
                                                    echo $UrlGlobal;
                                                    echo 'vista/images/coffee-cup.gif">
														<h4 class="my-2">No tienes ninguna notificaci&oacute;n</h4>
													</div>
												</div>
											</div>
												';
                                                }
                                                ?>

                                            </ul>
                                        </div>
                                        <a class="all-notification" href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=visualizar-mis-notificaciones-usuarios-atencion-clientes">Ver Mis Notificaciones <i class="ti-arrow-right"></i></a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown notification_dropdown">
                                    <a class="nav-link bell bell-link" href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=mensajeria-cashmanha-usuarios-atencion-al-cliente">
                                        <svg fill="#6418C3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path d="M6.455 19L2 22.5V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6.455zm-.692-2H20V5H4v13.385L5.763 17zM11 10h2v2h-2v-2zm-4 0h2v2H7v-2zm8 0h2v2h-2v-2z" />
                                        </svg>
                                        <span class="badge light text-white bg-primary"><?php echo NumeroMensajesRecibidosUsuarios($conectarsistema1, $_SESSION['id_usuario']); ?></span>
                                    </a>
                                </li>
                                <li class="nav-item dropdown notification_dropdown">
                                    <script type="text/javascript">
                                        function startTime() {
                                            Ahora = new Date();
                                            Hora = Ahora.getHours();
                                            Minutos = Ahora.getMinutes();
                                            Segundos = Ahora.getSeconds();
                                            Minutos = checkTime(Minutos);
                                            Segundos = checkTime(Segundos);
                                            document.getElementById("reloj").innerHTML = Hora + ":" + Minutos;
                                            t = setTimeout("startTime()", 500);
                                        }

                                        function checkTime(i) {
                                            if (i < 10) {
                                                i = "0" + i;
                                            }
                                            return i;
                                        }
                                        window.onload = function() {
                                            startTime();
                                        }
                                    </script>
                                    <div id="reloj"></div>
                                    <?php
                                    /*
										-> VALIDACION GENERICA SIN CONSULTA DE API CLIMATOLOGICA
											--> TOTALMENTE OPERATIVO <--
									*/
                                    // VALIDACION SEGUN HORA DETECTADA
                                    /*
										-> 04:00 HRS A 05:00 HRS -> A.M
									*/
                                    /*
									if($hora->format('G')>=4 && $hora->format('G')<5){
										echo '
										<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="'; echo $UrlGlobal; echo'vista/images/icon-weather/moonrise.svg" alt="icono-clima-noche"/></div>
										';
									/*
										-> 05:00 HRS A 07:00 HRS -> A.M
									*/
                                    /*
									}else if($hora->format('G')>=5 && $hora->format('G')<7){
										echo '
										<svg style="margin-left: .5rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M6.083 13a6 6 0 1 1 11.834 0h-2.043a4 4 0 1 0-7.748 0H6.083zM2 15h10v2H2v-2zm12 0h8v2h-8v-2zm2 4h4v2h-4v-2zM4 19h10v2H4v-2zm7-18h2v3h-2V1zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM19.07 3.515l1.414 1.414-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z" fill="rgba(230,126,34,1)"/></svg>
										';
									/*
										-> 07:00 HRS A 12:00 HRS -> A.M
									*/
                                    /*
									}else if($hora->format('G')>=7 && $hora->format('G')<12){
										echo '
										<svg style="margin-left: .5rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 18a6 6 0 1 1 0-12 6 6 0 0 1 0 12zm0-2a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM11 1h2v3h-2V1zm0 19h2v3h-2v-3zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM16.95 18.364l1.414-1.414 2.121 2.121-1.414 1.414-2.121-2.121zm2.121-14.85l1.414 1.415-2.121 2.121-1.414-1.414 2.121-2.121zM5.636 16.95l1.414 1.414-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3zM4 11v2H1v-2h3z" fill="rgba(241,196,14,1)"/></svg>
										';
									/*
										-> 12:00 HRS A 03:00 HRS -> P.M
									*/
                                    /*
									}else if($hora->format('G')>=12 && $hora->format('G')<16){
										echo '
										<svg style="margin-left: .5rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M9.984 5.06a6.5 6.5 0 1 1 11.286 6.436A5.5 5.5 0 0 1 17.5 21L9 20.999a8 8 0 1 1 .984-15.94zm2.071.544a8.026 8.026 0 0 1 4.403 4.495 5.529 5.529 0 0 1 3.12.307 4.5 4.5 0 0 0-7.522-4.802zM17.5 19a3.5 3.5 0 1 0-2.5-5.95V13a6 6 0 1 0-6 6h8.5z" fill="rgba(239,191,81,1)"/></svg>
										';
									/*
										-> 16:00 HRS A 06:00 HRS -> P.M
									*/
                                    /*
									}else if($hora->format('G')>=16 && $hora->format('G')<18){
										echo '
										<svg style="margin-left: .5rem" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M8 12h2v2H4v-2h2a6 6 0 1 1 6 6v-2a4 4 0 1 0-4-4zm-2 8h9v2H6v-2zm-4-4h8v2H2v-2zm9-15h2v3h-2V1zM3.515 4.929l1.414-1.414L7.05 5.636 5.636 7.05 3.515 4.93zM16.95 18.364l1.414-1.414 2.121 2.121-1.414 1.414-2.121-2.121zm2.121-14.85l1.414 1.415-2.121 2.121-1.414-1.414 2.121-2.121zM23 11v2h-3v-2h3z" fill="rgba(230,126,34,1)"/></svg>
										';
									/*
										-> 06:00 HRS A 11:00 HRS -> P.M
									*/
                                    /*
									}else if($hora->format('G')>=18 && $hora->format('G')<=23){
										echo '
										<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="'; echo $UrlGlobal; echo'vista/images/icon-weather/clear-night.svg" alt="icono-clima-noche"/></div>
										';
									/*
										-> 00:00 HRS A 03:00 HRS -> A.M
									*/
                                    /*
									}else if($hora->format('G')>=0 && $hora->format('G')<=3){
										echo '
										<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="'; echo $UrlGlobal; echo'vista/images/icon-weather/haze-night.svg" alt="icono-clima-noche"/></div>
										';
									}
									*/
                                    // RANGO DE HORAS DESDE 06:00 HASTA 18:00 [A.M -> P.M -> [[DIA]]]
                                    if ($hora->format('G') >= 6 && $hora->format('G') < 18) {
                                        if (strtolower(ucwords($data->weather[0]->description)) == "broken clouds") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/cloudy.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "clear sky") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/clear-day.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "few clouds") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-day.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "scattered clouds") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/haze-day.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-day-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-day-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-day-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-day-extreme.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light thunderstorm") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-day.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy thunderstorm") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-day-extreme.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged thunderstorm") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-day.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/partly-cloudy-day-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain and drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy shower rain and drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "shower drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "moderate rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "very heavy rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "extreme rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "overcast clouds") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/partly-cloudy-day.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "mist") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/mist.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "smoke") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-day-smoke.svg" alt="icono-clima-dia"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "haze") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-day-haze.svg" alt="icono-clima-dia"/></div>';
                                        }
                                        // RANGO DE HORAS DESDE 18:00 HASTA 5:00 [P.M -> A.M -> [[NOCHE]]]
                                    } else if ($hora->format('G') >= 0 && $hora->format('G') <= 5 || $hora->format('G') >= 18 && $hora->format('G') <= 23) {
                                        if (strtolower(ucwords($data->weather[0]->description)) == "broken clouds") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/cloudy.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "clear sky") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/clear-night.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "few clouds") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-night.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "scattered clouds") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/haze-night.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-night-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-night-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-night-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-night-extreme.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light thunderstorm") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-night.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy thunderstorm") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-night-extreme.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged thunderstorm") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-night.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/thunderstorms-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/partly-cloudy-night-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain and drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy shower rain and drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "shower drizzle") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "moderate rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "very heavy rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "extreme rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged shower rain") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "overcast clouds") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/partly-cloudy-night.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "mist") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/mist.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "smoke") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-night-smoke.svg" alt="icono-clima-noche"/></div>';
                                        } else if (strtolower(ucwords($data->weather[0]->description)) == "haze") {
                                            echo '<div style="margin-left: .5rem;width: 48px; height: 48px;" class="wi-icon"><img src="';
                                            echo $UrlGlobal;
                                            echo 'vista/images/icon-weather/extreme-night-haze.svg" alt="icono-clima-noche"/></div>';
                                        }
                                    }


                                    ?>
                                    <span style="font-size: .6rem" class="badge light text-light bg-primary"><?php echo number_format($data->main->temp, 1) ?>&deg;C</span>
                                </li>
                                <li class="nav-item dropdown header-profile">
                                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                        <div class="header-info">
                                            <span class="text-black">Hola, <strong><?php $Nombre = $_SESSION['nombre_usuario'];
                                                                                    $PrimerNombre = explode(' ', $Nombre, 2);
                                                                                    print_r($PrimerNombre[0]); ?></strong></span>
                                            <p class="fs-12 mb-0">
                                                <!-- VALIDACION SEGUN ROLES DE USUARIOS -->
                                                <?php if ($_SESSION['id_rol'] == 1) {
                                                    echo "Administradores";
                                                } else if ($_SESSION['id_rol'] == 2) {
                                                    echo "Presidencia";
                                                } else if ($_SESSION['id_rol'] == 3) {
                                                    echo "Gerencia";
                                                } else if ($_SESSION['id_rol'] == 4) {
                                                    echo "Atenci&oacute;n al Cliente";
                                                } else if ($_SESSION['id_rol'] == 5) {
                                                    echo "Clientes";
                                                } else if ($_SESSION['id_rol'] == 6) {
                                                    echo "Contabilidad";
                                                } ?>
                                            </p>
                                        </div>
                                        <img src="<?php echo $UrlGlobal; ?>vista/images/fotoperfil/<?php echo $_SESSION['foto_perfil']; ?>" width="20" alt="" />
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="<?php echo $UrlGlobal ?>controlador/cGestionesCashman.php?cashmanhagestion=perfilcontabilidad" class="dropdown-item ai-icon">
                                            <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <span class="ml-2">Mi Perfil </span>
                                        </a>
                                        <a href="./email-inbox.html" class="dropdown-item ai-icon">
                                            <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                            <span class="ml-2">Inbox </span>
                                        </a>
                                        <a href="<?php echo $UrlGlobal ?>controlador/cIniciosSesionesUsuarios.php?cashmanha=cerrarsesion" class="dropdown-item ai-icon">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12"></line>
                                            </svg>
                                            <span class="ml-2">Cerrar Sesi&oacute;n </span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

            <!--**********************************
            Sidebar start
        ***********************************-->
            <?php
            // IMPORTAR MENU USUARIOS ROL ATENCION AL CLIENTE
            require('../vista/MenuNavegacion/menu-contabilidad.php');
            ?>
            <!--**********************************
            Sidebar end
        ***********************************-->

            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-body">
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 style="font-size: .9rem;" class="card-title">
                                            <?php if ($hora->format('G') >= 7 && $hora->format('G') < 16) {
                                                echo '<img style="width: 30px;" class="img-fluid" src="';
                                                echo $UrlGlobal;
                                                echo 'vista/images/sun.gif">';
                                            } else  if ($hora->format('G') >= 16 && $hora->format('G') < 18) {
                                                echo '<img style="width: 30px;" class="img-fluid" src="';
                                                echo $UrlGlobal;
                                                echo 'vista/images/sunrise.gif">';
                                            } else  if ($hora->format('G') >= 18 && $hora->format('G') <= 23) {
                                                echo '<img style="width: 30px;" class="img-fluid" src="';
                                                echo $UrlGlobal;
                                                echo 'vista/images/night.gif">';
                                            } else  if ($hora->format('G') >= 0 && $hora->format('G') < 6) {
                                                echo '<img style="width: 30px;" class="img-fluid" src="';
                                                echo $UrlGlobal;
                                                echo 'vista/images/night.gif">';
                                            } else  if ($hora->format('G') >= 5 && $hora->format('G') < 7) {
                                                echo '<img style="width: 30px;" class="img-fluid" src="';
                                                echo $UrlGlobal;
                                                echo 'vista/images/sunrise.gif">';
                                            }    ?>
                                            <?php if ($hora->format('G') >= 0 && $hora->format('G') <= 4) {
                                                echo "Buenas Noches";
                                            } else if ($hora->format('G') >= 5 && $hora->format('G') < 12) {
                                                echo "Buenos D&iacute;as";
                                            } else if ($hora->format('G') >= 12 && $hora->format('G') < 18) {
                                                echo "Buenas Tardes";
                                            } else if ($hora->format('G') >= 18 && $hora->format('G') <= 23) {
                                                echo "Buenas Noches";
                                            } ?>, <strong><?php $Nombre = $_SESSION['nombre_usuario'];
                                                            $PrimerNombre = explode(' ', $Nombre, 2);
                                                            print_r($PrimerNombre[0]); ?></strong></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="bootstrap-media">
                                            <div class="media">
                                                <div class="left-panel panel">
                                                    <div class="dateweather">
                                                        <h4><?php
                                                            $dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                                                            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

                                                            echo $dias[date('w')] . ', ' . date('d') . ' de ' . $meses[date('n') - 1] . ' de ' . date('Y') . '.';
                                                            ?></h4>
                                                    </div>
                                                    <div class="city">
                                                        <h2 style="padding: 1rem 0 0 1rem; font-size: 1.4rem; font-weight: bold; text-transform: uppercase;">Ecuador, Ecuador</h2>
                                                    </div>
                                                    <div class="temp">
                                                        <?php
                                                        // RANGO DE HORAS DESDE 06:00 HASTA 18:00 [A.M -> P.M -> [[DIA]]]
                                                        if ($hora->format('G') >= 6 && $hora->format('G') < 18) {
                                                            if (strtolower(ucwords($data->weather[0]->description)) == "broken clouds") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/cloudy.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "clear sky") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/clear-day.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "few clouds") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-day.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "scattered clouds") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/haze-day.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-day-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-day-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-day-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-day-extreme.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light thunderstorm") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-day.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy thunderstorm") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-day-extreme.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged thunderstorm") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-day.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/partly-cloudy-day-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain and drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy shower rain and drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "shower drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "moderate rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "very heavy rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "extreme rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "overcast clouds") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/partly-cloudy-day.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "mist") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/mist.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "smoke") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-day-smoke.svg" alt="icono-clima-dia"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "haze") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-day-haze.svg" alt="icono-clima-dia"/>';
                                                            }
                                                            // RANGO DE HORAS DESDE 18:00 HASTA 5:00 [P.M -> A.M -> [[NOCHE]]]
                                                        } else if ($hora->format('G') >= 0 && $hora->format('G') <= 5 || $hora->format('G') >= 18 && $hora->format('G') <= 23) {
                                                            if (strtolower(ucwords($data->weather[0]->description)) == "broken clouds") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/cloudy.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "clear sky") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/clear-night.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "few clouds") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-night.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "scattered clouds") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/haze-night.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                                                echo '<img src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-night-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-night-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-night-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-night-extreme.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light thunderstorm") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-night.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy thunderstorm") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-night-extreme.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged thunderstorm") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-night.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with light drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "thunderstorm with heavy drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/thunderstorms-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity drizzle rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/partly-cloudy-night-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "drizzle rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity drizzle rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain and drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy shower rain and drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "shower drizzle") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "moderate rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "very heavy rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "extreme rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "light intensity shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/overcast-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "heavy intensity shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "ragged shower rain") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-rain.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "overcast clouds") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/partly-cloudy-night.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "mist") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/mist.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "smoke") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-night-smoke.svg" alt="icono-clima-noche"/>';
                                                            } else if (strtolower(ucwords($data->weather[0]->description)) == "haze") {
                                                                echo '<img style="width: 9rem" src="';
                                                                echo $UrlGlobal;
                                                                echo 'vista/images/icon-weather/extreme-night-haze.svg" alt="icono-clima-noche"/>';
                                                            }
                                                        }
                                                        ?><span style="font-size: 4.2rem;
													font-weight: 100; color: #000;"><?php echo number_format($data->main->temp, 1) ?>&deg;C</span>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <div class="right-panel panel">
                                                        <?php
                                                        if ($hora->format('G') >= 7 && $hora->format('G') < 17) {
                                                            echo '<img class="img-fluid" style="width: 100%; max-width: 620px; height: 300px" src="';
                                                            echo $UrlGlobal;
                                                            echo 'vista/images/Philippines-day.gif" alt="" >';
                                                        } else if ($hora->format('G') >= 17 && $hora->format('G') < 18 || $hora->format('G') >= 6 && $hora->format('G') < 8) {
                                                            echo '<img class="img-fluid" style="width: 100%; max-width: 620px; height: 300px" src="';
                                                            echo $UrlGlobal;
                                                            echo 'vista/images/Philippines-sunset.gif" alt="" >';
                                                        }
                                                        if ($hora->format('G') >= 18 && $hora->format('G') <= 23 || $hora->format('G') >= 0 && $hora->format('G') < 6) {
                                                            echo '<img class="img-fluid" style="width: 100%; max-width: 620px; height: 300px" src="';
                                                            echo $UrlGlobal;
                                                            echo 'vista/images/Philippines-night.gif" alt="" >';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; flex-wrap: wrap;" class="col-xl-12 col-xxl-12 col-lg-12">
                            <div class="col-xl-4 col-lg-6 col-sm-6">
                                <div class="widget-stat card">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Transacciones</h4>
                                        <h3><?php if (empty($Gestiones->getTotalTransaccionesProcesadas_AtencionClientes())) {
                                                echo "0";
                                            } else {
                                                echo $Gestiones->getTotalTransaccionesProcesadas_AtencionClientes();
                                            } ?></h3>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-animated bg-primary" style="width: 100%"></div>
                                        </div>
                                        <small>Total de Transacciones Procesadas</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-sm-6">
                                <div class="widget-stat card">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Solicitudes Clientes</h4>
                                        <h3><?php if (empty($Gestiones->getTotalSolicitudesCreditosProcesadas_AtencionClientes())) {
                                                echo "0";
                                            } else {
                                                echo $Gestiones->getTotalSolicitudesCreditosProcesadas_AtencionClientes();
                                            } ?></h3>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-animated bg-warning" style="width: 100%"></div>
                                        </div>
                                        <small>Solicitudes de Cr&eacute;ditos Clientes</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-sm-6">
                                <div class="widget-stat card">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Total Ingresos +</h4>
                                        <h3>$<?php echo number_format($Gestiones->getTotalIngresosTransaccionesCreditos_AtencionClientes(), 2); ?></h3>
                                        <div class="progress mb-2">
                                            <div class="progress-bar progress-animated bg-success" style="width: 100%"></div>
                                        </div>
                                        <small>Ingresos de Transacciones</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h4 class="fs-20 text-black">&Uacute;ltimas Transacciones Procesadas</h4>
                                    <p class="mb-0 fs-13">Detalle de las &uacute;ltimas 50 transacciones procesadas <strong>(cr&eacute;ditos)</strong></p>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive card-table">
                                        <table class="table bg-warning-hover text-center">
                                            <?php
                                            $ContadorTransacciones = 0;
                                            $ComprobarConsultaTransacciones = 0;
                                            while ($filas = mysqli_fetch_array($consulta2)) {
                                                if ($ComprobarConsultaTransacciones == 0)
                                                    $ComprobarConsultaTransacciones = 1;
                                                $ContadorTransacciones++;
                                                echo '<tr>
                                                <td style="font-size: .85rem">';
                                                echo '[' . $ContadorTransacciones;
                                                echo ']</td>
                                                    <td style="font-size: .85rem">';
                                                echo $filas['referencia'];
                                                echo '</td>
                                                    <td style="font-size: .85rem" class="text-left">';
                                                echo '<span class="mr-1">
                                                    <img style="width: 100%; max-width: 28px;" src="';
                                                echo $UrlGlobal;
                                                echo 'vista/images/shopping-basket.gif">
                                                </span>
                                                Pago Cuota Mensual [';
                                                echo $filas['nombres'];
                                                echo ' ';
                                                echo $filas['apellidos'];
                                                echo ']<br>Bol.->';
                                                echo $filas['idcuotas'];
                                                echo ' - Referencia: ';
                                                echo $filas['referencia'];
                                                echo '';
                                                echo '</td>
                                                    <td style="font-size: .85rem" class="text-left">$';
                                                echo number_format($filas['monto'], 2);
                                                echo '</td>
                                                    <td style="font-size: .85rem" class="text-left">';
                                                $FechaTransaccion = date_create($filas['fecha']);
                                                echo date_format($FechaTransaccion, "d-m-Y");
                                                echo '</td>
                                                <td style="font-size: .85rem" class="text-left">';
                                                $FechaTransaccion = date_create($filas['fecha']);
                                                echo date_format($FechaTransaccion, "H:i:s");
                                                echo '</td>
                                                </tr>';
                                            }
                                            // SI  EXISTEN REGISTROS, MOSTRAR THEAD DE TABLA PRINCIPAL
                                            if ($ComprobarConsultaTransacciones == 1) {
                                                echo ' <thead style="background: #000; color: #fff;">
                                            <tr>
                                                <th class="text-left">[No]</th>
                                                <th class="text-left"><i class="fa fa-database"></i> Referencia</th>
                                                <th class="text-center"><i class="fa fa-info-circle"></i> Descripci&oacute;n Transacciones</th>
                                                <th><i class="fa fa-money"></i> Monto</th>
                                                <th class="text-right"><i class="fa fa-calendar"></i> Fecha</th>
                                                <th class="text-right"><i class="fa fa-clock-o"></i> Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                            }
                                            // SI NO EXISTEN REGISTROS, NO HAY CONSULTA QUE MOSTRAR
                                            if ($ComprobarConsultaTransacciones == 0) {
                                                echo '
												<div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
												<div class="card">
													<div class="card-body text-center ai-icon  text-primary">
														<img style="width: 80px" class="img-fluid" src="';
                                                echo $UrlGlobal;
                                                echo 'vista/images/coffee-cup.gif">
														<h4 class="my-2">No tienes ninguna transacci&oacute;n procesada hasta ahora...</h4>
													</div>
												</div>
											</div>
												';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php
                                if ($ComprobarConsultaTransacciones == 1) {
                                    echo '
                                    <div class="card-footer border-0 pt-0 text-center">
                                    <a href="javascript:void(0);" class="btn-link"><i class="fa fa-caret-right ml-2 scale-2"></i> Detalle Simple de Transacciones Procesadas</a>
                                </div>
                                    ';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; <?php echo date('Y'); ?> InversGlobal &amp; Desarrollo de Sistemas InversGlobal</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


        </div>
        <!--**********************************
        Main wrapper end
    ***********************************-->

        <!--**********************************
        Scripts
    ***********************************-->
        <!-- Required vendors -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/global/global.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/chart.js/Chart.bundle.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/custom.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/deznav-init.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/owl-carousel/owl.carousel.js"></script>



        <!-- Chart piety plugin files -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/peity/jquery.peity.min.js"></script>


        <!-- Dashboard 1 -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/dashboard/dashboard-1.js"></script>
        <!-- Time ago -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/jquery.timeago.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/control_tiempo.js"></script>

    </body>

    </html>
<?php } ?>
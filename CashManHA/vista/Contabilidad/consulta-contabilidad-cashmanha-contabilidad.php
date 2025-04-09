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
        <title>InversGlobal | Contabilidad</title>
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
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?php echo $UrlGlobal; ?>vista/css/style.css" rel="stylesheet">
        <!-- Daterange picker -->
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- Clockpicker -->
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
        <!-- asColorpicker -->
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
        <!-- Material color picker -->
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
        <!-- Pick date -->
        <link rel="stylesheet" href="<?php echo $UrlGlobal; ?>vista/vendor/pickadate/themes/default.css">
        <link rel="stylesheet" href="<?php echo $UrlGlobal; ?>vista/vendor/pickadate/themes/default.date.css">
        <!-- Bootstrap Dropzone CSS -->
        <link href="<?php echo $UrlGlobal; ?>vista/dropzone/dist/dropzone.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Dropzone CSS -->
        <link href="<?php echo $UrlGlobal; ?>vista/dropify/dist/css/dropify.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
        <!-- Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- Datatable -->
        <link href="<?php echo $UrlGlobal; ?>vista/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
                <a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=inicioatencionclientes" class="brand-logo">
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
                                    <h4 style="font-weight: 600;">Contabilidad</h4>
                                </div>
                            </div>

                            <ul class="navbar-nav header-right">
                                <li class="nav-item dropdown notification_dropdown">
                                    <a class="nav-link  ai-icon" href="#" role="button" data-toggle="dropdown">
                                        <svg fill="#6418C3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path d="M22 20H2v-2h1v-6.969C3 6.043 7.03 2 12 2s9 4.043 9 9.031V18h1v2zM5 18h14v-6.969C19 7.148 15.866 4 12 4s-7 3.148-7 7.031V18zm4.5 3h5a2.5 2.5 0 1 1-5 0z" />
                                        </svg>
                                        <span class="badge light text-white bg-primary"><?php echo NumeroNotificacionesRecibidasUsuarios($conectarsistema4, $_SESSION['id_usuario']); ?></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380">
                                            <ul class="timeline">
                                                <?php
                                                $ComprobarConsultaNotificaciones = 0;
                                                while ($filas = mysqli_fetch_array($consulta1)) {
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
                                        <span class="badge light text-white bg-primary"><?php echo NumeroMensajesRecibidosUsuarios($conectarsistema5, $_SESSION['id_usuario']); ?></span>
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
                                        <a href="<?php echo $UrlGlobal ?>controlador/cGestionesCashman.php?cashmanhagestion=perfilatencionclientes" class="dropdown-item ai-icon">
                                            <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <span class="ml-2">Mi Perfil </span>
                                        </a>
                                        <a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=mensajeria-cashmanha-usuarios-atencion-al-cliente" class="dropdown-item ai-icon">
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
                <div class="container-fluid">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="--bs-breadcrumb-divider">
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Productos</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Contabilidad</a></li>
                            </ol>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="accordion-six" class="accordion accordion-with-icon accordion-danger-solid">
                                <div class="accordion__item">
                                    <div class="accordion__header collapsed" data-toggle="collapse" data-target="#with-icon_collapseOne">
                                        <span class="accordion__header--icon"></span>
                                        <span class="accordion__header--text">Tomar Nota:</span>
                                        <span class="accordion__header--indicator indicator_bordered"></span>
                                    </div>
                                    <div id="with-icon_collapseOne" class="accordion__body collapse" data-parent="#accordion-six">
                                        <div class="accordion__body--text">
                                            <i class="ti-direction"></i> En este apartado, usted podrá acceder a las siguientes funciones contables:
                                            <br>
                                            <br>[ <i class="mdi mdi-bank-transfer"></i> Transacciones ]
                                            <br>[ <i class="mdi mdi-book-open-page-variant"></i> Libro Diario ]
                                            <br>[ <i class="mdi mdi-book-plus"></i> Libro Mayor ]
                                            <br>[ <i class="mdi mdi-book-multiple"></i> Libro General ]
                                            <br>[ <i class="mdi mdi-scale-balance"></i> Balance ]
                                            <br>[ <i class="mdi mdi-chart-line"></i> Resultados ]
                                            <br>[ <i class="mdi mdi-file-document-outline"></i> Estado De Situación ]
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home8">
                                                <span>
                                                    <i class="mdi mdi-bank-transfer" title="Transacciones"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile8">
                                                <span>
                                                    <i class="mdi mdi-book-open-page-variant" title="Libro Diario"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile9">
                                                <span>
                                                    <i class="mdi mdi-book-plus" title="Libro Mayor"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile10">
                                                <span>
                                                    <i class="mdi mdi-book-multiple" title="Libro General"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile11">
                                                <span>
                                                    <i class="mdi mdi-scale-balance" title="Balance"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile12">
                                                <span>
                                                    <i class="mdi mdi-chart-line" title="Resultados"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile13">
                                                <span>
                                                    <i class="mdi mdi-file-document-outline" title="Estado de Situación"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane fade show active" id="home8" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="container">
                                                    <!-- Barra superior con botones e iconos -->
                                                    <div class="d-flex justify-content-center align-items-center mb-4">
                                                        <div>
                                                            <!-- Registrar entradas -->
                                                            <button class="btn btn-light" data-toggle="modal" data-target="#entradaModal" title="Registrar entradas">
                                                                <i class="mdi mdi-content-save mdi-24px" alt="Registrar entradas"></i>
                                                            </button>
                                                            <div class="modal fade" id="entradaModal" tabindex="-1" role="dialog" aria-labelledby="entradaModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="modalRegistroEntradasLabel">Entrada de Diario</h5>
                                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form>
                                                                                <div class="row mb-3">
                                                                                    <div class="col-md-3">
                                                                                        <label for="fecha" class="form-label">Fecha</label>
                                                                                        <input type="date" class="form-control" id="fecha" value="<?php echo date('Y-m-d'); ?>" readonly>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <label for="noCuenta" class="form-label">No. Cuenta</label>
                                                                                        <input type="text" class="form-control" id="noCuenta">
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <label for="debito" class="form-label">Débito</label>
                                                                                        <input type="number" class="form-control" id="debito">
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <label for="credito" class="form-label">Crédito</label>
                                                                                        <input type="number" class="form-control" id="credito">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="descripcion" class="form-label">Descripción</label>
                                                                                    <input type="text" class="form-control" id="descripcion" placeholder="Descripción">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="concepto" class="form-label">Concepto</label>
                                                                                    <input type="text" class="form-control" id="concepto">
                                                                                </div>
                                                                                <div class="d-flex justify-content-between mb-3">
                                                                                    <button type="button" class="btn btn-danger">Nueva</button>
                                                                                    <button type="button" class="btn btn-primary">Agregar</button>
                                                                                </div>
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-bordered">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Fecha</th>
                                                                                                <th>No. Cuenta</th>
                                                                                                <th>Descrip. Cuenta</th>
                                                                                                <th>Débito</th>
                                                                                                <th>Crédito</th>
                                                                                                <th>Descripción</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <!-- Aquí se agregarían dinámicamente las filas -->
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        <div class="totales mt-3">
                                                                            <div class="row">
                                                                                <div class="col-7 text-end">
                                                                                    <strong>Totales:</strong>
                                                                                </div>
                                                                                <div class="col-1 text-end">
                                                                                    <span id="totalDebitos">0.00</span>
                                                                                </div>
                                                                                <div class="col-1 text-end">
                                                                                    <span id="totalCreditos">0.00</span>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                            <button type="button" class="btn btn-primary">Guardar cambios</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Catálogo de libro diario -->
                                                            <button class="btn btn-light" data-toggle="modal" data-target="#catalogoLibroDiarioModal" title="Catálogo de libro diario">
                                                                <i class="mdi mdi-folder mdi-24px" alt="Catálogo de libro diario"></i>
                                                            </button>

                                                            <!-- Modal del Catálogo de Libro Diario -->
                                                            <div class="modal fade" id="catalogoLibroDiarioModal" tabindex="-1" role="dialog" aria-labelledby="catalogoLibroDiarioLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document"> <!-- modal-lg para hacerlo más grande -->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="catalogoLibroDiarioLabel">Manejar Cuentas Diarias</h5>
                                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Aquí es donde agregamos la tabla y el contenido -->
                                                                            <div class="container-fluid">
                                                                                <!-- Contenido del modal basado en la imagen -->
                                                                                <h6>Agregar/Editar Cuentas - casillas con ? son opcionales</h6>
                                                                                <div class="form-group">
                                                                                    <label for="numeroCuenta">Número:</label>
                                                                                    <input type="text" class="form-control" id="numeroCuenta">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="nombreCuenta">Nombre:</label>
                                                                                    <input type="text" class="form-control" id="nombreCuenta">
                                                                                </div>
                                                                                <!-- Desglose de Cuentas Table -->
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Tipo</th>
                                                                                            <th>Número</th>
                                                                                            <th>Activos</th>
                                                                                            <th>Nombre</th>
                                                                                            <th>Cuenta Control</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>

                                                                                        </tr>
                                                                                        <!-- Aquí puedes agregar más filas -->
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                            <button type="button" class="btn btn-success">Nueva</button>
                                                                            <button type="button" class="btn btn-primary">Guardar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Catálogo de Cuentas Mayores -->
                                                            <button class="btn btn-light" data-toggle="modal" data-target="#catalogoCuentasMayorModal" title="Catálogo de cuentas mayores">
                                                                <i class="mdi mdi-book-open mdi-24px" alt="Catálogo de cuentas mayores"></i>
                                                            </button>


                                                            <!-- Modal del Catálogo de Cuentas Mayores -->
                                                            <div class="modal fade" id="catalogoCuentasMayorModal" tabindex="-1" role="dialog" aria-labelledby="catalogoCuentasMayorLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document"> <!-- modal-lg para hacerlo más grande -->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="catalogoCuentasMayorModal">Manejar Cuentas Mayores</h5>
                                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Aquí es donde agregamos la tabla y el contenido -->
                                                                            <div class="container-fluid">
                                                                                <!-- Contenido del modal basado en la imagen -->
                                                                                <h6>Agregar/Editar Cuentas Mayores</h6>
                                                                                <div class="form-group">
                                                                                    <label for="numeroCuenta">Número:</label>
                                                                                    <input type="text" class="form-control" id="numeroCuenta">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="nombreCuenta">Nombre:</label>
                                                                                    <input type="text" class="form-control" id="nombreCuenta">
                                                                                </div>
                                                                                <!-- Desglose de Cuentas Table -->
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Cuenta Mayor</th>
                                                                                            <th>Número</th>
                                                                                            <th>Cuenta General</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>

                                                                                        </tr>
                                                                                        <!-- Aquí puedes agregar más filas -->
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                            <button type="button" class="btn btn-success">Nueva</button>
                                                                            <button type="button" class="btn btn-primary">Guardar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Catálogo de Cuentas Control/Generales -->
                                                            <button class="btn btn-light" data-toggle="modal" data-target="#catalogoCuentasGeneralesModal" title="Catálogo de Cuentas Control/Generales">
                                                                <i class="mdi mdi-cash mdi-24px" alt="Catálogo de Cuentas Control/Generales"></i>
                                                            </button>

                                                            <!-- Modal del Catálogo de Cuentas Generales -->
                                                            <div class="modal fade" id="catalogoCuentasGeneralesModal" tabindex="-1" role="dialog" aria-labelledby="catalogoCuentasGeneralesLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document"> <!-- modal-lg para hacerlo más grande -->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="catalogoCuentasGeneralesModal">Manejar Cuentas Generales</h5>
                                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <!-- Aquí es donde agregamos la tabla y el contenido -->
                                                                            <div class="container-fluid">
                                                                                <!-- Contenido del modal basado en la imagen -->
                                                                                <h6>Agregar/Editar Cuentas - casillas con ? son opcionales</h6>
                                                                                <div class="form-group">
                                                                                    <label for="numeroCuenta">Número:</label>
                                                                                    <input type="text" class="form-control" id="numeroCuenta">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="nombreCuenta">Nombre:</label>
                                                                                    <input type="text" class="form-control" id="nombreCuenta">
                                                                                </div>
                                                                                <!-- Desglose de Cuentas Table -->
                                                                                <table class="table table-bordered">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Nombre</th>
                                                                                            <th>Número</th>
                                                                                            <th>Tipo</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>

                                                                                        </tr>
                                                                                        <!-- Aquí puedes agregar más filas -->
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                            <button type="button" class="btn btn-success">Nueva</button>
                                                                            <button type="button" class="btn btn-primary">Guardar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Registrar Otros Ingresos -->
                                                            <button class="btn btn-light" title="Registrar Otros Ingresos">
                                                                <i class="mdi mdi-currency-usd mdi-24px" alt="Registrar Otros Ingresos"></i>
                                                            </button>


                                                            <!-- Programación de entradas automatizadas -->
                                                            <button class="btn btn-light" data-toggle="modal" data-target="#configuracionEntradasModal" title="Programación de entradas automatizadas">
                                                                <i class="mdi mdi-clock mdi-24px" alt="Programación de entradas automatizadas"></i>
                                                            </button>


                                                            <!-- Modal de Configuración de Cuentas para Entradas Automáticas -->
                                                            <div class="modal fade" id="configuracionEntradasModal" tabindex="-1" role="dialog" aria-labelledby="configuracionEntradasLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document"> <!-- modal-lg para hacerlo más ancho -->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="configuracionEntradasLabel">Configuración de Cuentas para Entradas Automáticas</h5>
                                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="container-fluid">
                                                                                <!-- Tab navigation -->
                                                                                <ul class="nav nav-tabs">
                                                                                    <li class="nav-item">
                                                                                        <a class="nav-link active" data-toggle="tab" href="#prestamosTab">Préstamos/Alquileres</a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <a class="nav-link" data-toggle="tab" href="#cuentasTab">Cuentas</a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <a class="nav-link" data-toggle="tab" href="#facturacionTab">Facturación</a>
                                                                                    </li>
                                                                                </ul>

                                                                                <!-- Tab content -->
                                                                                <div class="tab-content mt-3">
                                                                                    <div id="prestamosTab" class="tab-pane fade show active">
                                                                                        <div class="row">
                                                                                            <div class="col-12">
                                                                                                <h6>Cobros</h6>
                                                                                                <!-- Botón y campo de solo lectura -->
                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Cobro de Capital</button>
                                                                                                    <input type="text" class="form-control me-2" value="120.01.01" readonly style="flex: 0 0 250px;">
                                                                                                    <span>- Créditos Vigentes Consumo</span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Cobro de Interes</button>
                                                                                                    <input type="text" class="form-control me-2" value="400.01.01" readonly style="flex: 0 0 250px;">
                                                                                                    <span>- Intereses x Créditos</span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Cobro de Mora</button>
                                                                                                    <input type="text" class="form-control me-2" value="400.01.02" readonly style="flex: 0 0 250px;">
                                                                                                    <span>- Mora x Créditos</span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Cobro de Cargos</button>
                                                                                                    <input type="text" class="form-control me-2" value="400.02.01" readonly style="flex: 0 0 250px;">
                                                                                                    <span>- Ingreso x Cargos a Créditos</span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Cobro de Seguro</button>
                                                                                                    <input type="text" class="form-control me-2" value="400.02.02" readonly style="flex: 0 0 250px;">
                                                                                                    <span>- Ingresos x Seguro de Créditos</span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Cobro Impuesto</button>
                                                                                                    <input type="text" class="form-control me-2" value="210.02.02" readonly style="flex: 0 0 250px;">
                                                                                                    <span>- IVA/ITBIS Ventas</span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Cobro Alquiler</button>
                                                                                                    <input type="text" class="form-control me-2" value="141.01.04" readonly style="flex: 0 0 250px;">
                                                                                                    <span>- Depósito Alquileres</span>
                                                                                                </div>

                                                                                                <!-- Texto informativo al final del cuerpo del modal -->
                                                                                                <div class="modal-body">
                                                                                                    <p class="text-muted">
                                                                                                        Contracuenta del cobro se elige automáticamente desde la forma de pago que se utilizó.
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div id="cuentasTab" class="tab-pane fade">
                                                                                        <div class="row">
                                                                                            <div class="col-12">

                                                                                                <!-- Botón y campo de solo lectura -->
                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Tipo Socios</button>
                                                                                                    <input type="text" class="form-control me-2" value="120.01.01" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Cuentas de Socios </span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Tipo Ahorro</button>
                                                                                                    <input type="text" class="form-control me-2" value="400.01.01" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Cuentas de Ahorros </span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Tipo Corriente</button>
                                                                                                    <input type="text" class="form-control me-2" value="400.01.02" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Cuentas Corrientes </span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Certf. de Deposito</button>
                                                                                                    <input type="text" class="form-control me-2" value="400.02.01" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Certfificados de Depósitos</span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Tipo Aporte</button>
                                                                                                    <input type="text" class="form-control me-2" value="400.02.02" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Cuentas de Aporte </span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Ahorro Programado</button>
                                                                                                    <input type="text" class="form-control me-2" value="210.02.02" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Ahorros Programados </span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Tipo Cargos</button>
                                                                                                    <input type="text" class="form-control me-2" value="141.01.04" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Cuentas de Cargos </span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Plan Familiar</button>
                                                                                                    <input type="text" class="form-control me-2" value="141.01.04" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Cuentas Plan Familiar </span>
                                                                                                </div>
                                                                                                <br>
                                                                                                <h6>Aplicación de Interés</h6>
                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Cuenta de Comisiones</button>
                                                                                                    <input type="text" class="form-control me-2" value="610.01.02" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Comisiones </span>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="facturacionTab" class="tab-pane fade">
                                                                                        <div class="row">
                                                                                            <div class="col-12">


                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Facturado en Efectivo</button>
                                                                                                    <input type="text" class="form-control me-2" value="120.01.01" readonly style="flex: 0 0 250px;">
                                                                                                    <span> 1 </span>
                                                                                                </div>

                                                                                                <div class="d-flex align-items-center mb-2 w-100">
                                                                                                    <button class="btn btn-light me-2" style="width: 180px;">Contracuenta de</button>
                                                                                                    <input type="text" class="form-control me-2" value="400.01.01" readonly style="flex: 0 0 250px;">
                                                                                                    <span> Inventarios de Mercancia</span>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Controles de fecha -->
                                                    <div class="d-flex align-items-center">
                                                        <label for="fechaInicio" class="mr-2">De:</label>
                                                        <input type="date" id="fechaInicio" class="form-control mr-3" value="<?php echo date('Y-m-d'); ?>">
                                                        <label for="fechaFin" class="mr-2">Al:</label>
                                                        <input type="date" id="fechaFin" class="form-control mr-3" value="<?php echo date('Y-m-d'); ?>">
                                                        <button class="btn btn-light">
                                                            <i class="mdi mdi-magnify mdi-24px" alt="Buscar"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <br>

                                                <!-- Desglose de Transacciones -->
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Entrada</th>
                                                                <th>Cuenta</th>
                                                                <th>Cuenta Descripción</th>
                                                                <th>Débito</th>
                                                                <th>Crédito</th>
                                                                <th>Concepto</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- PHP para consultar y mostrar datos -->
                                                            <?php
                                                            while ($filas = mysqli_fetch_array($consulta1)) {
                                                                echo '<tr>';
                                                                echo '<td>' . $filas['fecha'] . '</td>';
                                                                echo '<td>' . $filas['entrada'] . '</td>';
                                                                echo '<td>' . $filas['cuenta'] . '</td>';
                                                                echo '<td>' . $filas['descripcioncuenta'] . '</td>';
                                                                echo '<td>' . $filas['debito'] . '</td>';
                                                                echo '<td>' . $filas['credito'] . '</td>';
                                                                echo '<td>' . $filas['concepto'] . '</td>';
                                                                echo '</tr>';
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="profile8" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-12 mb-2">
                                                    <!-- Checkbox y Date Picker similares a la imagen -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <input type="checkbox" id="ocultarCuentasBalanceCero">
                                                            <label for="ocultarCuentasBalanceCero">Ocultar Cuentas con balance en 0</label><br>
                                                            <input type="checkbox" id="cargarAutomaticamente">
                                                            <label for="cargarAutomaticamente">Cargar Automáticamente al Entrar</label>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label for="fechaFin" class="mr-2">al</label>
                                                            <input type="date" id="fechaFin" class="form-control mr-3" value="<?php echo date('Y-m-d'); ?>">
                                                            <button class="btn btn-light">
                                                                <i class="mdi mdi-magnify mdi-24px" alt="Buscar"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Título y Tabla Catálogo Diario -->
                                                    <h5>Catálogo Diario</h5>
                                                    <div class="table-responsive">
                                                        <table style="width: 100%;" id="catalogoDiario" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Cuenta</th>
                                                                    <th>Cuenta Nombre</th>
                                                                    <th>Débitos</th>
                                                                    <th>Créditos</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Aquí va el contenido dinámico del catálogo diario -->
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <br>

                                                    <!-- Título y Tabla Catálogo Directo -->
                                                    <h5>Catálogo Directo</h5>
                                                    <input type="checkbox" id="ocultarCuentasBalanceCero">
                                                    <label for="ocultarCuentasBalanceCero">Ocultar Cuentas con balance en 0</label><br>
                                                </div>
                                                <div class="table-responsive">
                                                    <table style="width: 100%;" id="catalogoDirecto" class="display min-w850">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Entrada No.</th>
                                                                <th>Cuenta</th>
                                                                <th>Cuenta Nombre</th>
                                                                <th>Concepto</th>
                                                                <th>Débitos</th>
                                                                <th>Créditos</th>
                                                                <th>Balance</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Aquí va el contenido dinámico del catálogo directo -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="profile9" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-12 mb-2">
                                                    <!-- Checkbox y Date Picker similares a la imagen -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <input type="checkbox" id="ocultarCuentasBalanceCero">
                                                            <label for="ocultarCuentasBalanceCero">Ocultar Cuentas con balance en 0</label><br>
                                                            <input type="checkbox" id="cargarAutomaticamente">
                                                            <label for="cargarAutomaticamente">Cargar Automáticamente al Entrar</label>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label for="fechaFin" class="mr-2">al</label>
                                                            <input type="date" id="fechaFin" class="form-control mr-3" value="<?php echo date('Y-m-d'); ?>">
                                                            <button class="btn btn-light">
                                                                <i class="mdi mdi-magnify mdi-24px" alt="Buscar"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Título y Tabla Catálogo Diario -->
                                                    <h5>Catálogo Mayor</h5>
                                                    <div class="table-responsive">
                                                        <table style="width: 100%;" id="catalogoMayor" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Cuenta</th>
                                                                    <th>Cuenta Nombre</th>
                                                                    <th>Débitos</th>
                                                                    <th>Créditos</th>
                                                                    <th>Balance</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Aquí va el contenido dinámico del catálogo diario -->
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <br>

                                                    <!-- Título y Tabla Catálogo Directo -->
                                                    <h5>Catálogo Directo</h5>
                                                    <input type="checkbox" id="ocultarCuentasBalanceCero">
                                                    <label for="ocultarCuentasBalanceCero">Ocultar Cuentas con balance en 0</label><br>
                                                </div>
                                                <div class="table-responsive">
                                                    <table style="width: 100%;" id="catalogoDirecto" class="display min-w850">
                                                        <thead>
                                                            <tr>
                                                                <th>Cuenta</th>
                                                                <th>Cuenta Nombre</th>
                                                                <th>Concepto</th>
                                                                <th>Débitos</th>
                                                                <th>Créditos</th>
                                                                <th>Balance</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Aquí va el contenido dinámico del catálogo directo -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="profile10" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-12 mb-2">
                                                    <!-- Checkbox y Date Picker similares a la imagen -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <input type="checkbox" id="ocultarCuentasBalanceCero">
                                                            <label for="ocultarCuentasBalanceCero">Ocultar Cuentas con balance en 0</label><br>
                                                            <input type="checkbox" id="cargarAutomaticamente">
                                                            <label for="cargarAutomaticamente">Cargar Automáticamente al Entrar</label>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label for="fechaFin" class="mr-2">al</label>
                                                            <input type="date" id="fechaFin" class="form-control mr-3" value="<?php echo date('Y-m-d'); ?>">
                                                            <button class="btn btn-light">
                                                                <i class="mdi mdi-magnify mdi-24px" alt="Buscar"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Título y Tabla Catálogo Diario -->
                                                    <h5>Catálogo General</h5>
                                                    <div class="table-responsive">
                                                        <table style="width: 100%;" id="catalogoGeneral" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Cuenta</th>
                                                                    <th>Cuenta Nombre</th>
                                                                    <th>Débitos</th>
                                                                    <th>Créditos</th>
                                                                    <th>Balance</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Aquí va el contenido dinámico del catálogo diario -->
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <br>

                                                    <!-- Título y Tabla Catálogo Directo -->
                                                    <h5>Catálogo Directo</h5>
                                                    <input type="checkbox" id="ocultarCuentasBalanceCero">
                                                    <label for="ocultarCuentasBalanceCero">Ocultar Cuentas con balance en 0</label><br>
                                                </div>
                                                <div class="table-responsive">
                                                    <table style="width: 100%;" id="catalogoDirecto" class="display min-w850">
                                                        <thead>
                                                            <tr>
                                                                <th>Cuenta</th>
                                                                <th>Cuenta Nombre</th>
                                                                <th>Concepto</th>
                                                                <th>Débitos</th>
                                                                <th>Créditos</th>
                                                                <th>Balance</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Aquí va el contenido dinámico del catálogo directo -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile11" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-12 mb-2">
                                                    <!-- Checkbox y Date Picker similares a la imagen -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <input type="checkbox" id="ocultarCuentasBalanceCero">
                                                            <label for="ocultarCuentasBalanceCero">Ocultar Cuentas con balance en 0</label><br>
                                                            <input type="checkbox" id="cargarAutomaticamente">
                                                            <label for="cargarAutomaticamente">Cargar Automáticamente al Entrar</label>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label for="fechaFin" class="mr-2">al</label>
                                                            <input type="date" id="fechaFin" class="form-control mr-3" value="<?php echo date('Y-m-d'); ?>">
                                                            <button class="btn btn-light">
                                                                <i class="mdi mdi-magnify mdi-24px" alt="Buscar"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Título y Tabla Catálogo Diario -->

                                                    <div class="table-responsive">
                                                        <table style="width: 100%;" id="catalogoGeneral" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tipo</th>
                                                                    <th>Número</th>
                                                                    <th>Nombre</th>
                                                                    <th>Cuenta Control</th>
                                                                    <th>Débito</th>
                                                                    <th>Crédito</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Aquí va el contenido dinámico del catálogo diario -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="profile12" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-12 mb-2">
                                                    <!-- Checkbox y Date Picker -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <input type="checkbox" id="ocultarCuentasBalanceCero">
                                                            <label for="ocultarCuentasBalanceCero">Ocultar Cuentas con balance en 0</label><br>
                                                            <input type="checkbox" id="cargarAutomaticamente">
                                                            <label for="cargarAutomaticamente">Cargar Automáticamente al Entrar</label>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label for="fechaFin" class="mr-2">al</label>
                                                            <input type="date" id="fechaFin" class="form-control mr-3" value="<?php echo date('Y-m-d'); ?>">
                                                            <button class="btn btn-light">
                                                                <i class="mdi mdi-magnify mdi-24px" alt="Buscar"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Título y Tabla Estado de Resultados -->

                                                    <h3>Estado de Resultado y/o Ganancia y Pérdidas</h3>

                                                    <div class="table-responsive">
                                                        <table style="width: 100%;" id="estadoResultados" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Descripción</th>
                                                                    <th>Resultado</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $estadoResultados = [
                                                                    ['INGRESOS FINANCIEROS', 0, true],
                                                                    ['Intereses y Comisiones por Créditos', 0],
                                                                    ['Intereses y ganancias por Inversión', 0],
                                                                    ['Ventas', 0],
                                                                    ['GASTOS FINANCIEROS', 0, true],
                                                                    ['Intereses por Captaciones', 0],
                                                                    ['Perdida por Inversion', 0],
                                                                    ['Intereses y Comision por Financiamiento', 0],
                                                                    ['Costos de Venta', 0],
                                                                    ['MARGEN FINANCIEROS BRUTO', 0, true],
                                                                    ['Provisión para Cartera de Créditos', 0],
                                                                    ['Provisión para Inversiones', 0],
                                                                    ['MARGEN FINANCIEROS NETO', 0, true],
                                                                    ['Ingresos (Gastos) por dif. de cambio', 0],
                                                                    ['Comisiones por servicios', 0],
                                                                    ['Comisiones por cambios', 0],
                                                                    ['Ingresos diversos', 0],
                                                                    ['OTROS INGRESOS OPERACIONALES', 0, true],
                                                                    ['Sueldos y compensaciones al personal', 0],
                                                                    ['Servicios de terceros', 0],
                                                                    ['Otras Provisiones', 0],
                                                                    ['Gastos de Infraestructura', 0],
                                                                    ['Gastos Impositivos', 0],
                                                                    ['Otros gastos', 0],
                                                                    ['GASTOS OPERACIONALES', 0, true],
                                                                    ['Comisiones por servicios', 0],
                                                                    ['OTROS GASTOS OPERACIONALES', 0, true],
                                                                    ['RESULTADO OPERACIONAL', 0, true],
                                                                    ['Otros Ingresos', 0],
                                                                    ['Otros Gastos', 0],
                                                                    ['OTROS INGRESOS (GASTOS)', 0, true],
                                                                    ['RESULTADOS ANTES DE IMPUESTOS', 0, true],
                                                                    ['Impuestos sobre la renta', 0],
                                                                    ['RESULTADO DEL EJERCICIO', 0, true],
                                                                ];

                                                                foreach ($estadoResultados as $item) {
                                                                    $descripcion = $item[0];
                                                                    $resultado = $item[1];
                                                                    $esTotal = isset($item[2]) && $item[2];

                                                                    echo "<tr" . ($esTotal ? " style='font-weight: bold; background-color: #f0f0f0;'" : "") . ">";
                                                                    echo "<td>" . $descripcion . "</td>";
                                                                    echo "<td style='text-align: right;'>$" . number_format($resultado, 2) . "</td>";
                                                                    echo "</tr>";
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="profile13" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-12 mb-2">
                                                    <!-- Checkbox y Date Picker similares a la imagen -->
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <input type="checkbox" id="ocultarCuentasBalanceCero">
                                                            <label for="ocultarCuentasBalanceCero">Ocultar Cuentas con balance en 0</label><br>
                                                            <input type="checkbox" id="cargarAutomaticamente">
                                                            <label for="cargarAutomaticamente">Cargar Automáticamente al Entrar</label>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label for="fechaFin" class="mr-2">al</label>
                                                            <input type="date" id="fechaFin" class="form-control mr-3" value="<?php echo date('Y-m-d'); ?>">
                                                            <button class="btn btn-light">
                                                                <i class="mdi mdi-magnify mdi-24px" alt="Buscar"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Título y Tabla Catálogo Diario -->

                                                    <div class="table-responsive">
                                                        <table style="width: 100%;" id="catalogoGeneral" class="display min-w850">
                                                            <thead>
                                                                <tr>
                                                                    <th>Clasificación</th>
                                                                    <th>N°</th>
                                                                    <th>Nombre</th>
                                                                    <th>Descripción</th>
                                                                    <th>Cuenta</th>
                                                                    <th>General</th>
                                                                    <th>Tipo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Aquí va el contenido dinámico del catálogo diario -->
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        <script src="<?php echo $UrlGlobal; ?>vista/js/custom.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/deznav-init.js"></script>
        <!-- Jquery Validation -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/jquery-validation/jquery.validate.min.js"></script>
        <!-- Form validate init -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/plugins-init/jquery.validate-init.js"></script>
        <!-- Daterangepicker -->
        <!-- momment js is must -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/moment/moment.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- clockpicker -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <!-- asColorPicker -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/jquery-asColor/jquery-asColor.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
        <!-- Material color picker -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
        <!-- pickdate -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/pickadate/picker.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/pickadate/picker.time.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/pickadate/picker.date.js"></script>



        <!-- Daterangepicker -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/plugins-init/bs-daterange-picker-init.js"></script>
        <!-- Clockpicker init -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/plugins-init/clock-picker-init.js"></script>
        <!-- asColorPicker init -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/plugins-init/jquery-asColorPicker.init.js"></script>
        <!-- Material color picker init -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/plugins-init/material-date-picker-init.js"></script>
        <!-- Pickdate -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/plugins-init/pickadate-init.js"></script>
        <!-- Mask -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/mask.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/mascaras-datos.js"></script>
        <!-- Dropzone JavaScript -->
        <script src="<?php echo $UrlGlobal; ?>vista/dropzone/dist/dropzone.js"></script>
        <!-- Dropify JavaScript -->
        <script src="<?php echo $UrlGlobal; ?>vista/dropify/dist/js/dropify.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/dropzone-configuration.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
        <!-- Datatable -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/plugins-init/datatables.init.js"></script>
        <!-- Time ago -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/jquery.timeago.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/control_tiempo.js"></script>
        <!-- Toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- All init script -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/plugins-init/toastr-init.js"></script>
    </body>

    </html>
<?php } ?>
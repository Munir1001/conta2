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
        <title>InversGlobal | Consulta General de Productos</title>
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
                                    <h4 style="font-weight: 600;">Consultar Productos</h4>
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
                                                while ($filas = mysqli_fetch_array($consulta3)) {
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
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Consultar Productos</a></li>
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
                                            <i class="ti-direction"></i> Usted podr&aacute; consultar, gestionar, desactivar y expirar productos en este apartado, en estos momentos se explica brevemente los diferentes significados de los &iacute;conos [izquierda - derecha]:
                                            <br>[ <i class="mdi mdi-file-plus"></i> Consultar y Gestionar Productos Activos ]
                                            <br>[ <i class="mdi mdi-file-lock"></i> Consultar y Gestionar Productos Inactivos ]
                                            <br>[ <i class="mdi mdi-file-excel"></i> Consultar y Gestionar Productos Expirados ]
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home8">
                                                <span>
                                                    <i class="mdi mdi mdi-file-plus"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile8">
                                                <span>
                                                    <i class="mdi mdi mdi-file-lock"></i>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile9">
                                                <span>
                                                    <i class="mdi mdi mdi-file-excel"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border">
                                        <!-- Pestaña Productos Activos -->
                                        <div class="tab-pane fade show active" id="home8" role="tabpanel">
                                            <div class="pt-4">
                                                <h4>Consultar, Gestionar Productos InversGlobal</h4>
                                                <p>Estimado(a) <?php $Nombre = $_SESSION['nombre_usuario'];
                                                                $PrimerNombre = explode(' ', $Nombre, 2);
                                                                print_r($PrimerNombre[0]); ?>, en este apartado encontrar&aacute;s el listado completo de todos los productos registrados. <strong>Por favor toma en cuenta que aqu&iacute; solamente se muestran todos los productos activos y funcionales &uacute;nicamente.</strong></p>

                                                <!-- Filtros y controles -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <input type="text" id="filtroProductosActivos" class="form-control" placeholder="Buscar por código, nombre o descripción">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="resultadosPorPaginaActivos" class="form-control">
                                                            <option value="10">Mostrar 10</option>
                                                            <option value="25">Mostrar 25</option>
                                                            <option value="50">Mostrar 50</option>
                                                            <option value="100">Mostrar 100</option>
                                                            <option value="9999">Mostrar todos</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Contenedor de tarjetas -->
                                                <div class="row" id="contenedorProductosActivos">
                                                    <?php while ($filas = mysqli_fetch_array($consulta)) { ?>
                                                        <div class="col-md-4 mb-4 producto-item"
                                                            data-codigo="<?= strtolower($filas['codigo']) ?>"
                                                            data-nombre="<?= strtolower($filas['nombreproducto']) ?>"
                                                            data-descripcion="<?= strtolower($filas['descripcionproducto']) ?>">
                                                            <div class="card h-100 shadow border-0">
                                                                <div class="text-right">
                                                                    <div class="dropdown">
                                                                        <button class="btn border-0 dropdown-toggle" type="button" data-toggle="dropdown">
                                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a target="_blank" class="dropdown-item" href="<?= $UrlGlobal ?>controlador/cGestionesCashman.php?cashmanhagestion=consulta-productos-especifica-cashmanha-contabilidad&idproducto=<?= $filas['idproducto'] ?>">
                                                                                <i class="ti-eye mr-2"></i>Ver Producto
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body text-center">
                                                                    <img class="rounded-circle mb-2" width="70" src="<?= $UrlGlobal ?>vista/images/shopping.gif" alt="Producto">
                                                                    <div class="mb-2"> <!-- Añade mb-2 aquí -->
                                                                        <span class="badge badge-pill badge-success px-3 py-2">Activo</span>
                                                                    </div>

                                                                    <div class="text-justify"> <!-- Elimina el card-body separado -->
                                                                        <h5 class="text-dark font-weight-bold mb-2"><?= $filas['nombreproducto'] ?></h5>
                                                                        <p class="text-muted mb-1"><strong>Código:</strong> <?= $filas['codigo'] ?></p>
                                                                        <p class="text-secondary small"><strong>Descripción:</strong> <?= $filas['descripcionproducto'] ?></p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                                <!-- Paginación y contador -->
                                                <div class="row mt-3 justify-content-center text-center">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <div id="infoPaginacionActivos" class="text-muted">
                                                            Mostrando <span id="mostrandoDesdeActivos">1</span> a <span id="mostrandoHastaActivos">10</span> de <span id="totalRegistrosActivos"><?= mysqli_num_rows($consulta) ?></span> registros
                                                        </div>
                                                        <div id="paginacionActivos" class="mt-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pestaña Productos Inactivos -->
                                        <div class="tab-pane fade" id="profile8" role="tabpanel">
                                            <div class="pt-4">
                                                <h4>Consultar, Gestionar Productos Inactivos InversGlobal</h4>
                                                <p>Estimado(a) <?php $Nombre = $_SESSION['nombre_usuario'];
                                                                $PrimerNombre = explode(' ', $Nombre, 2);
                                                                print_r($PrimerNombre[0]); ?>, en este apartado encontrar&aacute;s el listado completo de todos los productos registrados que se encuentran inactivos.</p>

                                                <!-- Filtros y controles -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <input type="text" id="filtroProductosInactivos" class="form-control" placeholder="Buscar por código, nombre o descripción">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="resultadosPorPaginaInactivos" class="form-control">
                                                            <option value="10">Mostrar 10</option>
                                                            <option value="25">Mostrar 25</option>
                                                            <option value="50">Mostrar 50</option>
                                                            <option value="100">Mostrar 100</option>
                                                            <option value="9999">Mostrar todos</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Contenedor de tarjetas -->
                                                <div class="row" id="contenedorProductosInactivos">
                                                    <?php while ($filas = mysqli_fetch_array($consulta1)) { ?>
                                                        <div class="col-md-4 mb-4 producto-item"
                                                            data-codigo="<?= strtolower($filas['codigo']) ?>"
                                                            data-nombre="<?= strtolower($filas['nombreproducto']) ?>"
                                                            data-descripcion="<?= strtolower($filas['descripcionproducto']) ?>">
                                                            <div class="card h-100 shadow border-0">
                                                                <div class="text-right">
                                                                    <div class="dropdown">
                                                                        <button class="btn border-0 dropdown-toggle" type="button" data-toggle="dropdown">
                                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a target="_blank" class="dropdown-item" href="<?= $UrlGlobal ?>controlador/cGestionesCashman.php?cashmanhagestion=consulta-productos-especifica-cashmanha-contabilidad&idproducto=<?= $filas['idproducto'] ?>">
                                                                                <i class="ti-eye mr-2"></i>Ver Producto
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body text-center">
                                                                    <img class="rounded-circle mb-2" width="70" src="<?= $UrlGlobal ?>vista/images/shopping.gif" alt="Producto">
                                                                    <div class="mb-2"> <!-- Añade mb-2 aquí -->
                                                                        <span class="badge badge-pill badge-warning px-3 py-2">Inactivo</span>
                                                                    </div>

                                                                    <div class="text-justify"> <!-- Elimina el card-body separado -->
                                                                        <h5 class="text-dark font-weight-bold mb-2"><?= $filas['nombreproducto'] ?></h5>
                                                                        <p class="text-muted mb-1"><strong>Código:</strong> <?= $filas['codigo'] ?></p>
                                                                        <p class="text-secondary small"><strong>Descripción:</strong> <?= $filas['descripcionproducto'] ?></p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                                <!-- Paginación y contador -->
                                                <div class="row mt-3 justify-content-center text-center">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <div id="infoPaginacionInactivos" class="text-muted">
                                                            Mostrando <span id="mostrandoDesdeInactivos">1</span> a <span id="mostrandoHastaInactivos">10</span> de <span id="totalRegistrosInactivos"><?= mysqli_num_rows($consulta1) ?></span> registros
                                                        </div>
                                                        <div id="paginacionInactivos" class="mt-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pestaña Productos Expirados -->
                                        <div class="tab-pane fade" id="profile9" role="tabpanel">
                                            <div class="pt-4">
                                                <h4>Consultar, Gestionar Productos Expirados InversGlobal</h4>
                                                <p>Estimado(a) <?php $Nombre = $_SESSION['nombre_usuario'];
                                                                $PrimerNombre = explode(' ', $Nombre, 2);
                                                                print_r($PrimerNombre[0]); ?>, en este apartado encontrar&aacute;s el listado completo de todos los productos registrados que se han expirado en su oferta a los clientes.</p>

                                                <!-- Filtros y controles -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <input type="text" id="filtroProductosExpirados" class="form-control" placeholder="Buscar por código, nombre o descripción">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select id="resultadosPorPaginaExpirados" class="form-control">
                                                            <option value="10">Mostrar 10</option>
                                                            <option value="25">Mostrar 25</option>
                                                            <option value="50">Mostrar 50</option>
                                                            <option value="100">Mostrar 100</option>
                                                            <option value="9999">Mostrar todos</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Contenedor de tarjetas -->
                                                <div class="row" id="contenedorProductosExpirados">
                                                    <?php while ($filas = mysqli_fetch_array($consulta2)) { ?>
                                                        <div class="col-md-4 mb-4 producto-item"
                                                            data-codigo="<?= strtolower($filas['codigo']) ?>"
                                                            data-nombre="<?= strtolower($filas['nombreproducto']) ?>"
                                                            data-descripcion="<?= strtolower($filas['descripcionproducto']) ?>">
                                                            <div class="card h-100 shadow border-0">
                                                                <div class="text-right">
                                                                    <div class="dropdown">
                                                                        <button class="btn border-0 dropdown-toggle" type="button" data-toggle="dropdown">
                                                                            <i class="ti-settings"></i> Opciones
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a target="_blank" class="dropdown-item" href="<?= $UrlGlobal ?>controlador/cGestionesCashman.php?cashmanhagestion=consulta-productos-especifica-cashmanha-contabilidad&idproducto=<?= $filas['idproducto'] ?>">
                                                                                <i class="ti-eye mr-2"></i>Ver Producto
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body text-center">
                                                                    <img class="rounded-circle mb-2" width="70" src="<?= $UrlGlobal ?>vista/images/shopping.gif" alt="Producto">
                                                                    <div class="mb-2"> <!-- Añade mb-2 aquí -->
                                                                        <span class="badge badge-pill badge-danger px-3 py-2">Expirado</span>
                                                                    </div>

                                                                    <div class="text-justify"> <!-- Elimina el card-body separado -->
                                                                        <h5 class="text-dark font-weight-bold mb-2"><?= $filas['nombreproducto'] ?></h5>
                                                                        <p class="text-muted mb-1"><strong>Código:</strong> <?= $filas['codigo'] ?></p>
                                                                        <p class="text-secondary small"><strong>Descripción:</strong> <?= $filas['descripcionproducto'] ?></p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                                <!-- Paginación y contador -->
                                                <div class="row mt-3 justify-content-center text-center">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <div id="infoPaginacionExpirados" class="text-muted">
                                                            Mostrando <span id="mostrandoDesdeExpirados">1</span> a <span id="mostrandoHastaExpirados">10</span> de <span id="totalRegistrosExpirados"><?= mysqli_num_rows($consulta2) ?></span> registros
                                                        </div>
                                                        <div id="paginacionExpirados" class="mt-3"></div>
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

        <script>
            // Configuración para cada pestaña
            const configProductos = {
                activos: {
                    filtro: 'filtroProductosActivos',
                    paginacion: 'resultadosPorPaginaActivos',
                    contenedor: 'contenedorProductosActivos',
                    info: 'infoPaginacionActivos',
                    paginas: 'paginacionActivos'
                },
                inactivos: {
                    filtro: 'filtroProductosInactivos',
                    paginacion: 'resultadosPorPaginaInactivos',
                    contenedor: 'contenedorProductosInactivos',
                    info: 'infoPaginacionInactivos',
                    paginas: 'paginacionInactivos'
                },
                expirados: {
                    filtro: 'filtroProductosExpirados',
                    paginacion: 'resultadosPorPaginaExpirados',
                    contenedor: 'contenedorProductosExpirados',
                    info: 'infoPaginacionExpirados',
                    paginas: 'paginacionExpirados'
                }
            };

            // Inicializar cada pestaña al cargar la página
            document.addEventListener('DOMContentLoaded', function() {
                for (const tipo in configProductos) {
                    const config = configProductos[tipo];

                    // Configurar eventos de búsqueda en tiempo real
                    document.getElementById(config.filtro).addEventListener('input', () => filtrarProductos(tipo));
                    document.getElementById(config.paginacion).addEventListener('change', () => filtrarProductos(tipo));

                    // Filtrar inicialmente
                    filtrarProductos(tipo);
                }
            });

            // Función para filtrar y paginar productos
            function filtrarProductos(tipo) {
                const config = configProductos[tipo];
                const filtro = document.getElementById(config.filtro).value.toLowerCase();
                const resultadosPorPagina = parseInt(document.getElementById(config.paginacion).value);
                const productos = document.getElementById(config.contenedor).getElementsByClassName('producto-item');

                // Contar productos visibles
                let totalVisibles = 0;
                for (let producto of productos) {
                    const codigo = producto.getAttribute('data-codigo');
                    const nombre = producto.getAttribute('data-nombre');
                    const descripcion = producto.getAttribute('data-descripcion');

                    if (codigo.includes(filtro) || nombre.includes(filtro) || descripcion.includes(filtro)) {
                        totalVisibles++;
                    }
                }

                // Calcular páginas
                const totalPaginas = Math.ceil(totalVisibles / resultadosPorPagina);
                let paginaActual = 1;

                // Mostrar productos según paginación
                let contador = 0;
                for (let producto of productos) {
                    const codigo = producto.getAttribute('data-codigo');
                    const nombre = producto.getAttribute('data-nombre');
                    const descripcion = producto.getAttribute('data-descripcion');

                    if (codigo.includes(filtro) || nombre.includes(filtro) || descripcion.includes(filtro)) {
                        if (contador >= (paginaActual - 1) * resultadosPorPagina &&
                            contador < paginaActual * resultadosPorPagina) {
                            producto.style.display = 'block';
                        } else {
                            producto.style.display = 'none';
                        }
                        contador++;
                    } else {
                        producto.style.display = 'none';
                    }
                }

                // Actualizar información de paginación
                const desde = totalVisibles === 0 ? 0 : (paginaActual - 1) * resultadosPorPagina + 1;
                const hasta = Math.min(paginaActual * resultadosPorPagina, totalVisibles);
                document.getElementById(config.info).innerHTML =
                    `Mostrando <span>${desde}</span> a <span>${hasta}</span> de <span>${totalVisibles}</span> registros`;

                // Generar botones de paginación
                generarPaginacion(config.paginas, paginaActual, totalPaginas, tipo);
            }

            // Función para generar los botones de paginación
            function generarPaginacion(elementoId, paginaActual, totalPaginas, tipo) {
                const paginacion = document.getElementById(elementoId).querySelector('ul');
                paginacion.innerHTML = '';

                if (totalPaginas <= 1) return;

                // Botón Anterior
                const liAnterior = document.createElement('li');
                liAnterior.className = `page-item ${paginaActual === 1 ? 'disabled' : ''}`;
                liAnterior.innerHTML = `<a class="page-link" href="#" onclick="cambiarPagina('${tipo}', ${paginaActual - 1}); return false;">&laquo;</a>`;
                paginacion.appendChild(liAnterior);

                // Botones de página
                for (let i = 1; i <= totalPaginas; i++) {
                    const li = document.createElement('li');
                    li.className = `page-item ${paginaActual === i ? 'active' : ''}`;
                    li.innerHTML = `<a class="page-link" href="#" onclick="cambiarPagina('${tipo}', ${i}); return false;">${i}</a>`;
                    paginacion.appendChild(li);
                }

                // Botón Siguiente
                const liSiguiente = document.createElement('li');
                liSiguiente.className = `page-item ${paginaActual === totalPaginas ? 'disabled' : ''}`;
                liSiguiente.innerHTML = `<a class="page-link" href="#" onclick="cambiarPagina('${tipo}', ${paginaActual + 1}); return false;">&raquo;</a>`;
                paginacion.appendChild(liSiguiente);
            }

            // Función para cambiar de página
            function cambiarPagina(tipo, nuevaPagina) {
                const config = configProductos[tipo];
                const resultadosPorPagina = parseInt(document.getElementById(config.paginacion).value);
                const productos = document.getElementById(config.contenedor).getElementsByClassName('producto-item');
                const filtro = document.getElementById(config.filtro).value.toLowerCase();

                // Contar productos visibles
                let totalVisibles = 0;
                for (let producto of productos) {
                    const codigo = producto.getAttribute('data-codigo');
                    const nombre = producto.getAttribute('data-nombre');
                    const descripcion = producto.getAttribute('data-descripcion');

                    if (codigo.includes(filtro) || nombre.includes(filtro) || descripcion.includes(filtro)) {
                        totalVisibles++;
                    }
                }

                // Calcular total de páginas
                const totalPaginas = Math.ceil(totalVisibles / resultadosPorPagina);
                nuevaPagina = Math.max(1, Math.min(nuevaPagina, totalPaginas));

                // Mostrar productos según la nueva página
                let contador = 0;
                for (let producto of productos) {
                    const codigo = producto.getAttribute('data-codigo');
                    const nombre = producto.getAttribute('data-nombre');
                    const descripcion = producto.getAttribute('data-descripcion');

                    if (codigo.includes(filtro) || nombre.includes(filtro) || descripcion.includes(filtro)) {
                        if (contador >= (nuevaPagina - 1) * resultadosPorPagina &&
                            contador < nuevaPagina * resultadosPorPagina) {
                            producto.style.display = 'block';
                        } else {
                            producto.style.display = 'none';
                        }
                        contador++;
                    }
                }

                // Actualizar información de paginación
                const desde = totalVisibles === 0 ? 0 : (nuevaPagina - 1) * resultadosPorPagina + 1;
                const hasta = Math.min(nuevaPagina * resultadosPorPagina, totalVisibles);
                document.getElementById(config.info).innerHTML =
                    `Mostrando <span>${desde}</span> a <span>${hasta}</span> de <span>${totalVisibles}</span> registros`;

                // Regenerar botones de paginación
                generarPaginacion(config.paginas, nuevaPagina, totalPaginas, tipo);

                // Scroll suave al inicio de los resultados
                const contenedor = document.getElementById(config.contenedor);
                if (contenedor) {
                    window.scrollTo({
                        top: contenedor.offsetTop - 20,
                        behavior: 'smooth'
                    });
                }
            }
        </script>
    </body>

    </html>
<?php } ?>
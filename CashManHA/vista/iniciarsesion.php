<?php
// SI USUARIO NO TIENE SESION ACTIVA, MOSTRAR FORMULARIO DE INICIO DE SESION
if (empty($_SESSION['id_usuario'])) {
?>
    <!DOCTYPE html>
    <html lang="ES-SV" class="h-100">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>InversGlobal | Portal Financiero</title>
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
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Custom CSS -->
        <style>
            body {
                background-color: #f8f9fa;
                background-repeat: no-repeat;
                background-position: left bottom;
                background-size: 100%;
            }

            .login-container {
                background-color: transparent;
                border-radius: 10px;
            }

            .logo-login {
                max-height: 80px;
                margin-bottom: 20px;
            }

            .btn-primary {
                background-color: #b31324;
                border-color: #b31324;
            }

            .btn-primary:hover {
                background-color: #c44454;
                border-color: #c44454;
            }

            .form-control:focus {
                border-color: #cd6a77;
                box-shadow: 0 0 0 0.25rem rgba(205, 106, 119, 0.25);
            }

            .password-toggle {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #6c757d;
                cursor: pointer;
            }

            .password-container {
                position: relative;
            }
        </style>
        <!-- Alerts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>

    <body>
        <section class="vh-100 d-flex align-items-center">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <!-- Columna para la imagen -->
                    <div class="col-lg-6 d-none d-lg-block">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                            class="img-fluid" alt="Imagen decorativa">
                    </div>

                    <!-- Columna para el formulario de inicio de sesión -->
                    <div class="col-lg-6">
                        <div class="login-container p-5">
                            <div class="text-center mb-4">
                                <img src="https://raw.githubusercontent.com/Munir1001/images/refs/heads/main/logo-sin-fondo.png" class="logo-login" alt="InversGlobal Logo">
                                <h4 class="mb-3">InversGlobal | Iniciar Sesión</h4>
                            </div>
                            <form id="accesos-usuarios" method="POST" action="<?php echo $UrlGlobal; ?>controlador/cIniciosSesionesUsuarios.php?cashmanha=validar-sesiones" autocomplete="off">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="val-username1">Usuario</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" id="val-username1" name="val-username" class="form-control form-control-lg" placeholder="Ingrese su usuario" value="<?php if (!empty($_COOKIE['val-username'])) {
                                                                                                                                                                                    echo $_COOKIE['val-username'];
                                                                                                                                                                                } ?>">
                                    </div>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="val-password1">Contraseña</label>
                                    <div class="password-container">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" id="val-password1" name="val-password" class="form-control form-control-lg" placeholder="Ingrese su contraseña">
                                        </div>
                                        <button type="button" class="password-toggle" onclick="mostrarPassword()">
                                            <i class="fas fa-eye-slash show-password"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <?php if (empty($_COOKIE['val-username'])) { ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="recordar" id="basic_checkbox_1" checked>
                                            <label class="form-check-label" for="basic_checkbox_1">Recordar usuario</label>
                                        </div>
                                    <?php } ?>
                                    <a href="<?php echo $UrlGlobal; ?>controlador/cIniciosSesionesUsuarios.php?cashmanha=reestablecer-contrasena" style="color: #b31324;">¿Olvidó su contraseña?</a>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg btn-block w-100">Iniciar Sesión</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Scripts -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/global/global.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/custom.min.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/deznav-init.js"></script>
        <!-- Jquery Validation -->
        <script src="<?php echo $UrlGlobal; ?>vista/vendor/jquery-validation/jquery.validate.min.js"></script>
        <!-- Form validate init -->
        <script src="<?php echo $UrlGlobal; ?>vista/js/plugins-init/jquery.validate-init.js"></script>
        <script src="<?php echo $UrlGlobal; ?>vista/js/comprobarcontrasenia.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            function mostrarPassword() {
                var passwordInput = document.getElementById('val-password1');
                var toggleIcon = document.querySelector('.show-password');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                }
            }
        </script>
    </body>

    </html>
<?php
    // SI USUARIO POSEE SESION ACTIVA, REDIRIGIR A INICIOS DE LA APLICACION SEGUN SUS ROLES DE USUARIOS
} else {
    // USUARIOS ADMINISTRADORES
    if ($_SESSION['id_rol'] == 1) {
        header('location:../controlador/cGestionesCashman.php?cashmanhagestion=inicioadministradores');
        // USUARIOS PRESIDENCIA
    } else if ($_SESSION['id_rol'] == 2) {
        header('location:../controlador/cGestionesCashman.php?cashmanhagestion=iniciopresidencia');
        // USUARIOS GERENCIA
    } else if ($_SESSION['id_rol'] == 3) {
        header('location:../controlador/cGestionesCashman.php?cashmanhagestion=iniciogerencia');
        // USUARIOS ATENCION AL CLIENTE
    } else if ($_SESSION['id_rol'] == 4) {
        header('location:../controlador/cGestionesCashman.php?cashmanhagestion=inicioatencionclientes');
        // USUARIOS CLIENTES
    } else if ($_SESSION['id_rol'] == 5) {
        header('location:../controlador/cGestionesCashman.php?cashmanhagestion=inicioclientes');
    }
}
?>
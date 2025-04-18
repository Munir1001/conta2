<?php
// SOLO  USUARIOS CONTABILIDAD
if ($_SESSION['id_rol'] == 6) {
?>
    <div class="deznav">
        <div class="deznav-scroll">
            <ul class="metismenu" id="menu">
                <li class="menu-item">
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="true">
                        <svg class="w-6 h-6" fill="none" stroke="LightSlateGrey" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="nav-text">Inicio</span>
                    </a>
                    <ul class="submenu" aria-expanded="false">
                        <li><a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=iniciocontabilidad">Mi Inicio</a></li>
                        <li><a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=perfilcontabilidad">Mi Perfil</a></li>
                    </ul>
                </li>
                <li class="menu-item" <?php if ($_GET['cashmanhagestion'] == "consulta-productos-especifica-cashmanha-gerencia" || $_GET['cashmanhagestion'] == "modificar-productos-cashmanha-gerencia") {
                                            echo "class='mm-active'";
                                        } ?>><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="true">
                        <svg class="w-6 h-6" fill="none" stroke="LightSlateGrey" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="nav-text">Productos</span>
                    </a>
                    <ul class="submenu" aria-expanded="false">
                        <li>
                            <a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=consultar-productos-cashmanha-contabilidad"
                                <?php echo in_array($_GET['cashmanhagestion'], ['consulta-productos-especifica-cashmanha-contabilidad', 'modificar-productos-cashmanha-gerencia']) ? "class='active-element-menu'" : ''; ?>>
                                Consultar Productos
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=consulta-contabilidad-cashmanha-contabilidad"
                                <?php echo $_GET['cashmanhagestion'] === 'consulta-contabilidad-cashmanha-contabilidad' ? "class='active-element-menu'" : ''; ?>>
                                Contabilidad
                            </a>
                        </li>
                    </ul>

                    <?php
                    if ($_SESSION['comprobacioncuenta_ahorros'] == "si") {
                    ?>
                <li <?php if ($_GET['cashmanhagestion'] == "sistema-pagos-creditos-cashmanha-clientes" || $_GET['cashmanhagestion'] == "validacion-datos-transferencia-otras-cuentas-clientes") {
                            echo 'class="mm-active"';
                        } ?>><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="true">
                        <svg fill="LightSlateGrey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0H24V24H0z" />
                            <path d="M12 13c1.657 0 3 1.343 3 3 0 .85-.353 1.616-.92 2.162L12.17 20H15v2H9v-1.724l3.693-3.555c.19-.183.307-.438.307-.721 0-.552-.448-1-1-1s-1 .448-1 1H9c0-1.657 1.343-3 3-3zm6 0v4h2v-4h2v9h-2v-3h-4v-6h2zM4 12c0 2.527 1.171 4.78 3 6.246v2.416C4.011 18.933 2 15.702 2 12h2zm8-10c5.185 0 9.449 3.947 9.95 9h-2.012C19.446 7.054 16.08 4 12 4 9.536 4 7.332 5.114 5.865 6.865L8 9H2V3l2.447 2.446C6.28 3.336 8.984 2 12 2z" />
                        </svg>
                        <span class="nav-text">Transferencias</span>
                    </a>
                    <ul class="submenu" aria-expanded="false">
                        <li><a <?php if ($_GET['cashmanhagestion'] == "validacion-datos-transferencia-otras-cuentas-clientes") {
                                    echo 'class="active-element-menu"';
                                } ?> href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=transferencia-otras-cuentas-clientes-portal-atencionclientes">Transferir Dinero Otras Cuentas</a></li>
                    </ul>
                </li>
            <?php } ?>
            <li class="menu-item" <?php if ($_GET['cashmanhagestion'] == "consulta-especifica-tickets-reportes-plataforma") {
                                        echo 'class="mm-active"';
                                    } ?>><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="true">
                    <svg fill="LightSlateGrey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M4 20v-6a8 8 0 1 1 16 0v6h1v2H3v-2h1zm2 0h12v-6a6 6 0 1 0-12 0v6zm5-18h2v3h-2V2zm8.778 2.808l1.414 1.414-2.12 2.121-1.415-1.414 2.121-2.121zM2.808 6.222l1.414-1.414 2.121 2.12L4.93 8.344 2.808 6.222zM7 14a5 5 0 0 1 5-5v2a3 3 0 0 0-3 3H7z" />
                    </svg>
                    <span class="nav-text">Problemas</span>
                </a>
                <ul class="submenu" aria-expanded="false">
                    <li><a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=registrar-ticket-problema-plataforma-atencion-clientes">Registrar Reportes Problemas</a></li>
                </ul>
            </li>
            <li class="menu-item" <?php if ($_GET['cashmanhagestion'] == "detalle-mensajeria-cashmanha-usuarios") {
                                        echo 'class="mm-active"';
                                    } ?>><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="true">
                    <svg fill="LightSlateGrey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M6.455 19L2 22.5V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6.455zm-.692-2H20V5H4v13.385L5.763 17zM11 10h2v2h-2v-2zm-4 0h2v2H7v-2zm8 0h2v2h-2v-2z" />
                    </svg>
                    <span class="nav-text">Mensajer&iacute;a</span>
                </a>
                <ul class="submenu" aria-expanded="false">
                    <li><a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=envio-mensajeria-usuarios-cashmanha-atencion-al-cliente">Enviar Nuevo Mensaje</a></li>
                    <li><a href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=mensajeria-cashmanha-usuarios-atencion-al-cliente">Bandeja de Entrada</a></li>
                    <li><a <?php if ($_GET['cashmanhagestion'] == "detalle-mensajeria-cashmanha-usuarios") {
                                echo 'class="active-element-menu"';
                            } ?> href="javascript:void()">Detalle Mensaje Recibido</a></li>
                </ul>
            </li>
            <li>
                <a class="ai-icon" href="<?php echo $UrlGlobal; ?>controlador/cGestionesCashman.php?cashmanhagestion=visualizar-mis-notificaciones-usuarios-atencion-clientes" aria-expanded="true">
                    <svg fill="LightSlateGrey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M20 17h2v2H2v-2h2v-7a8 8 0 1 1 16 0v7zm-2 0v-7a6 6 0 1 0-12 0v7h12zm-9 4h6v2H9v-2z" />
                    </svg>
                    <span class="nav-text">Notificaciones</span>
                </a>
            </li>
            </ul>
        </div>
        <div class="copyright">
        </div>
    </div>
    </div>
    <script src="https://kit.fontawesome.com/5ecb76baab.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var menuItems = document.querySelectorAll('.menu-item .has-arrow');

            menuItems.forEach(function(menuItem) {
                menuItem.addEventListener('click', function() {
                    // Close all other submenus
                    document.querySelectorAll('.menu-item').forEach(function(item) {
                        if (item !== menuItem.parentElement) {
                            item.classList.remove('mm-active');
                            item.querySelector('.submenu').style.display = 'none';
                        }
                    });

                    // Toggle the clicked submenu
                    var submenu = menuItem.nextElementSibling;
                    if (submenu.style.display === 'block') {
                        submenu.style.display = 'none';
                        menuItem.parentElement.classList.remove('mm-active');
                    } else {
                        submenu.style.display = 'block';
                        menuItem.parentElement.classList.add('mm-active');
                    }
                });
            });
        });
    </script>

<?php } ?>
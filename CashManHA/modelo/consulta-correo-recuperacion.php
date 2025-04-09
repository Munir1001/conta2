<?php 

    // IMPORTAR ARCHIVO DE CONEXION
    require('conexion.php');
    // EVITAR CONSULTAS USUARIOS VACIOS
    if(!empty($_POST["val-email"])) {
        $resultado=mysqli_query($conectarsistema,"CALL ConsultarCorreoRecuperacion('".$_POST["val-email"] ."');");
        // LEER COINCIDENCIAS DE USUARIOS SEGUN INGRESADO EN CAJA DE TEXTO
        $usuario_encontrado = mysqli_num_rows($resultado); // CONTADOR DE BUSQUEDA
        if($usuario_encontrado>0) { // USUARIO EXISTENTE
            // USUARIOS REGISTRADOS EN EL SISTEMA
            // IMPRESIO DE BOTON -> CONFIRMACION PARA REESTABLECER CONTRASEÑA [DESBLOQUEADO]
            $UsuarioDisponible="<span class='disponible'><i class='fa fa-check-circle'></i> Usuario registrado en nuestro sistema, puede continuar...</span><br><br>
            <div class='text-center'><button id='enviodatos' type='submit' class='btn btn-primary btn-block' >Recuperar Contrase&ntilde;a</button></div>";
            echo $UsuarioDisponible;
        }else{ // USUARIO NO EXISTENTE
            // USUARIOS NO REGISTRADOS EN EL SISTEMA
            // IMPRESIO DE BOTON -> RESTRICCION PARA REESTABLECER CONTRASEÑA [BLOQUEADO]
            $UsuarioNoDisponible = "<span class='nodisponible'><i class='fa fa-times-circle'></i> Lo sentimos, no podemos proceder con la recuperación. Usuario no encontrado y/o registrado.</span><br><br><div class='text-center'></div>";
            echo $UsuarioNoDisponible;
        }
    }

<?php 

    // IMPORTAR ARCHIVO DE CONEXION
    require('conexion.php');
    // EVITAR CONSULTAS USUARIOS VACIOS
    if(!empty($_POST["val-usuariounico"])) {
        $resultado=mysqli_query($conectarsistema,"CALL ConsultaDisponibilidadUsuariosUnicos('".$_POST["val-usuariounico"] ."');");
        // LEER COINCIDENCIAS DE USUARIOS SEGUN INGRESADO EN CAJA DE TEXTO
        $usuario_encontrado = mysqli_num_rows($resultado); // CONTADOR DE BUSQUEDA
        if($usuario_encontrado>0) { // USUARIO EXISTENTE
            // USUARIOS REGISTRADOS EN EL SISTEMA
            // IMPRESIO DE BOTON -> CONFIRMACION PARA REESTABLECER CONTRASEÑA [DESBLOQUEADO]
            $UsuarioNoDisponible = "<span class='nodisponible'><i class='fa fa-times-circle'></i> Lo sentimos, el usuario solicitado ya se encuenta en uso.</span>";
            echo $UsuarioNoDisponible;
        }else{ // USUARIO NO EXISTENTE
            // USUARIOS NO REGISTRADOS EN EL SISTEMA
            // IMPRESIO DE BOTON -> RESTRICCION PARA REESTABLECER CONTRASEÑA [BLOQUEADO]
            $UsuarioDisponible="<span class='disponible'><i class='fa fa-check-circle'></i> Perfecto, puedes hacer uso de este usuario</span>";
            echo $UsuarioDisponible;
        }
    }

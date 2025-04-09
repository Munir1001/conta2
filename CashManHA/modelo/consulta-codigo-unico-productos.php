<?php 

    // IMPORTAR ARCHIVO DE CONEXION
    require('conexion.php');
    // EVITAR CONSULTAS USUARIOS VACIOS
    if(!empty($_POST["val-codigoproducto"])) {
        $resultado=mysqli_query($conectarsistema,"CALL ConsultaDisponibilidadCodigoUnicoProductos('".$_POST["val-codigoproducto"] ."');");
        // LEER COINCIDENCIAS DE CODIGOS SEGUN INGRESADO EN CAJA DE TEXTO
        $codigo_encontrado = mysqli_num_rows($resultado); // CONTADOR DE BUSQUEDA
        if($codigo_encontrado>0) { // CODIGO EXISTENTE
            // CODIGOS REGISTRADOS EN EL SISTEMA
            $CodigoNoDisponible = "<span class='nodisponible'><i class='fa fa-times-circle'></i> Lo sentimos, el código solicitado ya se encuenta en uso.</span>";
            echo $CodigoNoDisponible;
        }else{ // CODIGO NO EXISTENTE
            // CODIGOS NO REGISTRADOS EN EL SISTEMA
            $CodigoDisponible="<span class='disponible'><i class='fa fa-check-circle'></i> Perfecto, puedes hacer uso de este código</span>";
            echo $CodigoDisponible;
        }
    }

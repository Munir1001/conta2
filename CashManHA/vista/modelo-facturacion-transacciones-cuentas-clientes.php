<?php
// NO PERMITIR INGRESO SI PARAMETRO NO HA SIDO ESPECIFICADO
if (empty($_GET['idusuarioscuentas'])) {
    header('location:../controlador/cGestionesCashman.php?cashmanhagestion=error-404');
}
// NO PERMITIR INGRESO SI CUOTA SELECCIONADA ES DIFERENTE A LA CONSULTADA
if ($_GET['idtransaccionesclientes'] != $Gestiones->getIdTransaccionesDepositosRetirosCuentas()) {
    header('location:../controlador/cGestionesCashman.php?cashmanhagestion=error-404');
}
require('../FPDF/fpdf.php');
require '../vendor/autoload.php';
// CONVERSION DE NUMEROS A LETRAS
use Luecano\NumeroALetras\NumeroALetras; // LLAMADO DE CLASE
$Conversion = new NumeroALetras(); // CREANDO OBJETO INSTANCIA DE CLASE
// DATOS DE LOCALIZACION -> IDIOMA ESPAÑOL -> ZONA HORARIA Ecuador (UTC-5)
date_default_timezone_set('America/Guayaquil');

if (empty($_GET['idtransaccionesclientes'])) {
    echo '
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>InversGlobal | Registro Depósitos Cuentas de Ahorro</title>
    <!-- Favicon icon -->
    <link rel="apple-touch-icon" sizes="57x57" href="'. $UrlGlobal .'vista/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="'. $UrlGlobal .'vista/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="'. $UrlGlobal .'vista/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="'. $UrlGlobal .'vista/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="'. $UrlGlobal .'vista/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="'. $UrlGlobal .'vista/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="'. $UrlGlobal .'vista/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="'. $UrlGlobal .'vista/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="'. $UrlGlobal .'vista/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="'. $UrlGlobal .'vista/images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="'. $UrlGlobal .'vista/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="'. $UrlGlobal .'vista/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="'. $UrlGlobal .'vista/images/favicon-16x16.png">
    <link rel="manifest" href="'. $UrlGlobal .'vista/images/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="'. $UrlGlobal .'vista/images/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="'. $UrlGlobal .'vista/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="'. $UrlGlobal .'vista/css/style.css" rel="stylesheet">
    <link href="'. $UrlGlobal .'vista/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <div class="col-xl-12 col-xxl-12">
    <div class="card">
        <div class="card-header d-block">
            <img class="img-fluid" style="width: 100%; max-width: 100px; padding: 0 0 1rem 0;" src="'. $UrlGlobal .'vista/images/logo.png">
            <h4 class="card-title">Confirmación de Procesamiento Datos Transacción </h4>
            <p class="mb-0 subtitle">Primera Transacción del Cliente: '. $Gestiones->getNombresUsuarios() .' '. $Gestiones->getApellidosUsuarios() .'</p>
            <p class="mb-0 subtitle">Referencia: '. $Gestiones->getReferenciaTransaccionDepositosRetirosCuentas() .'</p>
            <p class="mb-0 subtitle"><img style="width: 30px;" class="img-fluid" src="'. $UrlGlobal .'vista/images/click.gif"> <a href="">Regresar Inicio Aplicación</a></p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-12">
                    <div class="alert alert-success left-icon-big alert-dismissible fade show">
                        <div class="media">
                            <div class="alert-left-icon-big">
                                <span><i class="mdi mdi-check-circle-outline"></i></span>
                            </div>
                            <div class="media-body">
                                <h5 class="mt-1 mb-2">Transacción Procesada Con Éxito</h5>
                                <p class="mb-0">Estimado(a) <strong>'. explode(' ', $_SESSION['nombre_usuario'], 2)[0] .'</strong>, hemos detectado que este cliente realiza la primera transacción en su cuenta. Motivo por el cual por esta ocasión usted deberá ingresar manualmente al respectivo comprobante de la transacción realizada. Le informamos que será la única vez que visualizará este mensaje con este cliente al ser la primera transacción procesada en nuestro sistema, en futuras transacciones, usted será redirigido automáticamente al respectivo comprobante. <strong> Por favor haga clic en el botón abajo de este mensaje</strong></p>
                                <a target="_blank" style="width: 50%; margin: 1.5rem auto; display: block;" href="'. $UrlGlobal .'controlador/cGestionesCashman.php?cashmanhagestion=impresion-comprobantes-transacciones-cuentas-clientes&idtransaccionesclientes='. $Gestiones->getIdTransaccionesDepositosRetirosCuentas() .'&idusuarioscuentas='. $Gestiones->getIdUsuarios() .'"  class="btn btn-success"><i class="fa fa-print"></i> Imprimir Comprobante</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
} else {
    $FechaTransaccion = date_create($Gestiones->getFechaTransaccionDepositosRetirosCuentas());
    
    // INICIO REPORTE
    class PDF extends FPDF
    {
        // CABECERA DE DOCUMENTO
        function Header()
        {
            $this->Image('../vista/images/modelo-facturacion-creditos/cabecerafacturacionabonosretiros.png', 0, 0, 216);
        }

        // PIE DE PAGINA
        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
        }
    }
    
    // CREACION DE INSTANCIA DE CLASE
    $pdf = new PDF('P', 'mm', 'LETTER');
    $pdf->SetTitle(mb_convert_encoding("Facturación Clientes - InversGlobal", 'ISO-8859-1', 'UTF-8'));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    // CONTENIDO DE REPORTE [DOCUMENTO]
    $pdf->SetFont('Arial', '', 10);
    $pdf->setTextColor(255, 255, 255);
    $pdf->MultiCell(191, 8, mb_convert_encoding("Facturación InversGlobal", 'ISO-8859-1', 'UTF-8'), 0, 'R');
    $pdf->setTextColor(0, 0, 0);
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 8);
    $pdf->MultiCell(199, 4, mb_convert_encoding("Transacción: No.->#".$Gestiones->getIdTransaccionesDepositosRetirosCuentas(), 'ISO-8859-1', 'UTF-8'), 0, 'R');
    $pdf->MultiCell(199, 4, mb_convert_encoding("Fecha: ".date_format($FechaTransaccion, "d/m/Y"), 'ISO-8859-1', 'UTF-8'), 0, 'R');
    $pdf->MultiCell(199, 4, mb_convert_encoding("Hora: ".date_format($FechaTransaccion, "H:i:s"), 'ISO-8859-1', 'UTF-8'), 0, 'R');
    $pdf->MultiCell(199, 4, mb_convert_encoding("Producto: ".$Gestiones->getNombreProductos(), 'ISO-8859-1', 'UTF-8'), 0, 'R');
    $pdf->MultiCell(199, 4, mb_convert_encoding("Transacción: ".$Gestiones->getReferenciaTransaccionDepositosRetirosCuentas(), 'ISO-8859-1', 'UTF-8'), 0, 'R');
    $pdf->Ln(31);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(190, 4, mb_convert_encoding("Nombre del Cliente: ".$Gestiones->getNombresUsuarios()." ".$Gestiones->getApellidosUsuarios(), 'ISO-8859-1', 'UTF-8'));
    $pdf->MultiCell(190, 4, mb_convert_encoding("DUI: ".$Gestiones->getduiUsuarios(), 'ISO-8859-1', 'UTF-8'));
    $pdf->MultiCell(190, 4, mb_convert_encoding("Nit: ".$Gestiones->getNitUsuarios(), 'ISO-8859-1', 'UTF-8'));
    $pdf->MultiCell(190, 0, mb_convert_encoding("No. de Cuenta Cliente: ".$Gestiones->getNumeroCuentaAhorroClientes(), 'ISO-8859-1', 'UTF-8'), 0, 'R');
    $pdf->Ln(40);
    
    if ($Gestiones->getTipoTransaccionDepositosRetirosCuentas() == "Entrada") {
        $pdf->MultiCell(190, 4, mb_convert_encoding("Abono a Cuenta No.: ".$Gestiones->getNumeroCuentaAhorroClientes()." | {Cod->".$Gestiones->getCodigoProductos()." ".$Gestiones->getReferenciaTransaccionCreditosClientes()."} ( ~ $".number_format($Gestiones->getMontoDepositosRetirosCuentas(), 2)." USD)", 'ISO-8859-1', 'UTF-8'));
    } else if ($Gestiones->getTipoTransaccionDepositosRetirosCuentas() == "Salida") {
        $pdf->MultiCell(190, 4, mb_convert_encoding("Retiro a Cuenta No.: ".$Gestiones->getNumeroCuentaAhorroClientes()." | {Cod->".$Gestiones->getCodigoProductos()." ".$Gestiones->getReferenciaTransaccionCreditosClientes()."} ( ~ $".number_format($Gestiones->getMontoDepositosRetirosCuentas(), 2)." USD)", 'ISO-8859-1', 'UTF-8'));
    } else if ($Gestiones->getTipoTransaccionDepositosRetirosCuentas() == "EnvioTransferencia") {
        $pdf->MultiCell(190, 4, mb_convert_encoding("Envío Transferencia Otras Cuentas | {Cod->".$Gestiones->getCodigoProductos()." ".$Gestiones->getReferenciaTransaccionCreditosClientes()."} ( ~ $".number_format($Gestiones->getMontoDepositosRetirosCuentas(), 2)." USD)", 'ISO-8859-1', 'UTF-8'));
    } else if ($Gestiones->getTipoTransaccionDepositosRetirosCuentas() == "DepositoTransferencia") {
        $pdf->MultiCell(190, 4, mb_convert_encoding("Abono Transferencia Otras Cuentas | {Cod->".$Gestiones->getCodigoProductos()." ".$Gestiones->getReferenciaTransaccionCreditosClientes()."} ( ~ $".number_format($Gestiones->getMontoDepositosRetirosCuentas(), 2)." USD)", 'ISO-8859-1', 'UTF-8'));
    }
    
    $pdf->Ln(6);
    $pdf->MultiCell(199, 5, mb_convert_encoding("Total: $ ".number_format($Gestiones->getMontoDepositosRetirosCuentas(), 2), 'ISO-8859-1', 'UTF-8'), 0, 'R');
    $pdf->Ln(6);
    $pdf->SetFont('Arial', '', 7);
    $pdf->MultiCell(190, 4, mb_convert_encoding("TRANSACCIÓN EFETUADA POR: ".$Conversion->toWords($Gestiones->getMontoDepositosRetirosCuentas())." DOLARES DE LOS ESTADOS UNIDOS DE AMERICA", 'ISO-8859-1', 'UTF-8'), 0, 'C');
    $pdf->SetFont('Arial', '', 8);
    $pdf->Ln(5);
    $pdf->MultiCell(130, 4, mb_convert_encoding("Estimado(a) cliente. Agradecemos su preferencia, la transacción fue efectuada con éxito. Cualquier consulta, duda y/o reclamo puede efectuarlo en nuestros teléfonos 2255-0090, 2255-0091 y 2255-0192 o a nuestro correo electrónico servicioalcliente@cashmanha.com específicando el número de transacción que se encuentra en la parte superior de este documento. Trabajamos duro cada día para darle un excelente servicio a cada uno de nuestros clientes.", 'ISO-8859-1', 'UTF-8'));
    $pdf->Ln(-15);
    
    if ($Gestiones->getTipoTransaccionDepositosRetirosCuentas() == "EnvioTransferencia") {
        $pdf->MultiCell(193, 0, mb_convert_encoding("Monto Saldo Debitado", 'ISO-8859-1', 'UTF-8'), 0, 'R');
    } else if ($Gestiones->getTipoTransaccionDepositosRetirosCuentas() == "DepositoTransferencia") {
        $pdf->MultiCell(193, 0, mb_convert_encoding("Monto Saldo Añadido", 'ISO-8859-1', 'UTF-8'), 0, 'R');
    } else {
        $pdf->MultiCell(193, 0, mb_convert_encoding("Nuevo Saldo Cuenta", 'ISO-8859-1', 'UTF-8'), 0, 'R');
    }
    
    $pdf->Ln(11);
    
    if ($Gestiones->getTipoTransaccionDepositosRetirosCuentas() == "EnvioTransferencia") {
        $pdf->MultiCell(190, 0, mb_convert_encoding("-$".number_format($Gestiones->getSaldoNuevoTransaccionDepositosRetirosCuentas(), 2)." USD", 'ISO-8859-1', 'UTF-8'), 0, 'R');
    } else if ($Gestiones->getTipoTransaccionDepositosRetirosCuentas() == "DepositoTransferencia") {
        $pdf->MultiCell(190, 0, mb_convert_encoding("+$".number_format($Gestiones->getSaldoNuevoTransaccionDepositosRetirosCuentas(), 2)." USD", 'ISO-8859-1', 'UTF-8'), 0, 'R');
    } else {
        $pdf->MultiCell(190, 0, mb_convert_encoding("$".number_format($Gestiones->getSaldoNuevoTransaccionDepositosRetirosCuentas(), 2)." USD", 'ISO-8859-1', 'UTF-8'), 0, 'R');
    }
    
    if ($Gestiones->getEstadoTransaccionDepositosRetirosCuentas() == "AnularDeposito") {
        $pdf->Ln(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(213, 0, 0);
        $pdf->MultiCell(190, 4, mb_convert_encoding("Estimado(a) cliente, el depósito efectuado a su cuenta por el monto de $".number_format($Gestiones->getMontoDepositosRetirosCuentas(), 2)." USD con número de referencia ".$Gestiones->getReferenciaTransaccionDepositosRetirosCuentas()." ha sido anulado. Motivo por el cual el monto reflejado en este comprobante ha sido revertido de su cuenta de ahorros.", 'ISO-8859-1', 'UTF-8'));
        $pdf->Ln(30);
    } else if ($Gestiones->getEstadoTransaccionDepositosRetirosCuentas() == "AnularRetiro") {
        $pdf->Ln(25);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(213, 0, 0);
        $pdf->MultiCell(190, 4, mb_convert_encoding("Estimado(a) cliente, el retiro efectuado a su cuenta por el monto de $".number_format($Gestiones->getMontoDepositosRetirosCuentas(), 2)." USD con número de referencia ".$Gestiones->getReferenciaTransaccionDepositosRetirosCuentas()." ha sido anulado. Motivo por el cual el monto reflejado en este comprobante ha sido devuelto de su cuenta de ahorros.", 'ISO-8859-1', 'UTF-8'));
        $pdf->Ln(30);
    } else {
        $pdf->Ln(75);
    }
    
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 7);
    $pdf->MultiCell(190, 4, mb_convert_encoding("COMPROBANTE OFICIAL DE CANCELACIÓN InversGlobal S.A DE C.V ~ ".$Gestiones->getReferenciaTransaccionDepositosRetirosCuentas(), 'ISO-8859-1', 'UTF-8'), 0, 'C');
    $pdf->MultiCell(190, 4, mb_convert_encoding("Transacción gestionada por: Emp->C.H".$Gestiones->getEmpleadoGestionTransaccionDepositosRetirosCuentas(), 'ISO-8859-1', 'UTF-8'), 0, 'C');
    $pdf->Output();
}
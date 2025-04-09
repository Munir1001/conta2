<?php
// NO PERMITIR INGRESO SI PARAMETRO NO HA SIDO ESPECIFICADO
if (empty($_GET['idusuario'])) {
    header('location:../controlador/cGestionesCashman.php?cashmanhagestion=error-404');
}
// NO PERMITIR INGRESO SI CUOTA SELECCIONADA ES DIFERENTE A LA CONSULTADA
if ($_GET['idcuota'] != $Gestiones->getIdCuotasClientes()) {
    header('location:../controlador/cGestionesCashman.php?cashmanhagestion=error-404');
}
require('../FPDF/fpdf.php');
require '../vendor/autoload.php';

// CONVERSION DE NUMEROS A LETRAS
use Luecano\NumeroALetras\NumeroALetras;
$Conversion = new NumeroALetras();

// DATOS DE LOCALIZACION -> IDIOMA ESPAÑOL -> ZONA HORARIA Ecuador (UTC-5)
setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/Guayaquil');

// FECHA DE CANCELACION [PROCESAMIENTO TRANSACCIONES CLIENTES]
$FechaCancelacion = date_create($Gestiones->getFechaTransaccionCreditosClientes());

// CALCULO DE INCUMPLIMIENTO (Mora)
$diasAtraso = $Gestiones->getDiasIncumplimientoCuotasClientes();
$cuotaMensual = $Gestiones->getCuotaMensualCreditos();

if ($diasAtraso > 0 && $diasAtraso <= 15) {
    $MoraCuotasClientes = $cuotaMensual * 0.05;
} elseif ($diasAtraso > 15) {
    $MoraCuotasClientes = $cuotaMensual * 0.07;
} else {
    $MoraCuotasClientes = 0;
}

// INICIO DEL RECIBO
class PDF extends FPDF
{
    // CABECERA DEL DOCUMENTO
    function Header()
    {
        // Logo
        $this->Image('../vista/images/logo.png', 10, 9, 10);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Mover al centro
        $this->Cell(0, 10, 'Recibo de Pago', 0, 1, 'C');
        $this->Ln(5);

        // Linea divisora
        $this->SetLineWidth(0.1);
        $this->Line(10, 30, 90, 30);
        $this->Ln(10);
    }

    // PIE DE PÁGINA
    function Footer()
    {
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('InversGlobal S.A. | Gracias por su preferencia.'), 0, 1, 'C');
        $this->Cell(0, 10, utf8_decode('Este comprobante es válido para fines contables y legales.'), 0, 0, 'C');
    }

    // Agregar Sección
    function SectionTitle($title)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, utf8_decode($title), 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Ln(5);
    }

    // Agregar Línea Divisora
    function AddSeparator()
    {
        $this->SetLineWidth(0.3);
        $this->Line(10, $this->GetY(), 66.2, $this->GetY());
        $this->Ln(8);
    }
}

// CREACIÓN DE INSTANCIA DE CLASE
// Se define un tamaño de 3 x 14 pulgadas (76,2 x 355,6 mm)
$pdf = new PDF('P', 'mm', array(100, 355.6));
$pdf->SetTitle(utf8_decode("Recibo Bancario - InversGlobal"));
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// DATOS DE LA TRANSACCIÓN
$pdf->Cell(0, 10, utf8_decode("Fecha de Cancelación: " . date_format($FechaCancelacion, "d/m/Y H:i:s")), 0, 1);
$pdf->Cell(0, 10, utf8_decode("Orden de Pago: #" . $Gestiones->getIdCuotasClientes()), 0, 1);

// DATOS DEL CLIENTE
$pdf->Cell(0, 10, utf8_decode("Nombre del Cliente: " . $Gestiones->getNombresUsuarios() . " " . $Gestiones->getApellidosUsuarios()), 0, 1);
$pdf->Cell(0, 10, utf8_decode("Cédula: " . $Gestiones->getduiUsuarios()), 0, 1);
$pdf->Cell(0, 10, utf8_decode("RUC: " . $Gestiones->getNitUsuarios()), 0, 1);

// DETALLES DEL PAGO
$pdf->Cell(0, 10, utf8_decode("Monto de la Cuota Mensual: $" . number_format($Gestiones->getCuotaMensualCreditos(), 2)), 0, 1);
$pdf->Cell(0, 10, utf8_decode("Mora por Atraso: $" . number_format($MoraCuotasClientes, 2)), 0, 1);
$pdf->Cell(0, 10, utf8_decode("Total a Pagar: $" . number_format($Gestiones->getCuotaMensualCreditos() + $MoraCuotasClientes, 2)), 0, 1);
$pdf->Ln(10);

// MENSAJE DE AGRADECIMIENTO
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(10);
$pdf->MultiCell(0, 10, utf8_decode("Gracias por su pago. Le recordamos ser puntual para mantener una excelente calificación crediticia."), 0, 'C');

$pdf->Output();
?>



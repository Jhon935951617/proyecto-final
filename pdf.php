<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
private $cliente;
private $fecha;
// Método para establecer cliente y fecha
function setClientData($cliente, $fecha)
{
    $this->cliente = $cliente;
    $this->fecha = $fecha;
}
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/logo_calle8.png', 10, 7, 17, 17);
    // Arial bold 15
    $this->SetTextColor(0, 0, 0);
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Venta',0,0,'C');
    // Salto de línea
    $this->Ln(10);
    // Subtítulo con cliente y fecha
    $this->SetFont('Arial', '', 12);
    $this->Cell(0, 10, 'Cliente: ' . $this->cliente . '. - Fecha: ' . $this->fecha, 0, 1, 'C');
    // Línea de separación
    $this->Line(10, 30, 190, 30);
    // Salto de línea
    $this->Ln(3);
    // Creación de las cabecera th
    $this->SetFontSize(11);
    $this->SetFillColor(0, 123, 255);
    $this->SetTextColor(255, 255, 255);
    $this->SetDrawColor(0, 123, 255);
    $this->Cell(4, 6,'N', 1, 0, 'C', 1);
    $this->Cell(97, 6,'Menu', 1, 0, 'C', 1);
    $this->Cell(20, 6,'Cantidad', 1, 0, 'C', 1);
    $this->Cell(30, 6,'Precio', 1, 0, 'C', 1);
    $this->Cell(30, 6,'SubTotal', 1, 1, 'C', 1);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF();
$pdf->AliasNbPages();

// Obtener cliente y fecha de los parámetros GET
$cliente = $_GET["cliente"];
$fecha = $_GET["fecha"];

// Establecer cliente y fecha en el objeto PDF
$pdf->setClientData($cliente, $fecha);

$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetDrawColor(0, 123, 255);

require 'bd.php';
$fecha = $_GET["fecha"];
$cliente = $_GET["cliente"];
$query = "SELECT ventas.*, menus.nombre, menus.precio FROM ventas INNER JOIN menus ON .ventas.id_menu = menus.id WHERE cliente = '$cliente' AND fecha = '$fecha'";
$res = mysqli_query($conexion, $query);

$i = 1;
$total = 0;
while($fila = mysqli_fetch_assoc($res)){
    $pdf->Cell(4, 6, $i, 1, 0, 'C', 0);
    $pdf->Cell(97, 6, $fila["nombre"], 1, 0, 'L', 0);
    $pdf->Cell(20, 6, $fila["cantidad"], 1, 0, 'C', 0);
    $pdf->Cell(30, 6, "S/ " . $fila["precio"], 1, 0, 'C', 0);
    $pdf->Cell(30, 6, "S/ " . $fila["subtotal"], 1, 1, 'C', 0);

    $total += $fila["subtotal"];
    $i++;
}

// Agregar la fila de total
$pdf->SetFont('Arial','B',12);
$pdf->Cell(121, 6, '', 0, 0, 'C', 0); // Celdas vacías para alinear el total
$pdf->Cell(30, 6, 'Total', 1, 0, 'C', 0);
$pdf->Cell(30, 6, "S/ " . $total, 1, 1, 'C', 0);

$pdf->Output();
?>
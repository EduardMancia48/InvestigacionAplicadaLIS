<?php
session_start();

require_once('tcpdf/tcpdf.php');

if (empty($_SESSION['carrito'])) {
  $_SESSION['carrito'] = array(); // Si el carrito está vacío, se crea un arreglo vacío para almacenar los productos
}
// Verifica si se ha enviado el formulario
if (isset($_POST['solicitar_cotizacion'])) {
  
  // Genera el HTML que se convertirá en el PDF
  $html = '<html><body>';
  $html .= '<h1>Cotización</h1>';
  $html .= '<table>';
  $html .= '<tr><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr>';
  foreach ($_SESSION['carrito'] as $producto) {
    $html .= '<tr>';
    $html .= '<td>' . $producto['nombre'] . '</td>';
    $html .= '<td>' . $producto['precio'] . '</td>';
    $html .= '<td>' . $producto['cantidad'] . '</td>';
    $html .= '<td>' . $producto['precio'] * $producto['cantidad'] . '</td>';
    $html .= '</tr>';
}

  $html .= '</table>';
  $html .= '</body></html>';
  
  // Limpia el carrito
  $_SESSION['carrito'] = array();
  
  // Genera el archivo PDF
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $pdf->SetCreator(PDF_CREATOR);
  $pdf->SetAuthor('TechCelSV');
  $pdf->SetTitle('Cotización de productos');
  $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Cotización', 'por: TechCelSV', array(0,64,255), array(0,64,128));
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
  $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
  $pdf->SetFont('dejavusans', '', 10);
  $pdf->AddPage();
  $pdf->writeHTML($html, true, false, true, false, '');
  
  // Descarga el archivo PDF

  $pdf->Output('cotizacion.pdf', 'D');
  header("Location: confirmar_cotizacion.php");

  exit();
}
?>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Solicitar cotización</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
  <div class="container my-4">
    <h1 class="text-center mb-4">Solicitar cotización</h1>
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="form-group">
            <label for="nombre">Nombre completo *</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="email">Correo electrónico *</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono *</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required>
          </div>
  
          <div class="form-group">
            <table>
              <tr>
                <th>Nombre</th> 
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
              </tr>
              <?php
              // Iterar a través de los elementos del carrito
              foreach ($_SESSION['carrito'] as $producto) {
                echo "<tr>";
                echo "<td style='border: 1px solid black; padding: 5px;'>" . $producto['nombre'] . "</td>";
                echo "<td style='border: 1px solid black; padding: 5px;'>" . $producto['precio'] . "</td>";
                echo "<td style='border: 1px solid black; padding: 5px;'>" . $producto['cantidad'] . "</td>";
                echo "<td style='border: 1px solid black; padding: 5px; text-align: right;'>$" . number_format($producto['precio'] * $producto['cantidad'], 2) . "</td>";
                echo "</tr>";
                
              }
              ?>
            </table>
          </div>
          <button type="submit" name="solicitar_cotizacion" class="btn btn-primary">Confirmar cotización</button>
          
        </form>
      </div>
    </div>
  </div>
</body>

</html>


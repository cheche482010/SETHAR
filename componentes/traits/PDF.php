<?php
trait PDF
{
    /**
     * Crea un nuevo archivo PDF.
     *
     * @param string $titulo Título del PDF.
     * @param string $autor Autor del PDF.
     * @return object Instancia de TCPDF.
     */
    public function Crear_PDF($titulo, $autor)
    {
        require_once 'tcpdf/tcpdf.php';

        // Crea una nueva instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

        // Establece los metadatos del PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($autor);
        $pdf->SetTitle($titulo);

        return $pdf;
    }

    /**
     * Agrega una página al PDF.
     *
     * @param object $pdf Instancia de TCPDF.
     * @param string $contenido Contenido de la página.
     */
    public function Agregar_Pagina_PDF($pdf, $contenido)
    {
        $pdf->AddPage();

        // Agrega el contenido a la página
        $pdf->writeHTML($contenido, true, false, true, false, '');
    }

    /**
     * Guarda el PDF en un archivo.
     *
     * @param object $pdf Instancia de TCPDF.
     * @param string $nombre_archivo Nombre del archivo PDF.
     */
    public function Guardar_PDF($pdf, $nombre_archivo)
    {
        $pdf->Output($nombre_archivo, 'F');
    }

    /**
     * Agrega un encabezado personalizado en todas las páginas del PDF.
     *
     * @param object $pdf Instancia de TCPDF.
     * @param string $encabezado Contenido del encabezado.
     */
    public function Agregar_Encabezado_PDF($pdf, $encabezado)
    {
        $pdf->setHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setHeaderMargin(10);
        $pdf->setPrintHeader(true);
        $pdf->setHeaderData($encabezado, '', '');
    }

    /**
     * Agrega un pie de página personalizado en todas las páginas del PDF.
     *
     * @param object $pdf Instancia de TCPDF.
     * @param string $pie_de_pagina Contenido del pie de página.
     */
    public function Agregar_PieDe_Pagina_PDF($pdf, $pie_de_pagina)
    {
        $pdf->setFooterData(array(0, 0, 0), array(255, 255, 255));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->setFooterMargin(10);
        $pdf->setPrintFooter(true);
        $pdf->setFooterData($pie_de_pagina);
    }

    /**
     * Agrega una imagen al PDF.
     *
     * @param object $pdf Instancia de TCPDF.
     * @param string $imagen Ruta de la imagen en el sistema o URL externa.
     * @param float $posicion_x Posición horizontal de la imagen en el PDF.
     * @param float $posicion_y Posición vertical de la imagen en el PDF.
     * @param float $ancho Anchura de la imagen en el PDF.
     * @param float $alto Altura de la imagen en el PDF.
     */
    public function Agregar_Imagen_PDF($pdf, $imagen, $posicion_x, $posicion_y, $ancho, $alto)
    {
        $pdf->Image($imagen, $posicion_x, $posicion_y, $ancho, $alto);
    }

    /**
     * Agrega una tabla al PDF con datos estructurados.
     *
     * @param object $pdf Instancia de TCPDF.
     * @param array $datos Datos de la tabla.
     * @param array $columnas Nombres de las columnas de la tabla.
     */
    public function Agregar_Tabla_PDF($pdf, $datos, $columnas)
    {
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetFont('', 'B');
        $pdf->Cell(40, 10, 'Columna 1', 1, 0, 'L', 1);
        $pdf->Cell(40, 10, 'Columna 2', 1, 0, 'L', 1);
        $pdf->Ln();

        $pdf->SetFont('');
        foreach ($datos as $fila) {
            $pdf->Cell(40, 10, $fila['columna1'], 1, 0, 'L');
            $pdf->Cell(40, 10, $fila['columna2'], 1, 0, 'L');
            $pdf->Ln();
        }
    }

    /**
     * Agrega un enlace dentro del PDF.
     *
     * @param object $pdf Instancia de TCPDF.
     * @param string $enlace URL del enlace.
     * @param string $texto Texto del enlace.
     */
    public function Agregar_Enlace_PDF($pdf, $enlace, $texto)
    {
        $pdf->writeHTML('<a href="' . $enlace . '">' . $texto . '</a>', true, false, true, false, '');
    }

    /**
     * Agrega texto adicional al PDF.
     *
     * @param object $pdf Instancia de TCPDF.
     * @param string $texto Texto a agregar.
     */
    public function Agregar_Texto_PDF($pdf, $texto)
    {
        $pdf->writeHTML($texto, true, false, true, false, '');
    }

}

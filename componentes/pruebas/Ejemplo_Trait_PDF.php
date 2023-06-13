<?php

class Ejemplo_Trait_PDF
{
    use PDF;

    public function generarPDF()
    {
        $titulo = 'Ejemplo PDF';
        $autor = 'John Doe';

        $pdf = $this->Crear_PDF($titulo, $autor);

        $contenido = '<h1>Contenido del PDF</h1>';
        $this->Agregar_Pagina_PDF($pdf, $contenido);

        $nombre_archivo = 'ejemplo.pdf';
        $this->Guardar_PDF($pdf, $nombre_archivo);
    }

    public function generarEncabezado()
    {
        $titulo = 'Ejemplo PDF';
        $autor = 'John Doe';

        $pdf = $this->Crear_PDF($titulo, $autor);

        $encabezado = 'Encabezado personalizado';
        $this->Agregar_Encabezado_PDF($pdf, $encabezado);

        $contenido = '<h1>Contenido del PDF</h1>';
        $this->Agregar_Pagina_PDF($pdf, $contenido);

        $nombre_archivo = 'ejemplo_encabezado.pdf';
        $this->Guardar_PDF($pdf, $nombre_archivo);
    }

    public function generarPieDePagina()
    {
        $titulo = 'Ejemplo PDF';
        $autor = 'John Doe';

        $pdf = $this->Crear_PDF($titulo, $autor);

        $pie_de_pagina = 'Pie de página personalizado';
        $this->Agregar_PieDe_Pagina_PDF($pdf, $pie_de_pagina);

        $contenido = '<h1>Contenido del PDF</h1>';
        $this->Agregar_Pagina_PDF($pdf, $contenido);

        $nombre_archivo = 'ejemplo_pie_de_pagina.pdf';
        $this->Guardar_PDF($pdf, $nombre_archivo);
    }

    public function generarImagen()
    {
        $titulo = 'Ejemplo PDF';
        $autor = 'John Doe';

        $pdf = $this->Crear_PDF($titulo, $autor);

        $imagen = 'ruta/imagen.jpg';
        $posicion_x = 10;
        $posicion_y = 10;
        $ancho = 100;
        $alto = 100;
        $this->Agregar_Imagen_PDF($pdf, $imagen, $posicion_x, $posicion_y, $ancho, $alto);

        $nombre_archivo = 'ejemplo_imagen.pdf';
        $this->Guardar_PDF($pdf, $nombre_archivo);
    }

    public function generarTabla()
    {
        $titulo = 'Ejemplo PDF';
        $autor = 'John Doe';

        $pdf = $this->Crear_PDF($titulo, $autor);

        $datos = [
            ['columna1' => 'Dato 1', 'columna2' => 'Dato 2'],
            ['columna1' => 'Dato 3', 'columna2' => 'Dato 4'],
            ['columna1' => 'Dato 5', 'columna2' => 'Dato 6'],
        ];
        $columnas = ['Columna 1', 'Columna 2'];
        $this->Agregar_Tabla_PDF($pdf, $datos, $columnas);

        $nombre_archivo = 'ejemplo_tabla.pdf';
        $this->Guardar_PDF($pdf, $nombre_archivo);
    }

    public function generarEnlace()
    {
        $titulo = 'Ejemplo PDF';
        $autor = 'John Doe';

        $pdf = $this->Crear_PDF($titulo, $autor);

        $enlace = 'https://www.example.com';
        $texto = 'Enlace a ejemplo.com';
        $this->Agregar_Enlace_PDF($pdf, $enlace, $texto);

        $nombre_archivo = 'ejemplo_enlace.pdf';
        $this->Guardar_PDF($pdf, $nombre_archivo);
    }

    public function agregarTexto()
    {
        $titulo = 'Ejemplo PDF';
        $autor = 'John Doe';

        $pdf = $this->Crear_PDF($titulo, $autor);

        $texto = 'Este es un texto adicional en el PDF.';
        $this->Agregar_Texto_PDF($pdf, $texto);

        $nombre_archivo = 'ejemplo_texto.pdf';
        $this->Guardar_PDF($pdf, $nombre_archivo);
    }
}

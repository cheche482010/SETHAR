<?php

class Ejemplo_Trait_Imagenes
{
    use Imagenes;

    public function redimensionarImagen()
    {
        $rutaImagen = 'ruta/a/imagen.jpg';
        $ancho = 500;
        $alto = 300;

        $this->Redimensionar_Imagen($rutaImagen, $ancho, $alto);
    }

    public function aplicarFiltroBrillo()
    {
        $rutaImagen = 'ruta/a/imagen.jpg';
        $nivelBrillo = 50;

        $this->Aplicar_Filtro_Brillo($rutaImagen, $nivelBrillo);
    }

    public function aplicarFiltroSaturacion()
    {
        $rutaImagen = 'ruta/a/imagen.jpg';
        $nivelSaturacion = -30;

        $this->Aplicar_Filtro_Saturacion($rutaImagen, $nivelSaturacion);
    }

    public function aplicarFiltroContraste()
    {
        $rutaImagen = 'ruta/a/imagen.jpg';
        $nivelContraste = 20;

        $this->Aplicar_Filtro_Contraste($rutaImagen, $nivelContraste);
    }

    public function guardarImagen()
    {
        $nombreCampo = 'imagen';
        $carpetaDestino = 'ruta/destino/';
        $nombreImagen = 'nueva_imagen.jpg';

        $rutaGuardada = $this->Guardar_Imagen($nombreCampo, $carpetaDestino, $nombreImagen);
        if ($rutaGuardada !== false) {
            echo 'La imagen se guardó correctamente en: ' . $rutaGuardada;
        } else {
            echo 'No se pudo guardar la imagen.';
        }
    }

    public function generarMiniatura()
    {
        $rutaImagen = 'ruta/a/imagen.jpg';
        $rutaMiniatura = 'ruta/miniatura/miniatura.jpg';
        $ancho = 200;
        $alto = 150;

        $this->Generar_Miniatura($rutaImagen, $rutaMiniatura, $ancho, $alto);
    }

    public function rotarImagen()
    {
        $rutaImagen = 'ruta/a/imagen.jpg';
        $grados = 90;

        $this->Rotar_Imagen($rutaImagen, $grados);
    }

    public function agregarMarcaAgua()
    {
        $rutaImagen = 'ruta/a/imagen.jpg';
        $rutaMarcaAgua = 'ruta/a/marca_agua.png';
        $posicionX = 10;
        $posicionY = 10;

        $this->Agregar_Marca_Agua($rutaImagen, $rutaMarcaAgua, $posicionX, $posicionY);
    }

    public function combinarImagenes()
    {
        $rutaImagen1 = 'ruta/a/imagen1.jpg';
        $rutaImagen2 = 'ruta/a/imagen2.jpg';
        $rutaImagenCombinada = 'ruta/combinada/imagen_combinada.jpg';

        $this->Combinar_Imagenes($rutaImagen1, $rutaImagen2, $rutaImagenCombinada);
    }

    public function generarImagenBlanco()
    {
        $ancho = 800;
        $alto = 600;
        $rutaImagen = 'ruta/imagen_blanco.jpg';

        $this->Generar_Imagen_Blanco($ancho, $alto, $rutaImagen);
    }
}

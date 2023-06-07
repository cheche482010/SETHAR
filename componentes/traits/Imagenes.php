<?php

namespace Componentes\Funciones;

trait Imagenes
{
    /**
     * Redimensiona una imagen al tamaño especificado.
     *
     * @param string $rutaImagen Ruta de la imagen a redimensionar.
     * @param int $ancho Ancho deseado para la imagen redimensionada.
     * @param int $alto Alto deseado para la imagen redimensionada.
     *
     * @return bool Devuelve true si la imagen se redimensionó correctamente, false en caso contrario.
     */
    public function Redimensionar_Imagen($rutaImagen, $ancho, $alto)
    {
        $imagen      = imagecreatefromjpeg($rutaImagen);
        $nuevaImagen = imagescale($imagen, $ancho, $alto);
        return imagejpeg($nuevaImagen, $rutaImagen);
    }

    /**
     * Aplica un filtro de brillo a una imagen.
     *
     * @param string $rutaImagen Ruta de la imagen a aplicar el filtro.
     * @param int $nivelBrillo Nivel de brillo a aplicar (-255 a 255).
     *
     * @return bool Devuelve true si se aplicó el filtro correctamente, false en caso contrario.
     */
    public function Aplicar_Filtro_Brillo($rutaImagen, $nivelBrillo)
    {
        $imagen = imagecreatefromjpeg($rutaImagen);
        imagefilter($imagen, IMG_FILTER_BRIGHTNESS, $nivelBrillo);
        return imagejpeg($imagen, $rutaImagen);
    }

    /**
     * Aplica un filtro de saturación a una imagen.
     *
     * @param string $rutaImagen Ruta de la imagen a aplicar el filtro.
     * @param int $nivelSaturacion Nivel de saturación a aplicar (-100 a 100).
     *
     * @return bool Devuelve true si se aplicó el filtro correctamente, false en caso contrario.
     */
    public function Aplicar_Filtro_Saturacion($rutaImagen, $nivelSaturacion)
    {
        $imagen = imagecreatefromjpeg($rutaImagen);
        imagefilter($imagen, IMG_FILTER_SATURATE, $nivelSaturacion);
        return imagejpeg($imagen, $rutaImagen);
    }

    /**
     * Aplica un filtro de contraste a una imagen.
     *
     * @param string $rutaImagen Ruta de la imagen a aplicar el filtro.
     * @param int $nivelContraste Nivel de contraste a aplicar (-100 a 100).
     *
     * @return bool Devuelve true si se aplicó el filtro correctamente, false en caso contrario.
     */
    public function Aplicar_Filtro_Contraste($rutaImagen, $nivelContraste)
    {
        $imagen = imagecreatefromjpeg($rutaImagen);
        imagefilter($imagen, IMG_FILTER_CONTRAST, $nivelContraste);
        return imagejpeg($imagen, $rutaImagen);
    }

    /**
     * Guarda una imagen en la carpeta destino.
     *
     * @param string $nombreCampo Nombre del campo del formulario que contiene la imagen.
     * @param string $carpetaDestino Ruta de la carpeta destino donde se guardará la imagen.
     * @param string $nombreImagen Nombre deseado para la imagen.
     *
     * @return string|false Devuelve la ruta completa de la imagen guardada si se guarda correctamente,
     *                      o false si no se pudo guardar la imagen.
     */
    public function Guardar_Imagen($nombreCampo, $carpetaDestino, $nombreImagen)
    {
        if ($_FILES[$nombreCampo]["type"] == "image/jpeg" ||
            $_FILES[$nombreCampo]["type"] == "image/pjpeg" ||
            $_FILES[$nombreCampo]["type"] == "image/gif" ||
            $_FILES[$nombreCampo]["type"] == "image/png") {

            if (isset($_FILES[$nombreCampo])) {
                if (file_exists($carpetaDestino)) {
                    $origen  = $_FILES[$nombreCampo]["tmp_name"];
                    $destino = $carpetaDestino . $nombreImagen . "-" . $_FILES[$nombreCampo]["name"];

                    if (move_uploaded_file($origen, $destino)) {
                        return $destino;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Genera una miniatura de una imagen.
     *
     * @param string $rutaImagen Ruta de la imagen original.
     * @param string $rutaMiniatura Ruta donde se guardará la miniatura.
     * @param int $ancho Ancho deseado para la miniatura.
     * @param int $alto Alto deseado para la miniatura.
     *
     * @return bool Devuelve true si se generó la miniatura correctamente, false en caso contrario.
     */
    public function Generar_Miniatura($rutaImagen, $rutaMiniatura, $ancho, $alto)
    {
        $imagen          = imagecreatefromjpeg($rutaImagen);
        $miniatura       = imagecreatetruecolor($ancho, $alto);
        $origenAncho     = imagesx($imagen);
        $origenAlto      = imagesy($imagen);
        $destinoAncho    = $ancho;
        $destinoAlto     = $alto;
        $relacionAspecto = $origenAncho / $origenAlto;

        if ($destinoAncho / $destinoAlto > $relacionAspecto) {
            $destinoAncho = $destinoAlto * $relacionAspecto;
        } else {
            $destinoAlto = $destinoAncho / $relacionAspecto;
        }

        $x = ($ancho - $destinoAncho) / 2;
        $y = ($alto - $destinoAlto) / 2;

        imagecopyresampled($miniatura, $imagen, $x, $y, 0, 0, $destinoAncho, $destinoAlto, $origenAncho, $origenAlto);
        return imagejpeg($miniatura, $rutaMiniatura);
    }

    /**
     * Rotar una imagen en sentido horario.
     *
     * @param string $rutaImagen Ruta de la imagen a rotar.
     * @param int $grados Grados de rotación (90, 180, 270).
     *
     * @return bool Devuelve true si se rotó la imagen correctamente, false en caso contrario.
     */
    public function Rotar_Imagen($rutaImagen, $grados)
    {
        $imagen       = imagecreatefromjpeg($rutaImagen);
        $imagenRotada = imagerotate($imagen, $grados, 0);
        return imagejpeg($imagenRotada, $rutaImagen);
    }

    /**
     * Agregar marca de agua a una imagen.
     *
     * @param string $rutaImagen Ruta de la imagen a la que se agregará la marca de agua.
     * @param string $rutaMarcaAgua Ruta de la imagen de la marca de agua.
     * @param int $posicionX Posición horizontal de la marca de agua.
     * @param int $posicionY Posición vertical de la marca de agua.
     *
     * @return bool Devuelve true si se agregó la marca de agua correctamente, false en caso contrario.
     */
    public function Agregar_Marca_Agua($rutaImagen, $rutaMarcaAgua, $posicionX, $posicionY)
    {
        $imagen    = imagecreatefromjpeg($rutaImagen);
        $marcaAgua = imagecreatefrompng($rutaMarcaAgua);
        imagecopy($imagen, $marcaAgua, $posicionX, $posicionY, 0, 0, imagesx($marcaAgua), imagesy($marcaAgua));
        return imagejpeg($imagen, $rutaImagen);
    }

    /**
     * Combinar dos imágenes en una sola.
     *
     * @param string $rutaImagen1 Ruta de la primera imagen.
     * @param string $rutaImagen2 Ruta de la segunda imagen.
     * @param string $rutaImagenCombinada Ruta donde se guardará la imagen combinada.
     *
     * @return bool Devuelve true si se combinaron las imágenes correctamente, false en caso contrario.
     */
    public function Combinar_Imagenes($rutaImagen1, $rutaImagen2, $rutaImagenCombinada)
    {
        $imagen1         = imagecreatefromjpeg($rutaImagen1);
        $imagen2         = imagecreatefromjpeg($rutaImagen2);
        $ancho1          = imagesx($imagen1);
        $alto1           = imagesy($imagen1);
        $ancho2          = imagesx($imagen2);
        $alto2           = imagesy($imagen2);
        $imagenCombinada = imagecreatetruecolor($ancho1 + $ancho2, max($alto1, $alto2));
        imagecopy($imagenCombinada, $imagen1, 0, 0, 0, 0, $ancho1, $alto1);
        imagecopy($imagenCombinada, $imagen2, $ancho1, 0, 0, 0, $ancho2, $alto2);
        return imagejpeg($imagenCombinada, $rutaImagenCombinada);
    }

    /**
     * Generar una imagen en blanco.
     *
     * @param int $ancho Ancho de la imagen en blanco.
     * @param int $alto Alto de la imagen en blanco.
     * @param string $rutaImagen Ruta donde se guardará la imagen en blanco.
     *
     * @return bool Devuelve true si se generó la imagen en blanco correctamente, false en caso contrario.
     */
    public function Generar_Imagen_Blanco($ancho, $alto, $rutaImagen)
    {
        $imagen      = imagecreatetruecolor($ancho, $alto);
        $fondoBlanco = imagecolorallocate($imagen, 255, 255, 255);
        imagefill($imagen, 0, 0, $fondoBlanco);
        return imagejpeg($imagen, $rutaImagen);
    }
}

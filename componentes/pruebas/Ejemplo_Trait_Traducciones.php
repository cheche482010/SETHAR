<?php

class Ejemplo_Trait_Traducciones
{
    use Traducciones;

    public function __construct()
    {
        // Aquí va la lógica de inicialización de la clase
    }

    public function ejemploCargarTextos()
    {
        $rutaArchivo = "ruta/del/archivo.json";

        $this->Cargar_Textos($rutaArchivo);
        echo "Textos cargados correctamente";
    }

    public function ejemploObtenerTexto()
    {
        $clave = "saludo";
        $idioma = "es";

        $texto = $this->Obtener_Texto($clave, $idioma);
        echo "Texto obtenido: " . $texto;
    }

    public function ejemploEstablecerIdiomaDefecto()
    {
        $idioma = "en";

        $this->Establecer_Idioma_Defecto($idioma);
        echo "Idioma por defecto establecido: " . $idioma;
    }

    public function ejemploAgregarIdioma()
    {
        $idioma = "fr";
        $traducciones = [
            "saludo" => "Bonjour",
            "despedida" => "Au revoir"
        ];

        $this->Agregar_Idioma($idioma, $traducciones);
        echo "Idioma agregado correctamente: " . $idioma;
    }

    public function ejemploEliminarIdioma()
    {
        $idioma = "fr";

        $this->Eliminar_Idioma($idioma);
        echo "Idioma eliminado correctamente: " . $idioma;
    }

    public function ejemploActualizarTraduccion()
    {
        $idioma = "es";
        $clave = "saludo";
        $traduccion = "Hola";

        $this->Actualizar_Traduccion($idioma, $clave, $traduccion);
        echo "Traducción actualizada correctamente";
    }

    public function ejemploObtenerIdiomasDisponibles()
    {
        $idiomas = $this->Obtener_Idiomas_Disponibles();
        echo "Idiomas disponibles: " . implode(", ", $idiomas);
    }

    public function ejemploObtenerTodasTraducciones()
    {
        $traducciones = $this->Obtener_Todas_Traducciones();
        echo "Todas las traducciones: " . print_r($traducciones, true);
    }

    public function ejemploContarTraducciones()
    {
        $idioma = "es";

        $cantidadTraducciones = $this->Contar_Traducciones($idioma);
        echo "Cantidad de traducciones en el idioma " . $idioma . ": " . $cantidadTraducciones;
    }

    public function ejemploObtenerTraduccionDefecto()
    {
        $clave = "despedida";
        $idioma = "fr";

        $traduccionDefecto = $this->Obtener_Traduccion_Defecto($clave, $idioma);
        echo "Traducción por defecto: " . $traduccionDefecto;
    }
}

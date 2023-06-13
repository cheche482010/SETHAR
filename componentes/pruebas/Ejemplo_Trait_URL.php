<?php

class Ejemplo_Trait_URL
{
    use URL;

    public function __construct()
    {
        // Aquí va la lógica de inicialización de la clase
    }

    public function ejemploGenerarURL()
    {
        $texto = "Texto de ejemplo para URL";

        $url = $this->Generar_URL($texto);
        echo "URL amigable generada: " . $url;
    }

    public function ejemploObtenerTextoURL()
    {
        $url = "texto-de-ejemplo-para-url";

        $texto = $this->Obtener_Texto_URL($url);
        echo "Texto original obtenido: " . $texto;
    }

    public function ejemploBaseURL()
    {
        $baseURL = $this->Base_URL();
        echo "URL base de la aplicación: " . $baseURL;
    }

    public function ejemploLimpiarTextoURL()
    {
        $texto = "Texto con caracteres especiales y espacios";

        $textoLimpio = $this->Limpiar_Texto_URL($texto);
        echo "Texto limpio para generar URL amigable: " . $textoLimpio;
    }

    public function ejemploGenerarSlug()
    {
        $texto = "Texto con espacios para generar slug";

        $slug = $this->Generar_Slug($texto);
        echo "Slug generado: " . $slug;
    }

    public function ejemploObtenerParametrosURL()
    {
        $url = "/parametro1/parametro2/parametro3";

        $parametros = $this->Obtener_Parametros_URL($url);
        echo "Parámetros obtenidos de la URL amigable: " . implode(", ", $parametros);
    }

    public function ejemploValidarURL()
    {
        $url = "url-amigable-valida";

        if ($this->Validar_URL($url)) {
            echo "La URL amigable es válida";
        } else {
            echo "La URL amigable no es válida";
        }
    }
}


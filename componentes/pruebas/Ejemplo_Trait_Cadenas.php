<?php

use Componentes\Funciones\Cadenas;

class Ejemplo_Trait_Cadenas
{
    use Cadenas;

    /**
     * Ejemplo de recorte de una cadena de texto.
     */
    public function ejemploRecortarCadena()
    {
        $cadena = "Lorem ipsum dolor sit amet";
        $longitud = 10;
        $cadenaRecortada = $this->Recortar_Cadena($cadena, $longitud);

        echo "Cadena recortada: $cadenaRecortada";
    }

    /**
     * Ejemplo de división de una cadena de texto.
     */
    public function ejemploDividirCadena()
    {
        $cadena = "Lorem ipsum dolor sit amet";
        $delimitador = " ";
        $arrayDividido = $this->Dividir_Cadena($cadena, $delimitador);

        echo "Array dividido:\n";
        $this->Imprimir_Array($arrayDividido);
    }

    /**
     * Ejemplo de reemplazo de una cadena de texto.
     */
    public function ejemploReemplazarCadena()
    {
        $cadena = "Lorem ipsum dolor sit amet";
        $buscar = "Lorem";
        $reemplazar = "Hello";
        $cadenaReemplazada = $this->Reemplazar_Cadena($cadena, $buscar, $reemplazar);

        echo "Cadena resultante: $cadenaReemplazada";
    }

    /**
     * Ejemplo de conversión a mayúsculas.
     */
    public function ejemploConvertirMayusculas()
    {
        $cadena = "Lorem ipsum dolor sit amet";
        $cadenaMayusculas = $this->Convertir_Mayusculas($cadena);

        echo "Cadena en mayúsculas: $cadenaMayusculas";
    }

    /**
     * Ejemplo de conversión a minúsculas.
     */
    public function ejemploConvertirMinusculas()
    {
        $cadena = "LOREM IPSUM DOLOR SIT AMET";
        $cadenaMinusculas = $this->Convertir_Minusculas($cadena);

        echo "Cadena en minúsculas: $cadenaMinusculas";
    }

    /**
     * Ejemplo de obtención de la longitud de una cadena.
     */
    public function ejemploObtenerLongitudCadena()
    {
        $cadena = "Lorem ipsum dolor sit amet";
        $longitud = $this->Obtener_Longitud_Cadena($cadena);

        echo "Longitud de la cadena: $longitud";
    }

    /**
     * Ejemplo de inversión de una cadena de texto.
     */
    public function ejemploInvertirCadena()
    {
        $cadena = "Lorem ipsum dolor sit amet";
        $cadenaInvertida = $this->Invertir_Cadena($cadena);

        echo "Cadena invertida: $cadenaInvertida";
    }

    /**
     * Ejemplo de remoción de espacios extras en una cadena de texto.
     */
    public function ejemploRemoverEspaciosExtra()
    {
        $cadena = "    Lorem    ipsum    dolor   sit   amet   ";
        $cadenaLimpia = $this->Remover_Espacios_Extra($cadena);

        echo "Cadena con espacios extras removidos: $cadenaLimpia";
    }
}

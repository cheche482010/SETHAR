<?php

namespace Componentes\Funciones;

trait Cadenas
{
    /**
     * Recorta una cadena de texto a una longitud determinada.
     *
     * @param string $cadena La cadena de texto a recortar.
     * @param int $longitud La longitud deseada para la cadena recortada.
     * @return string La cadena recortada.
     */
    public function Recortar_Cadena(string $cadena, int $longitud): string
    {
        return substr($cadena, 0, $longitud);
    }

    /**
     * Divide una cadena de texto en un arreglo utilizando un delimitador.
     *
     * @param string $cadena La cadena de texto a dividir.
     * @param string $delimitador El delimitador utilizado para separar la cadena.
     * @return array El arreglo resultante de la división de la cadena.
     */
    public function Dividir_Cadena(string $cadena, string $delimitador): array
    {
        return explode($delimitador, $cadena);
    }

    /**
     * Reemplaza todas las ocurrencias de una cadena de texto por otra en una cadena dada.
     *
     * @param string $cadena La cadena de texto en la que se realizará el reemplazo.
     * @param string $buscar La cadena a buscar.
     * @param string $reemplazar La cadena que reemplazará a la cadena buscada.
     * @return string La cadena resultante después del reemplazo.
     */
    public function Reemplazar_Cadena(string $cadena, string $buscar, string $reemplazar): string
    {
        return str_replace($buscar, $reemplazar, $cadena);
    }

    /**
     * Convierte una cadena de texto a mayúsculas.
     *
     * @param string $cadena La cadena de texto a convertir.
     * @return string La cadena convertida a mayúsculas.
     */
    public function Convertir_Mayusculas(string $cadena): string
    {
        return strtoupper($cadena);
    }

    /**
     * Convierte una cadena de texto a minúsculas.
     *
     * @param string $cadena La cadena de texto a convertir.
     * @return string La cadena convertida a minúsculas.
     */
    public function Convertir_Minusculas(string $cadena): string
    {
        return strtolower($cadena);
    }

    /**
     * Obtiene la longitud de una cadena de texto.
     *
     * @param string $cadena La cadena de texto de la cual se obtendrá la longitud.
     * @return int La longitud de la cadena.
     */
    public function Obtener_Longitud_Cadena(string $cadena): int
    {
        return strlen($cadena);
    }

    /**
     * Invierte el orden de los caracteres en una cadena de texto.
     *
     * @param string $cadena La cadena de texto a invertir.
     * @return string La cadena invertida.
     */
    public function Invertir_Cadena(string $cadena): string
    {
        return strrev($cadena);
    }

    /**
     * Remueve los espacios extras en una cadena de texto, dejando solo un espacio entre las palabras.
     *
     * @param string $cadena La cadena de texto a modificar.
     * @return string La cadena con los espacios extras removidos.
     */
    public function Remover_Espacios_Extra(string $cadena): string
    {
        return trim(preg_replace('/\s+/', ' ', $cadena));
    }
}

<?php

trait Arrays
{
    /**
     * Ordena un array de forma ascendente.
     *
     * @param array $array El array a ordenar.
     * @return array El array ordenado de forma ascendente.
     */
    public function Ordenar_Ascendente(array $array): array
    {
        sort($array);
        return $array;
    }

    /**
     * Ordena un array de forma descendente.
     *
     * @param array $array El array a ordenar.
     * @return array El array ordenado de forma descendente.
     */
    public function Ordenar_Descendente(array $array): array
    {
        rsort($array);
        return $array;
    }

    /**
     * Busca un valor en un array y devuelve su índice si se encuentra.
     *
     * @param array $array El array en el que se realizará la búsqueda.
     * @param mixed $valor El valor a buscar.
     * @return int|false El índice del valor si se encuentra, o false si no se encuentra.
     */
    public function Buscar_Valor(array $array, $valor)
    {
        return array_search($valor, $array);
    }

    /**
     * Filtra un array utilizando una función de callback.
     *
     * @param array $array El array a filtrar.
     * @param callable $callback La función de callback que define el criterio de filtrado.
     * @return array El array filtrado.
     */
    public function Filtrar_Array(array $array, callable $callback): array
    {
        return array_filter($array, $callback);
    }

    /**
     * Retorna un nuevo array con los valores únicos de un array dado.
     *
     * @param array $array El array del cual se obtendrán los valores únicos.
     * @return array El array con los valores únicos.
     */
    public function Valores_Unicos(array $array): array
    {
        return array_unique($array);
    }

    /**
     * Combina dos arrays en uno solo.
     *
     * @param array $array1 El primer array.
     * @param array $array2 El segundo array.
     * @return array El array combinado.
     */
    public function Combinar_Arrays(array $array1, array $array2): array
    {
        return array_merge($array1, $array2);
    }

    /**
     * Retorna la suma de todos los valores numéricos de un array.
     *
     * @param array $array El array del cual se obtendrá la suma.
     * @return float|int La suma de los valores numéricos.
     */
    public function Sumar_Valores(array $array)
    {
        return array_sum($array);
    }

    /**
     * Imprime un array de forma legible.
     *
     * @param array $array El array a imprimir.
     */
    public function Imprimir_Array(array $array): void
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    /**
     * Convierte un array en formato JSON y lo imprime.
     *
     * @param array $array El array a convertir y escribir en formato JSON.
     * @param int $opciones Opciones adicionales para json_encode.
     */
    public function Escribir_JSON(array $array, $opciones = JSON_UNESCAPED_UNICODE)
    {
        echo json_encode($array, $opciones);
    }
}

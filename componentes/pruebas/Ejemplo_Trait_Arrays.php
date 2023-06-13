<?php

use Componentes\Funciones\Arrays;

class Ejemplo_Trait_Arrays
{
    use Arrays;

    /**
     * Ejemplo de ordenamiento ascendente de un array.
     */
    public function ejemploOrdenarAscendente()
    {
        $array = [5, 2, 8, 1, 3];
        $arrayOrdenado = $this->Ordenar_Ascendente($array);

        echo "Array ordenado de forma ascendente:\n";
        $this->Imprimir_Array($arrayOrdenado);
    }

    /**
     * Ejemplo de ordenamiento descendente de un array.
     */
    public function ejemploOrdenarDescendente()
    {
        $array = [5, 2, 8, 1, 3];
        $arrayOrdenado = $this->Ordenar_Descendente($array);

        echo "Array ordenado de forma descendente:\n";
        $this->Imprimir_Array($arrayOrdenado);
    }

    /**
     * Ejemplo de búsqueda de un valor en un array.
     */
    public function ejemploBuscarValor()
    {
        $array = [5, 2, 8, 1, 3];
        $valor = 8;
        $indice = $this->Buscar_Valor($array, $valor);

        if ($indice !== false) {
            echo "El valor $valor se encuentra en el índice $indice del array.";
        } else {
            echo "El valor $valor no se encuentra en el array.";
        }
    }

    /**
     * Ejemplo de filtrado de un array.
     */
    public function ejemploFiltrarArray()
    {
        $array = [5, 2, 8, 1, 3];
        $arrayFiltrado = $this->Filtrar_Array($array, function ($valor) {
            return $valor > 3;
        });

        echo "Array filtrado:\n";
        $this->Imprimir_Array($arrayFiltrado);
    }

    /**
     * Ejemplo de obtención de valores únicos de un array.
     */
    public function ejemploValoresUnicos()
    {
        $array = [5, 2, 8, 2, 3, 5];
        $valoresUnicos = $this->Valores_Unicos($array);

        echo "Valores únicos del array:\n";
        $this->Imprimir_Array($valoresUnicos);
    }

    /**
     * Ejemplo de combinación de dos arrays.
     */
    public function ejemploCombinarArrays()
    {
        $array1 = [1, 2, 3];
        $array2 = [4, 5, 6];
        $arrayCombinado = $this->Combinar_Arrays($array1, $array2);

        echo "Array combinado:\n";
        $this->Imprimir_Array($arrayCombinado);
    }

    /**
     * Ejemplo de suma de valores numéricos de un array.
     */
    public function ejemploSumarValores()
    {
        $array = [1, 2, 3, 4, 5];
        $suma = $this->Sumar_Valores($array);

        echo "Suma de los valores del array: $suma";
    }

    /**
     * Ejemplo de impresión de un array de forma legible.
     */
    public function ejemploImprimirArray()
    {
        $array = [1, 2, 3, 4, 5];

        echo "Array:\n";
        $this->Imprimir_Array($array);
    }

    /**
     * Ejemplo de escritura de un array en formato JSON.
     */
    public function ejemploEscribirJSON()
    {
        $array = ['nombre' => 'Juan', 'edad' => 25, 'ciudad' => 'Barcelona'];

        echo "Array en formato JSON:\n";
        $this->Escribir_JSON($array);
    }
}

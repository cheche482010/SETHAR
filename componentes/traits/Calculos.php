<?php

namespace Componentes\Funciones;

trait Calculos
{
    /**
     * Realiza la suma de dos números.
     *
     * @param mixed $num1 Primer número.
     * @param mixed $num2 Segundo número.
     * @return mixed Resultado de la suma.
     */
    public function sumar($num1, $num2)
    {
        return $num1 + $num2;
    }

    /**
     * Realiza la resta de dos números.
     *
     * @param mixed $num1 Primer número.
     * @param mixed $num2 Segundo número.
     * @return mixed Resultado de la resta.
     */
    public function restar($num1, $num2)
    {
        return $num1 - $num2;
    }

    /**
     * Realiza la multiplicación de dos números.
     *
     * @param mixed $num1 Primer número.
     * @param mixed $num2 Segundo número.
     * @return mixed Resultado de la multiplicación.
     */
    public function multiplicar($num1, $num2)
    {
        return $num1 * $num2;
    }

    /**
     * Realiza la división de dos números.
     *
     * @param mixed $num1 Numerador.
     * @param mixed $num2 Denominador.
     * @return mixed Resultado de la división o falso si el denominador es cero.
     */
    public function dividir($num1, $num2)
    {
        return $num2 != 0 ? $num1 / $num2 : false;
    }

    /**
     * Calcula el promedio de un arreglo de números.
     *
     * @param array $nums Arreglo de números.
     * @return mixed Promedio de los números o falso si el arreglo está vacío.
     */
    public function calcularPromedio($nums)
    {
        $total = count($nums);
        return $total > 0 ? array_sum($nums) / $total : false;
    }

    /**
     * Calcula el valor mínimo de un arreglo de números.
     *
     * @param array $nums Arreglo de números.
     * @return mixed Valor mínimo o falso si el arreglo está vacío.
     */
    public function calcularMinimo($nums)
    {
        return !empty($nums) ? min($nums) : false;
    }

    /**
     * Calcula el valor máximo de un arreglo de números.
     *
     * @param array $nums Arreglo de números.
     * @return mixed Valor máximo o falso si el arreglo está vacío.
     */
    public function calcularMaximo($nums)
    {
        return !empty($nums) ? max($nums) : false;
    }

    /**
     * Calcula el factorial de un número.
     *
     * @param int $num Número para calcular el factorial.
     * @return mixed Factorial del número o falso si el número es negativo.
     */
    public function calcularFactorial($num)
    {
        return $num >= 0 ? ($num == 0 ? 1 : $num * $this->calcularFactorial($num - 1)) : false;
    }

    /**
     * Calcula la potencia de un número.
     *
     * @param mixed $base Base de la potencia.
     * @param mixed $exponente Exponente de la potencia.
     * @return mixed Resultado de la potencia.
     */
    public function calcularPotencia($base, $exponente)
    {
        return pow($base, $exponente);
    }

    /**
     * Calcula la raíz cuadrada de un número.
     *
     * @param mixed $num Número para calcular la raíz cuadrada.
     * @return mixed Raíz cuadrada del número o falso si el número es negativo.
     */
    public function calcularRaizCuadrada($num)
    {
        return $num >= 0 ? sqrt($num) : false;
    }

    /**
     * Calcula la media de un arreglo de números.
     *
     * @param array $nums Arreglo de números.
     * @return mixed Media de los números o falso si el arreglo está vacío.
     */
    public function calcularMedia($nums)
    {
        $total = count($nums);
        return $total > 0 ? array_sum($nums) / $total : false;
    }

    /**
     * Calcula la mediana de un arreglo de números.
     *
     * @param array $nums Arreglo de números.
     * @return mixed Mediana de los números.
     */
    public function calcularMediana($nums)
    {
        sort($nums);
        $total  = count($nums);
        $middle = (int) floor($total / 2);

        if ($total % 2 == 0) {
            return ($nums[$middle - 1] + $nums[$middle]) / 2;
        } else {
            return $nums[$middle];
        }
    }

    /**
     * Calcula la moda de un arreglo de números.
     *
     * @param array $nums Arreglo de números.
     * @return array Moda de los números.
     */
    public function calcularModa($nums)
    {
        $frequencies  = array_count_values($nums);
        $maxFrequency = max($frequencies);
        $modes        = [];

        foreach ($frequencies as $num => $frequency) {
            if ($frequency == $maxFrequency) {
                $modes[] = $num;
            }
        }

        return $modes;
    }

    /**
     * Calcula la probabilidad de un evento.
     *
     * @param mixed $evento Evento.
     * @param mixed $espacioMuestral Espacio muestral.
     * @return mixed Probabilidad del evento o falso si el espacio muestral es cero.
     */
    public function calcularProbabilidad($evento, $espacioMuestral)
    {
        return $espacioMuestral != 0 ? $evento / $espacioMuestral : false;
    }

    /**
     * Calcula el mínimo común múltiplo (MCM) de dos números.
     *
     * @param int $num1 Primer número.
     * @param int $num2 Segundo número.
     * @return int MCM de los números.
     */
    public function calcularMCM($num1, $num2)
    {
        if ($num1 == 0 || $num2 == 0) {
            return 0;
        } else {
            $absNum1 = abs($num1);
            $absNum2 = abs($num2);
            $max     = max($absNum1, $absNum2);
            $min     = min($absNum1, $absNum2);
            $mcm     = $max;

            while ($mcm % $min != 0) {
                $mcm += $max;
            }

            return $mcm;
        }
    }

    /**
     * Calcula el máximo común divisor (MCD) de dos números.
     *
     * @param int $num1 Primer número.
     * @param int $num2 Segundo número.
     * @return int MCD de los números.
     */
    public function calcularMCD($num1, $num2)
    {
        if ($num1 == 0 || $num2 == 0) {
            return 0;
        } else {
            $absNum1   = abs($num1);
            $absNum2   = abs($num2);
            $max       = max($absNum1, $absNum2);
            $min       = min($absNum1, $absNum2);
            $remainder = $max % $min;

            while ($remainder != 0) {
                $max       = $min;
                $min       = $remainder;
                $remainder = $max % $min;
            }

            return $min;
        }
    }
}

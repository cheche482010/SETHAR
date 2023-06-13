<?php

use Componentes\Funciones\Calculos;

class Ejemplo_Trait_Calculos
{
    use Calculos;

    /**
     * Ejemplo de suma de dos números.
     */
    public function ejemploSuma()
    {
        $num1 = 10;
        $num2 = 5;
        $suma = $this->sumar($num1, $num2);

        echo "La suma de $num1 y $num2 es: $suma";
    }

    /**
     * Ejemplo de resta de dos números.
     */
    public function ejemploResta()
    {
        $num1 = 10;
        $num2 = 5;
        $resta = $this->restar($num1, $num2);

        echo "La resta de $num1 y $num2 es: $resta";
    }

    /**
     * Ejemplo de multiplicación de dos números.
     */
    public function ejemploMultiplicacion()
    {
        $num1 = 10;
        $num2 = 5;
        $multiplicacion = $this->multiplicar($num1, $num2);

        echo "La multiplicación de $num1 y $num2 es: $multiplicacion";
    }

    /**
     * Ejemplo de división de dos números.
     */
    public function ejemploDivision()
    {
        $num1 = 10;
        $num2 = 5;
        $division = $this->dividir($num1, $num2);

        echo "La división de $num1 y $num2 es: $division";
    }

    /**
     * Ejemplo de cálculo del promedio de un arreglo de números.
     */
    public function ejemploPromedio()
    {
        $nums = [5, 10, 15, 20];
        $promedio = $this->calcularPromedio($nums);

        echo "El promedio de los números es: $promedio";
    }

    /**
     * Ejemplo de cálculo del valor mínimo de un arreglo de números.
     */
    public function ejemploMinimo()
    {
        $nums = [5, 10, 15, 20];
        $minimo = $this->calcularMinimo($nums);

        echo "El valor mínimo de los números es: $minimo";
    }

    /**
     * Ejemplo de cálculo del valor máximo de un arreglo de números.
     */
    public function ejemploMaximo()
    {
        $nums = [5, 10, 15, 20];
        $maximo = $this->calcularMaximo($nums);

        echo "El valor máximo de los números es: $maximo";
    }

    /**
     * Ejemplo de cálculo del factorial de un número.
     */
    public function ejemploFactorial()
    {
        $num = 5;
        $factorial = $this->calcularFactorial($num);

        echo "El factorial de $num es: $factorial";
    }

    /**
     * Ejemplo de cálculo de la potencia de un número.
     */
    public function ejemploPotencia()
    {
        $base = 2;
        $exponente = 3;
        $potencia = $this->calcularPotencia($base, $exponente);

        echo "$base elevado a la $exponente es: $potencia";
    }

    /**
     * Ejemplo de cálculo de la raíz cuadrada de un número.
     */
    public function ejemploRaizCuadrada()
    {
        $num = 16;
        $raiz = $this->calcularRaizCuadrada($num);

        echo "La raíz cuadrada de $num es: $raiz";
    }

    /**
     * Ejemplo de cálculo de la media de un arreglo de números.
     */
    public function ejemploMedia()
    {
        $nums = [5, 10, 15, 20];
        $media = $this->calcularMedia($nums);

        echo "La media de los números es: $media";
    }

    /**
     * Ejemplo de cálculo de la mediana de un arreglo de números.
     */
    public function ejemploMediana()
    {
        $nums = [5, 10, 15, 20];
        $mediana = $this->calcularMediana($nums);

        echo "La mediana de los números es: $mediana";
    }

    /**
     * Ejemplo de cálculo de la moda de un arreglo de números.
     */
    public function ejemploModa()
    {
        $nums = [5, 10, 15, 10, 20, 15, 15];
        $moda = $this->calcularModa($nums);

        echo "La moda de los números es: " . implode(", ", $moda);
    }

    /**
     * Ejemplo de cálculo de la probabilidad de un evento.
     */
    public function ejemploProbabilidad()
    {
        $evento = 2;
        $espacioMuestral = 5;
        $probabilidad = $this->calcularProbabilidad($evento, $espacioMuestral);

        echo "La probabilidad del evento es: $probabilidad";
    }

    /**
     * Ejemplo de cálculo del mínimo común múltiplo (MCM) de dos números.
     */
    public function ejemploMCM()
    {
        $num1 = 12;
        $num2 = 18;
        $mcm = $this->calcularMCM($num1, $num2);

        echo "El MCM de $num1 y $num2 es: $mcm";
    }

    /**
     * Ejemplo de cálculo del máximo común divisor (MCD) de dos números.
     */
    public function ejemploMCD()
    {
        $num1 = 12;
        $num2 = 18;
        $mcd = $this->calcularMCD($num1, $num2);

        echo "El MCD de $num1 y $num2 es: $mcd";
    }
}

<?php

class Ejemplo_Transacciones
{
    public function ejemploUsoTransacciones(): void
    {
        // Conexión a la base de datos utilizando PDO
        $dsn = 'mysql:host=localhost;dbname=nombre_base_datos;charset=utf8';
        $usuario = 'usuario';
        $contraseña = 'contraseña';
        $pdo = new PDO($dsn, $usuario, $contraseña);

        // Creación del objeto Transacciones
        $transacciones = new Transacciones($pdo, true);

        try {
            // Comenzar la transacción
            $transacciones->Comenzar();

            // Realizar operaciones dentro de la transacción
            $this->realizarOperaciones();

            // Confirmar la transacción si todo fue exitoso
            $transacciones->Confirmar();

            echo 'Transacción completada con éxito';
        } catch (Exception $e) {
            // Revertir la transacción si ocurre algún error
            $transacciones->Revertir();

            echo 'Ocurrió un error durante la transacción: ' . $e->getMessage();
        }

        // Finalizar la transacción
        $transacciones->Finalizar();
    }

    private function realizarOperaciones(): void
    {
        // Realizar operaciones dentro de la transacción
        // ...
    }
}

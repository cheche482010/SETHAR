<?php

class Ejemplo_Trait_PDO
{
    use PDO;

    // Aquí van las propiedades y métodos específicos de la clase ClaseEjemplo

    public function __construct()
    {
        // Aquí va la lógica de inicialización de la clase
    }

    // Ejemplos de uso de las funciones del trait PDO

    public function ejemploEjecutarConsultaPreparada()
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $parametros = [
            'id' => 1,
        ];

        $stmt = $this->Ejecutar_Consulta_Preparada($sql, $parametros);

        // Realizar operaciones con el objeto $stmt
    }

    public function ejemploObtenerFilaPreparada()
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $parametros = [
            'id' => 1,
        ];

        $fila = $this->Obtener_Fila_Preparada($sql, $parametros);

        // Utilizar la fila obtenida
    }

    public function ejemploObtenerFilasPreparada()
    {
        $sql = "SELECT * FROM usuarios WHERE activo = :activo";
        $parametros = [
            'activo' => true,
        ];

        $filas = $this->Obtener_Filas_Preparada($sql, $parametros);

        // Utilizar el arreglo de filas obtenido
    }

    public function ejemploInsertarPreparada()
    {
        $tabla = "usuarios";
        $datos = [
            'nombre' => "John Doe",
            'email' => "johndoe@example.com",
            'activo' => true,
        ];

        $idInsertado = $this->Insertar_Preparada($tabla, $datos);

        // Utilizar el ID del último registro insertado
    }

    public function ejemploActualizarPreparada()
    {
        $tabla = "usuarios";
        $datos = [
            'nombre' => "John Doe",
            'email' => "johndoe@example.com",
            'activo' => false,
        ];
        $condicion = "id = :id";
        $parametros = [
            'id' => 1,
        ];

        $filasActualizadas = $this->Actualizar_Preparada($tabla, $datos, $condicion);

        // Obtener el número de filas afectadas por la actualización
    }

    public function ejemploEliminarPreparada()
    {
        $tabla = "usuarios";
        $condicion = "id = :id";
        $parametros = [
            'id' => 1,
        ];

        $filasEliminadas = $this->Eliminar_Preparada($tabla, $condicion);

        // Obtener el número de filas eliminadas
    }

    public function ejemploObtenerResultadoPreparada()
    {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE activo = :activo";
        $parametros = [
            'activo' => true,
        ];

        $resultado = $this->Obtener_Resultado_Preparada($sql, $parametros);

        // Utilizar el valor obtenido
    }

    public function ejemploContarRegistrosPreparada()
    {
        $tabla = "usuarios";
        $condicion = "activo = :activo";
        $parametros = [
            'activo' => true,
        ];

        $cantidadRegistros = $this->Contar_Registros_Preparada($tabla, $condicion, $parametros);

        // Obtener la cantidad de registros que cumplen la condición
    }

    public function ejemploEjecutarTransaccion()
    {
        $acciones = [
            function () {
                // Acción 1
            },
            function () {
                // Acción 2
            },
            // ...
        ];

        $exitoso = $this->Ejecutar_Transaccion($acciones);

        if ($exitoso) {
            // Transacción exitosa
        } else {
            // Transacción fallida
        }
    }

    public function ejemploObtenerUltimoIdInsertado()
    {
        $idInsertado = $this->Obtener_Ultimo_Id_Insertado();

        // Utilizar el ID del último registro insertado
    }

    public function ejemploObtenerMensajeError()
    {
        $mensajeError = $this->Obtener_Mensaje_Error();

        // Utilizar el mensaje de error obtenido
    }
}

<?php

namespace Componentes\Funciones;

trait PDO
{
    /**
     * Retorna el tipo de parámetro correspondiente al valor proporcionado.
     *
     * @param mixed $value Valor para determinar el tipo de parámetro.
     * @return mixed El tipo de parámetro correspondiente al valor.
     */
     *  /
    private function Tipo_Parametro($value): mixed
    {
        switch (gettype($value)) {
            case 'integer':
                return PDO::PARAM_INT;
            case 'boolean':
                return PDO::PARAM_BOOL;
            case 'NULL':
                return PDO::PARAM_NULL;
            case 'resource':
                return PDO::PARAM_LOB;
            case 'object':
                if ($value instanceof PDOStatement) {
                    return PDO::PARAM_STMT;
                }
            default:
                return PDO::PARAM_STR;
        }
    }

    /**
     * Retorna la configuración de PDO con las opciones deseadas.
     *
     * @return array La configuración de PDO.
     */
    private function Configuracion_PDO(): array
    {
        return [
            "Modo de error"               => PDO::ATTR_ERRMODE,
            "Modo de recuperacion"        => PDO::ATTR_DEFAULT_FETCH_MODE,
            "Persistente"                 => PDO::ATTR_PERSISTENT,
            "Emular preparaciones"        => PDO::ATTR_EMULATE_PREPARES,
            "Comando inicial MySQL"       => PDO::MYSQL_ATTR_INIT_COMMAND,
            "Modo de MAY/MIN"             => PDO::ATTR_CASE,
            "Conversion de NULL"          => PDO::ATTR_ORACLE_NULLS,
            "Convertir valores a cadenas" => PDO::ATTR_STRINGIFY_FETCHES,
            "Sentencia personalizada"     => PDO::ATTR_STATEMENT_CLASS,
            "Tiempo de espera"            => PDO::ATTR_TIMEOUT,
            "Autocommit"                  => PDO::ATTR_AUTOCOMMIT,
            "Emular preparaciones"        => PDO::ATTR_EMULATE_PREPARES,
            "Buffer"                      => PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,
        ];
    }

    /**
     * Ejecuta una consulta preparada con los parámetros proporcionados.
     *
     * @param string $sql Consulta SQL preparada.
     * @param array $parametros Parámetros para la consulta preparada.
     * @return PDOStatement El objeto PDOStatement resultante de la ejecución de la consulta.
     */
    public function Ejecutar_Consulta_Preparada(string $sql, array $parametros = []): PDOStatement
    {
        $stmt = $this->conexion->prepare($sql);
        foreach ($parametros as $parametro => $valor) {
            $tipo = $this->Tipo_Parametro($valor);
            $stmt->bindValue($parametro, $valor, $tipo);
        }
        $stmt->execute();
        return $stmt;
    }

    /**
     * Obtiene una fila de resultado de una consulta preparada con los parámetros proporcionados.
     *
     * @param string $sql Consulta SQL preparada.
     * @param array $parametros Parámetros para la consulta preparada.
     * @return array|false La fila de resultado obtenida, o false si no hay resultados.
     */
    public function Obtener_Fila_Preparada(string $sql, array $parametros = [])
    {
        $stmt = $this->Ejecutar_Consulta_Preparada($sql, $parametros);
        return $stmt->fetch();
    }

    /**
     * Obtiene todas las filas de resultado de una consulta preparada con los parámetros proporcionados.
     *
     * @param string $sql Consulta SQL preparada.
     * @param array $parametros Parámetros para la consulta preparada.
     * @return array El arreglo de filas de resultado obtenidas.
     */
    public function Obtener_Filas_Preparada(string $sql, array $parametros = []): array
    {
        $stmt = $this->Ejecutar_Consulta_Preparada($sql, $parametros);
        return $stmt->fetchAll();
    }

    /**
     * Inserta una fila en una tabla usando una consulta preparada con los datos proporcionados.
     *
     * @param string $tabla Nombre de la tabla en la que insertar los datos.
     * @param array $datos Datos a insertar en forma de arreglo asociativo (columna => valor).
     * @return string El ID de la última fila insertada.
     */
    public function Insertar_Preparada(string $tabla, array $datos): string
    {
        $campos  = implode(', ', array_keys($datos));
        $valores = ':' . implode(', :', array_keys($datos));
        $sql     = "INSERT INTO $tabla ($campos) VALUES ($valores)";
        $stmt    = $this->Ejecutar_Consulta_Preparada($sql, $datos);
        return $this->conexion->lastInsertId();
    }

    /**
     * Actualiza una o varias filas en una tabla usando una consulta preparada con los datos proporcionados y una condición opcional.
     *
     * @param string $tabla Nombre de la tabla a actualizar.
     * @param array $datos Datos a actualizar en forma de arreglo asociativo (columna => valor).
     * @param string $condicion Condición opcional para filtrar las filas a actualizar.
     * @return int El número de filas afectadas por la operación de actualización.
     */
    public function Actualizar_Preparada(string $tabla, array $datos, string $condicion = ''): int
    {
        $valores = '';
        foreach ($datos as $campo => $valor) {
            $valores .= "$campo = :$campo, ";
        }
        $valores = rtrim($valores, ', ');
        $sql     = "UPDATE $tabla SET $valores";
        if (!empty($condicion)) {
            $sql .= " WHERE $condicion";
        }
        $stmt = $this->Ejecutar_Consulta_Preparada($sql, $datos);
        return $stmt->rowCount();
    }

    /**
     * Elimina una o varias filas de una tabla usando una consulta preparada con una condición.
     *
     * @param string $tabla Nombre de la tabla en la que eliminar las filas.
     * @param string $condicion Condición para filtrar las filas a eliminar.
     * @return int El número de filas eliminadas.
     */
    public function Eliminar_Preparada(string $tabla, string $condicion): int
    {
        $sql  = "DELETE FROM $tabla WHERE $condicion";
        $stmt = $this->Ejecutar_Consulta_Preparada($sql);
        return $stmt->rowCount();
    }

    /**
     * Obtiene un valor de una columna específica de una fila de resultado de una consulta preparada con los parámetros proporcionados.
     *
     * @param string $sql Consulta SQL preparada.
     * @param array $parametros Parámetros para la consulta preparada.
     * @return mixed El valor de la columna obtenida, o false si no hay resultados.
     */
    public function Obtener_Resultado_Preparada(string $sql, array $parametros = [])
    {
        $stmt = $this->Ejecutar_Consulta_Preparada($sql, $parametros);
        return $stmt->fetchColumn();
    }

    /**
     * Cuenta el número de registros en una tabla, opcionalmente filtrados por una condición.
     *
     * @param string $tabla Nombre de la tabla a contar los registros.
     * @param string $condicion Condición opcional para filtrar los registros a contar.
     * @param array $parametros Parámetros para la consulta preparada.
     * @return int El número de registros que cumplen la condición.
     */
    public function Contar_Registros_Preparada(string $tabla, string $condicion = '', array $parametros = []): int
    {
        $sql = "SELECT COUNT(*) FROM $tabla";
        if (!empty($condicion)) {
            $sql .= " WHERE $condicion";
        }
        $stmt = $this->Ejecutar_Consulta_Preparada($sql, $parametros);
        return $stmt->fetchColumn();
    }

    /**
     * Ejecuta una transacción que consiste en ejecutar una serie de acciones SQL.
     *
     * @param array $acciones Arreglo de acciones SQL a ejecutar en la transacción.
     * @return bool True si la transacción se ejecuta correctamente, False en caso contrario.
     */
    public function Ejecutar_Transaccion(array $acciones): bool
    {
        try {
            $this->conexion->beginTransaction();
            foreach ($acciones as $accion) {
                $this->conexion->exec($accion);
            }
            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            $this->conexion->rollback();
            echo "Error al ejecutar la transacción: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Obtiene el ID del último registro insertado en la base de datos.
     *
     * @return string El ID del último registro insertado.
     */
    public function Obtener_Ultimo_Id_Insertado(): string
    {
        return $this->conexion->lastInsertId();
    }

    /**
     * Obtiene el mensaje de error asociado a la última operación en la base de datos.
     *
     * @return string El mensaje de error.
     */
    public function Obtener_Mensaje_Error(): string
    {
        return $this->conexion->errorInfo()[2];
    }
}

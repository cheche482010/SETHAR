<?php
require '../vendor/autoload.php';
require "../../app/Base_Datos.php";

/**
 *
 */

class Generador
{
    private $bd;

    public function __construct()
    {
        $this->bd = new BASE_DATOS();
    }

    public function Generar_Archivo($nombre_tabla, $tipo_archivo)
    {
        try {
            $pdo = $this->bd->conexion->prepare("DESCRIBE $nombre_tabla");
            $pdo->execute();
            $estructura_tabla = $pdo->fetchAll(PDO::FETCH_ASSOC);

            $codigo_entidad             = "<?php\n\n";
            $nombre_clase       = ucwords($nombre_tabla);
            $direccion_guardado = "";

            if ($tipo_archivo == 1) {
                $nombre_clase .= "_Entidad";
                $direccion_guardado = "../../modelo/entidades/";
            } elseif ($tipo_archivo == 2) {
                $nombre_clase .= "_Propiedad";
                $direccion_guardado = "../../controlador/propiedades/";
            } else {
                echo "Tipo de archivo no válido. Use '1' o '2'.";
                return;
            }

            $codigo_entidad .= "class " . $nombre_clase . "\n{\n";
            foreach ($estructura_tabla as $column) {
                $nombre_columna = $column['Field'];
                $codigo_entidad .= "\t/**\n";
                $codigo_entidad .= "\t * " . ucfirst($nombre_columna) . " de la entidad.\n";
                $codigo_entidad .= "\t * @var " . $this->Obtener_Tipo($column['Type']) . "|null\n";
                $codigo_entidad .= "\t */\n";
                $codigo_entidad .= "\tprivate $" . $nombre_columna . ";\n\n";
            }
            $codigo_entidad .= "\t//====================== Establecer Datos ======================\n\n";
            foreach ($estructura_tabla as $column) {
                $nombre_columna = $column['Field'];
                $codigo_entidad .= "\t/**\n";
                $codigo_entidad .= "\t * Establece el " . $nombre_columna . " de la entidad.\n";
                $codigo_entidad .= "\t *\n";
                $codigo_entidad .= "\t * @param " . $this->Obtener_Tipo($column['Type']) . " $" . $nombre_columna . " El " . $nombre_columna . " de la entidad.\n";
                $codigo_entidad .= "\t */\n";
                $codigo_entidad .= "\tpublic function set_" . ucwords($nombre_columna) . "($" . $nombre_columna . ")\n";
                $codigo_entidad .= "\t{\n";
                $codigo_entidad .= "\t\t$" . "this->$nombre_columna = $" . $nombre_columna . ";\n";
                $codigo_entidad .= "\t}\n\n";
            }
            $codigo_entidad .= "\t//====================== Obtener Datos ======================\n\n";
            foreach ($estructura_tabla as $column) {
                $nombre_columna = $column['Field'];
                $codigo_entidad .= "\t/**\n";
                $codigo_entidad .= "\t * Establece el " . $nombre_columna . " de la entidad.\n";
                $codigo_entidad .= "\t *\n";
                $codigo_entidad .= "\t * @param " . $this->Obtener_Tipo($column['Type']) . " $" . $nombre_columna . " El " . $nombre_columna . " de la entidad.\n";
                $codigo_entidad .= "\t */\n";
                $codigo_entidad .= "\tpublic function set_" . ucwords($nombre_columna) . "($" . $nombre_columna . ")\n";
                $codigo_entidad .= "\t{\n";
                $codigo_entidad .= "\t\t$" . "this->$nombre_columna = $" . $nombre_columna . ";\n";
                $codigo_entidad .= "\t}\n\n";
            }
            $codigo_entidad .= "}\n";

            $archivo = $direccion_guardado . ucwords($nombre_tabla) . ".php";
            file_put_contents($archivo, $codigo_entidad);

            echo "Archivo generado correctamente en la ubicación " . $archivo . "\n";

        } catch (PDOException $e) {
            if ($e->getCode() === '42S02') {
                echo "La tabla '$nombre_tabla' no existe en la base de datos. Por favor, verifique el nombre de la tabla.";
            } else {
                echo "Error al conectar a la base de datos: " . $e->getMessage();
            }
        }
    }
    // Función para obtener el tipo de dato PHP correspondiente al tipo de columna de la tabla
    private function Obtener_Tipo($tipo_columna)
    {
        $tipos = [
            'int'        => 'int',
            'tinyint'    => 'int',
            'smallint'   => 'int',
            'mediumint'  => 'int',
            'bigint'     => 'int',
            'float'      => 'float',
            'double'     => 'float',
            'decimal'    => 'float',
            'numeric'    => 'float',
            'real'       => 'float',
            'bit'        => 'bool',
            'boolean'    => 'bool',
            'varchar'    => 'string',
            'char'       => 'string',
            'text'       => 'string',
            'mediumtext' => 'string',
            'longtext'   => 'string',
            'date'       => '\DateTime',
            'datetime'   => '\DateTime',
            'timestamp'  => '\DateTime',
            'time'       => '\DateTime',
            'year'       => 'int',
            'enum'       => 'string',
            'set'        => 'string',
            'binary'     => 'string',
            'varbinary'  => 'string',
            'blob'       => 'string',
            'mediumblob' => 'string',
            'longblob'   => 'string',
            // Agrega aquí los demás tipos de datos según tu necesidad
        ];

        foreach ($tipos as $key => $value) {
            if (strpos($tipo_columna, $key) !== false) {
                return $value;
            }
        }

        return 'mixed';
    }
}

$tabla        = $argv[1];
$tipo_archivo = $argv[2];
$generador    = new Generador();
$generador->Generar_Archivo($tabla, $tipo_archivo);

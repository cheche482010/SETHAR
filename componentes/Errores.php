<?php

class Errores
{
    public function __construct()
    {
        set_error_handler(array($this, 'Manejo_Errores'));
        set_exception_handler(array($this, 'Manejo_Excepciones'));
        set_error_handler(array($this, 'Manejo_HTTP_Errores'));
    }

    public function Manejo_Errores($errno, $errstr, $errfile, $errline)
    {
        switch ($errno) {
            case E_USER_ERROR:
                $tipo_error = 'modelo';
                break;
            case E_USER_WARNING:
                $tipo_error = 'controlador';
                break;
            case E_USER_NOTICE:
                $tipo_error = 'sistema';
                break;
            case E_ERROR:
                $tipo_error = 'error';
                break;
            case E_WARNING:
                $tipo_error = 'advertencia';
                break;
            case E_NOTICE:
                $tipo_error = 'notificacion';
                break;
            case E_PARSE:
                $tipo_error = 'parseo';
                break;
            case E_DEPRECATED:
                $tipo_error = 'obsoleto';
                break;
            default:
                $tipo_error = 'general';
                break;
        }

        $log = "Fecha y Hora: " . date('[Y-m-d H:i:s]') . "\nError $errno: $errstr \nArchivo: $errfile \nLinea:$errline\n" .
            "\n=============================================================================================================\n";
        error_log($log, 3, "componentes/logs/" . $tipo_error . '.log');
        die($log);
    }

    public function Manejo_Excepciones($exception)
    {
        if ($exception instanceof PDOException) {
            $tipo_error = 'pdo';
        } else if ($exception instanceof Exception) {
            $tipo_error = 'exception';
        } else {
            $tipo_error = 'general';
        }
        $log = "Fecha y Hora: " . date('[Y-m-d H:i:s]') . " \nError: " . $exception->getMessage() . " \nArchivo: " . $exception->getFile() . "\nLinea:" . $exception->getLine() . "\nCodigo:" . $exception->getCode() . "\nTraza: " . $exception->getTraceAsString() .
            "\n=============================================================================================================\n";
        error_log($log, 3, "componentes/logs/excepciones.log");
        die($log);
    }

    public static function Personalizado($mensaje)
    {

        $log = "Fecha y Hora: " . date('[Y-m-d H:i:s]') . " \nError personalizado: $mensaje\n" .
            "\n=============================================================================================================\n";
        error_log($log, 3, "componentes/logs/personalizado.log");
        die($log);
    }

    public function Manejo_HTTP_Errores($exception)
    {
        $codigo_error = $exception->getCode();
        $log_mensaje = "Fecha y Hora: " . date('[Y-m-d H:i:s]'). " \nError: ".$exception->getMessage() . " en " . $exception->getFile() . " en línea " . $exception->getLine() .
            "\n=============================================================================================================\n";

        if ($codigo_error >= 400 && $codigo_error <= 499) {
            $log_archivo  = "componentes/logs/http_" . $codigo_error . ".log";
        } elseif ($codigo_error >= 500 && $codigo_error <= 599) {
            $log_archivo  = "componentes/logs/http_" . $codigo_error . ".log";
        } else {
            $log_archivo  = "componentes/logs/http.log";
        }

        error_log($log_mensaje, 3, $log_archivo);
        header("HTTP/1.1 $codigo_error Internal Server Error");
        die($log);
        exit();
    }

    public function Generar_Informe_Errores($fecha_inicio, $fecha_fin)
    {
        $tipo_error = 'general-completo';
        $log_archivo  = "componentes/logs/$tipo_error.log";

        $errores = array();

        if (file_exists($log_archivo)) {
            $log_contents = file_get_contents($log_archivo);

            preg_match_all('/Fecha y Hora: (.*)\nError (\d+): (.*) \nArchivo: (.*) \nLinea:(.*)/', $log_contents, $matches);

            $fechas   = $matches[1];
            $codigos  = $matches[2];
            $mensajes = $matches[3];
            $archivos = $matches[4];
            $lineas   = $matches[5];

            for ($i = 0; $i < count($fechas); $i++) {
                $fecha   = $fechas[$i];
                $codigo  = $codigos[$i];
                $mensaje = $mensajes[$i];
                $archivo = $archivos[$i];
                $linea   = $lineas[$i];

                if (strtotime($fecha) >= strtotime($fecha_inicio) && strtotime($fecha) <= strtotime($fecha_fin)) {
                    $errores[] = array(
                        'fecha'   => $fecha,
                        'codigo'  => $codigo,
                        'mensaje' => $mensaje,
                        'archivo' => $archivo,
                        'linea'   => $linea,
                    );
                }
            }

            if (!empty($errores)) {
                $nombre_archivo = "informe_errores_$fecha_inicio-$fecha_fin.csv";
                $direccion_archivo = "componentes/informes/$nombre_archivo";

                $da = fopen($direccion_archivo, 'w');

                fputcsv($da, array('Fecha', 'Código', 'Mensaje', 'Archivo', 'Línea'));

                foreach ($errores as $error) {
                    fputcsv($da, $error);
                }

                fclose($da);

                return $direccion_archivo;
            }
        }

        return false;
    }

    public static function Capturar()
    {
        return new self();
    }
}

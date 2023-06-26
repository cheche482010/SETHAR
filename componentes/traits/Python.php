<?php

trait Python
{
    // Método para ejecutar código Python
    public function Ejecutar_Py($ruta, $codigo)
    {
        $output = shell_exec($ruta . ' -c "' . $codigo . '"');
        return $output;
    }

    // Método para ejecutar un script Python
    public function Ejecutar_Script($ruta, $scriptPath, $args = [])
    {
        $command = $ruta . ' ' . $scriptPath;

        foreach ($args as $arg) {
            $command .= ' ' . escapeshellarg($arg);
        }

        $output = shell_exec($command);
        return $output;
    }

    // Método para instalar un paquete Python utilizando pip
    public function Instalar_Paquete($paquete)
    {
        $pythonPath = '/usr/bin/python'; // Ruta al ejecutable de Python
        $pipPath    = '/usr/bin/pip'; // Ruta al ejecutable de pip

        // Comando para instalar el paquete utilizando pip
        $command = $pythonPath . ' -m ' . $pipPath . ' install ' . escapeshellarg($paquete);

        // Ejecutar el comando y obtener la salida
        $output = shell_exec($command);

        // Retornar la salida del comando de instalación
        return $output;
    }

    // Método para obtener la versión de Python instalada
    public function Obtener_Version()
    {
        $pythonPath = '/usr/bin/python'; // Ruta al ejecutable de Python

        // Comando para obtener la versión de Python
        $command = $pythonPath . ' --version';

        // Ejecutar el comando y obtener la salida
        $output = shell_exec($command);

        // Retornar la versión de Python
        return $output;
    }

    // Método para obtener la salida de un comando Python
    public function Ejecutar_Comando($comando)
    {
        $pythonPath = '/usr/bin/python'; // Ruta al ejecutable de Python

        // Comando para ejecutar el comando Python
        $command = $pythonPath . ' -c ' . escapeshellarg($comando);

        // Ejecutar el comando y obtener la salida
        $output = shell_exec($command);

        // Retornar la salida del comando Python
        return $output;
    }

    // Método para procesar datos devueltos por Python
    public function ProcesarDatosPython($data)
    {
        // Procesar los datos devueltos por Python según tus necesidades
        $processedData = json_decode($data, true);

        // Realizar alguna manipulación o cálculo con los datos procesados
        if ($processedData['status'] === 'success') {
            $result = $processedData['result'];
            $average = array_sum($result) / count($result);
            $processedData['average'] = $average;
        }

        return $processedData;
    }

    
}

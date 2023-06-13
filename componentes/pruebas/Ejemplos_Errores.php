<?php

class Ejemplos_Errores
{
    public function ejemploManejoErrores(): void
    {
        $errores = new Errores();
        
        // Generar un error personalizado
        Errores::Personalizado('Este es un mensaje de error personalizado');
        
        // Generar un error de advertencia
        trigger_error('Esto es una advertencia', E_USER_WARNING);
        
        // Generar un error fatal
        trigger_error('Esto es un error fatal', E_USER_ERROR);
    }

    public function ejemploManejoExcepciones(): void
    {
        $errores = new Errores();
        
        try {
            // Código que puede generar una excepción
            throw new Exception('Este es un mensaje de excepción');
        } catch (Exception $e) {
            // Manejo de la excepción
            $errores->Manejo_Excepciones($e);
        }
    }

    public function ejemploManejoHTTPErrores(): void
    {
        $errores = new Errores();
        
        try {
            // Código que puede generar un error HTTP
            throw new Exception('Error 404: Página no encontrada', 404);
        } catch (Exception $e) {
            // Manejo del error HTTP
            $errores->Manejo_HTTP_Errores($e);
        }
    }

    public function ejemploGenerarInformeErrores(): void
    {
        $errores = new Errores();
        
        // Generar un informe de errores para un rango de fechas
        $informe = $errores->Generar_Informe_Errores('2023-01-01', '2023-12-31');
        
        if ($informe) {
            echo 'Informe de errores generado: ' . $informe;
        } else {
            echo 'No se encontraron errores en el rango de fechas especificado';
        }
    }

    public function ejemploCapturarErrores(): void
    {
        $errores = Errores::Capturar();
        
        // A partir de este punto, los errores serán capturados por la clase Errores
        // y se utilizarán los métodos de manejo correspondientes.
        
        // Código que puede generar errores
        // ...
    }
}

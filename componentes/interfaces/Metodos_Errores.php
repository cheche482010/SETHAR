<?php

namespace Componentes\Interfaces;

interface Metodos_Errores
{
    public function Manejo_Errores($errno, $errstr, $errfile, $errline);

    public function Manejo_Excepciones($exception);

    public static function Personalizado($mensaje);

    public function Manejo_HTTP_Errores($exception);

    public function Generar_Informe_Errores($fecha_inicio, $fecha_fin);

    public static function Capturar();
}

<?php

class Configuracion
{
    public static function Titulo()
    {
        echo "SETHAR";
    }

    public static function URL()
    {
        $protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
        $domain   = $_SERVER['HTTP_HOST'];
        $root     = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']) . "/";
        $url      = $protocol . $domain . $root;
        unset($protocol, $domain, $root);
        return $url;
    }

    public static function Recursos()
    {
        echo self::URL()."recursos/";
    }
 
    public static function Hora()
    {
        return date('h:i A');
    }

    public static function Dias()
    {
        return ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"];
    }

    public static function Meses()
    {
        return ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    }    
}

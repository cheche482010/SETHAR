<?php

// namespace App;

class Configuracion
{
    const TITULO = "SETHAR";
    
    const CREDENCIALES = [
        'Mysql' => [
            'Servidor'   => 'mysql',
            'Host'       => 'localhost',
            'Base_Datos' => 'sethar',
            'Puerto'     => '3306',
            'Usuario'    => 'root',
            'Contraseña' => 'root',
        ],
        'PostgreSQL' => [
            'Servidor'   => 'pgsql',
            'Host'       => 'localhost',
            'Base_Datos' => 'ejemplo',
            'Puerto'     => '5432',
            'Usuario'    => 'root',
            'Contraseña' => 'root',
        ],
        'SQLite' => [
            'Servidor'   => 'sqlite',
            'Base_Datos' => 'ruta/al/archivo.db',
        ],
        'SQLServer' => [
            'Servidor'   => 'sqlsrv',
            'Host'       => 'localhost',
            'Base_Datos' => 'ejemplo',
            'Puerto'     => '1433',
            'Usuario'    => 'sa',
            'Contraseña' => 'password',
        ],
        'Oracle' => [
            'Servidor'   => 'oci',
            'Host'       => 'localhost',
            'Base_Datos' => 'ejemplo',
            'Puerto'     => '1521',
            'Usuario'    => 'system',
            'Contraseña' => 'password',
        ],
        'MongoDB' => [
            'Servidor'   => 'mongodb',
            'Host'       => 'localhost',
            'Base_Datos' => 'ejemplo',
            'Puerto'     => '27017',
        ],
    ];

    public static function Titulo()
    {
        echo self::TITULO;
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
 
}

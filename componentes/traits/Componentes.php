<?php

trait Componentes
{
    protected function Conexion()
    {
        return [
            'Mysql' => array(
                'Servidor'   => 'mysql',
                'Host'       => 'localhost',
                'Base_Datos' => 'reino_plantae',
                'Puerto'     => '3306',
                'Usuario'    => 'root',
                'Contraseña' => 'root',
            )
        ];
    }
}

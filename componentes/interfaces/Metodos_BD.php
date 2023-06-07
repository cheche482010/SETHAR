<?php

namespace Componentes\Interfaces;

interface Metodos_BD
{
    public function Conectar();
    public function Iniciar_Conexion();
    public function Probar_Conexion();
    public function Error_Conexion();
}
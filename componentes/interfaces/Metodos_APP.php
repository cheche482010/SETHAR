<?php

namespace Componentes\Interfaces;

interface Metodos_APP
{
    public function Cargar_Controladores();
    public function Cargar_Funciones();
    public function Validar_Conexion();
    public function Iniciar_Ruteo();
    public function Validar_Archivos_Controlador();
}
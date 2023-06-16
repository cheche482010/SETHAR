<?php

namespace Componentes\Interfaces;

interface Metodos_Transacciones
{
    public function Comenzar();
    public function Confirmar();
    public function Verificar();
    public function Revertir();
    public function Finalizar($result);
}

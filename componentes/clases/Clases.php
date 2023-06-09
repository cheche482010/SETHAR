<?php

class Clases
{
    private $ReflectionClass;
    private $nombre_clase;

    public function __construct(string $nombre_clase)
    {
        $this->nombre_clase    = $nombre_clase;
        $this->ReflectionClass = new ReflectionClass($nombre_clase);
    }

    public function validar(): bool
    {
        return $this->ReflectionClass->isInstantiable();
    }

    public function nombre_clase(): string
    {
        return $this->ReflectionClass->getName();
    }

    public function archivo(): string
    {
        return $this->ReflectionClass->getFileName();
    }

    public function constantes(): array
    {
        return $this->ReflectionClass->getConstants();
    }

    public function propiedades(): array
    {
        return $this->ReflectionClass->getProperties();
    }

    public function funciones(): array
    {
        return $this->ReflectionClass->getMethods();
    }

    public function instanciar(): object
    {
        return $this->ReflectionClass->newInstance();
    }

    public function clase_padre():  ? string
    {
        $padre = $this->ReflectionClass->getParentClass();
        return $padre ? $padre->getName() : null;
    }

    public function traits() : array
    {
        return $this->ReflectionClass->getTraitNames();
    }

    public function verificar_funcion(string $nombre_funcion): bool
    {
        return $this->ReflectionClass->hasMethod($nombre_funcion);
    }

    public function verificar_funcion_anonima(): bool
    {
        $methods = $this->ReflectionClass->getMethods();
        foreach ($methods as $method) {
            if ($method->isClosure()) {
                return true;
            }
        }
        return false;
    }

    public function invocar_funcion(string $funcion, $args = null)
    {
        return $this->ReflectionClass->getMethod($funcion)->invoke($this, $args);
    }
}

<?php

class Clases
{
    private ReflectionClass $ReflectionClass;
    private string $nombre_clase;

    public function __construct(string $nombre_clase)
    {
        $this->nombre_clase = $nombre_clase;
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

    public function clase_padre(): ?string
    {
        $padre = $this->ReflectionClass->getParentClass();
        return $padre ? $padre->getName() : null;
    }

    public function traits(): array
    {
        return $this->ReflectionClass->getTraitNames();
    }
}


<?php
class ModeloFactory
{
    public static function crear($modelName)
    {
        $reflectionClass = new ReflectionClass($modelName);

        if (!$reflectionClass->IsInstantiable()) {
            throw new Exception('La clase no puede ser instanciada: ' . $modelName);
        }

        return new $modelName();
    }
}

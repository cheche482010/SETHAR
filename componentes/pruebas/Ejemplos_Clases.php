<?php
class Ejemplos_Clases
{
    public function ejemploValidarClase(): void
    {
        $clase    = new Clases('MiClase');
        $esValida = $clase->validar();

        if ($esValida) {
            echo 'La clase es instanciable';
        } else {
            echo 'La clase no es instanciable';
        }
    }

    public function ejemploObtenerNombreClase(): void
    {
        $clase       = new Clases('MiClase');
        $nombreClase = $clase->nombre_clase();

        echo 'Nombre de la clase: ' . $nombreClase;
    }

    public function ejemploObtenerArchivoClase(): void
    {
        $clase        = new Clases('MiClase');
        $archivoClase = $clase->archivo();

        echo 'Archivo de la clase: ' . $archivoClase;
    }

    public function ejemploObtenerConstantesClase(): void
    {
        $clase      = new Clases('MiClase');
        $constantes = $clase->constantes();

        echo 'Constantes de la clase:';
        print_r($constantes);
    }

    public function ejemploObtenerPropiedadesClase(): void
    {
        $clase       = new Clases('MiClase');
        $propiedades = $clase->propiedades();

        echo 'Propiedades de la clase:';
        print_r($propiedades);
    }

    public function ejemploObtenerFuncionesClase(): void
    {
        $clase     = new Clases('MiClase');
        $funciones = $clase->funciones();

        echo 'Funciones de la clase:';
        print_r($funciones);
    }

    public function ejemploInstanciarClase(): void
    {
        $clase     = new Clases('MiClase');
        $instancia = $clase->instanciar();

        echo 'Instancia de la clase creada';
    }

    public function ejemploObtenerClasePadre(): void
    {
        $clase      = new Clases('MiClase');
        $clasePadre = $clase->clase_padre();

        echo 'Clase padre de la clase: ' . $clasePadre;
    }

    public function ejemploObtenerTraitsClase(): void
    {
        $clase  = new Clases('MiClase');
        $traits = $clase->traits();

        echo 'Traits de la clase:';
        print_r($traits);
    }

    public function ejemploVerificarFuncionClase(): void
    {
        $clase         = new Clases('MiClase');
        $existeFuncion = $clase->verificar_funcion('miFuncion');

        if ($existeFuncion) {
            echo 'La función existe en la clase';
        } else {
            echo 'La función no existe en la clase';
        }
    }

    public function ejemploVerificarFuncionAnonimaClase(): void
    {
        $clase                = new Clases('MiClase');
        $existeFuncionAnonima = $clase->verificar_funcion_anonima();

        if ($existeFuncionAnonima) {
            echo 'La clase contiene al menos una función anónima';
        } else {
            echo 'La clase no contiene funciones anónimas';
        }
    }

    public function ejemploInvocarFuncionClase(): void
    {
        $clase     = new Clases('MiClase');
        $resultado = $clase->invocar_funcion('miFuncion');

        echo 'Resultado de la función: ' . $resultado;
    }
}

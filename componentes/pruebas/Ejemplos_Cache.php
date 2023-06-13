<?php
class Ejemplos_Cache
{
    public function ejemploIniciarCache(): void
    {
        $cache     = new Cache(true, 'cache_key', 'ultimo_id');
        $resultado = $cache->Iniciar();

        if (!empty($resultado)) {
            echo 'Resultado obtenido desde la caché: ' . $resultado;
        } else {
            // Realizar la lógica para obtener el resultado
            $resultado = 'Resultado obtenido de la fuente de datos';

            // Finalizar y guardar en caché
            $cache->Finalizar($resultado, 123);

            echo 'Resultado obtenido de la fuente de datos: ' . $resultado;
        }
    }

    public function ejemploEstablecerItemCache(): void
    {
        $cache = new Cache(true, 'cache_key', 'ultimo_id');
        $cache->Establecer_Item('clave', 'valor', 3600);

        echo 'Valor establecido en caché';
    }

    public function ejemploObtenerItemCache(): void
    {
        $cache = new Cache(true, 'cache_key', 'ultimo_id');
        $item  = $cache->Obtener_Item('clave');

        echo 'Objeto de caché obtenido';
    }

    public function ejemploGuardarCache(): void
    {
        $cache = new Cache(true, 'cache_key', 'ultimo_id');
        $item  = $cache->Obtener_Item('clave');
        $cache->Guardar($item);

        echo 'Objeto de caché guardado';
    }

    public function ejemploObtenerCache(): void
    {
        $cache = new Cache(true, 'cache_key', 'ultimo_id');
        $valor = $cache->Obtener('clave');

        echo 'Valor obtenido desde la caché: ' . $valor;
    }

    public function ejemploFinalizarCache(): void
    {
        $cache = new Cache(true, 'cache_key', 'ultimo_id');
        $cache->Finalizar('resultado', 456);

        echo 'Resultado guardado en caché';
    }
}

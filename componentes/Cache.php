<?php
use Stash\Driver\Redis;
use Stash\Pool;

class Cache
{
    protected $driver;
    protected $pool;

    public function __construct()
    {
        // Crear un objeto driver Redis y un pool de caché.
        $this->driver = new Redis();
        $this->pool   = new Pool($this->driver);
    }

    public static function Obtener_Item($key)
    {
        // Recuperar un objeto de caché utilizando la clave proporcionada.
        return $this->pool->getItem($key);
    }

    public function Guardar($item)
    {
        // Almacenar un objeto de caché.
        $this->pool->save($item);
    }

    public function Establecer_Item($key, $value, $expiration = 300)
    {
        // Crear un objeto de caché, establecer su valor y tiempo de expiración, y almacenarlo.
        $item = $this->Obtener_Item($key);
        $item->set($value)->expiresAfter($expiration);
        $this->Guardar($item);
    }

    public static function Obtener($key)
    {
        // Recuperar el valor de la caché utilizando la clave proporcionada.
        $item = $this->Obtener_Item($key);
        return $item->get();
    }
}

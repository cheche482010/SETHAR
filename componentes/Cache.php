<?php
use Stash\Driver\Redis;
use Stash\Pool;

class Cache
{
    protected $driver;
    protected $pool;
    private $cache;
    private $ultimo_id;
    public $cache_key;
    public $cache_result;

    public function __construct($cache, $cache_key, $ultimo_id)
    {
        // Crear un objeto driver Redis y un pool de caché.
        $this->driver    = new Redis();
        $this->pool      = new Pool($this->driver);
        $this->cache     = $cache;
        $this->cache_key = $cache_key;
        $this->ultimo_id = $ultimo_id;
    }

    public function Iniciar()
    {
        if ($this->cache) {
            $this->cache_result = $this->Obtener($this->cache_key);

            if (!empty($this->cache_result)) {
                return $this->ultimo_id ? $this->cache_result['ultimo_id'] : $this->cache_result['result'];
            }
        }
    }

    public function Obtener_Item($key)
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

    public function Obtener($key)
    {
        // Recuperar el valor de la caché utilizando la clave proporcionada.
        $item = $this->Obtener_Item($key);
        return $item->get();
    }

    public function Finalizar($result, $ultimo = null)
    {
        if ($this->cache) {
            $this->cache_result = ['result' => $result, 'ultimo_id' => $ultimo];
            $this->Establecer_Item($this->cache_key, $this->cache_result);
        }
    }
}

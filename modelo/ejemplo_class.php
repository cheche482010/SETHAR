<?php
interface EjemploModeloInterface
{
    public function Configurar(array $configuracion): self;
    public function Administrar(): mixed;
}
class Ejemplo_Modelo extends Modelo
{
    #Public: acceso sin restricción.
    #Private:Solo puede ser accesado por la clase que lo define.

    /**
     * Datos del modelo.
     * @var mixed
     */
    public $datos;

    /**
     * Opciones de configuración.
     * @var array
     */
    public $opciones;

    /**
     * Sentencia actual.
     * @var string|null
     */
    public $sentencia;

    /**
     * Resultado de la operación.
     * @var mixed
     */
    public $resultado;

    /**
     * Sentencia SQL.
     * @var string|null
     */
    private $SQL;

    /**
     * Configuración del modelo.
     * @var array|null
     */
    private $configuracion;

    /**
     * Opciones predeterminadas.
     * @var array
     */
    private $opciones_predeterminadas;

    /**
     * Constructor de la clase.
     */
    public function __construct()
    {
        parent::__construct();

        $this->opciones_predeterminadas = [
            'forzado'     => 'MIN',
            'transaccion' => false,
            'tipo_valor'  => 'detallado',
            'ultimo_id'   => false,
            'cache'       => false,
            'filtrado'    => true,
        ];
    }

    /**
     * Configura el modelo.
     *
     * @param array $configuracion Configuración del modelo.
     * @return self
     */
    public function Configurar(array $configuracion): self
    {
        $this->configuracion = $configuracion;
        $this->SQL           = isset($this->configuracion['sql']) ? $this->configuracion['sql'] : null;
        $this->datos         = isset($this->configuracion['datos']) ? $this->configuracion['datos'] : null;
        $this->opciones      = isset($this->configuracion['opciones']) ? array_merge($this->opciones_predeterminadas, $this->configuracion['opciones']) : $this->opciones_predeterminadas;
        return $this;
    }

    /**
     * Obtiene la sentencia actual.
     *
     * @return string|null Sentencia actual.
     */
    private function Sentencia():  ? string
    {
        $this->class = new Clases("Ejemplo_Modelo");
        return $this->class->verificar_funcion($this->SQL) ? $this->{$this->SQL}() : Errores::Capturar()->Personalizado('No existe la funcion : ' . $this->SQL . "() \nEn la clase: " . $this->class->nombre_clase() . "\nArchivo: " . __FILE__);
    }

    /**
     * Administra el modelo y ejecuta la sentencia actual.
     *
     * @return mixed Resultado de la operación.
     */
    public function Administrar() : mixed
    {
        $this->sentencia = $this->Sentencia();
        try {
            $this->resultado = $this->Ejecutar(
                $this->sentencia,
                $this->datos,
                $this->opciones['forzado'],
                $this->opciones['transaccion'],
                $this->opciones['tipo_valor'],
                $this->opciones['ultimo_id'],
                $this->opciones['cache'],
                $this->opciones['filtrado']
            );
            $this->Desconectar();
            return $this->resultado;
        } catch (PDOException $e) {
            Errores::Capturar()->Manejo_Excepciones($e);
        }
    }

    /**
     * Ejemplo de una sentencia SQL personalizada.
     *
     * @return string Sentencia SQL personalizada.
     */
    private function SQL_01(): string
    {
        return "insertar sql de su aplicacion";
    }
}

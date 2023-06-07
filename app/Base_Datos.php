<?php

ini_set("max_execution_time", "0");
error_reporting(E_ERROR);


use Componentes\Interfaces\Metodos_BD;
use Componentes\Funciones\Componentes;

class BASE_DATOS implements Metodos_BD
{
    use Componentes {Conexion as private ;}

    private $gestor;
    private $comprobar;
    private $error_conexion;

    public $conexion;

    public function __construct()
    {
        $this->gestor = $this->Conexion()["Mysql"];

        $this->DNS = [
            'Dominio'  => "{$this->gestor["Servidor"]}:host={$this->gestor["Host"]};port={$this->gestor["Puerto"]};dbname={$this->gestor["Base_Datos"]};",
            'Usuario'  => $this->gestor["Usuario"],
            'Clave'    => $this->gestor["Contraseña"],
            "Opciones" => array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT         => false,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\'',
            ),
        ];

        $this->Iniciar_Conexion();
    }

    public function Iniciar_Conexion()
    {
        try
        {
            $this->conexion       = new PDO($this->DNS["Dominio"], $this->DNS["Usuario"], $this->DNS["Clave"], $this->DNS["Opciones"]);
            $this->error_conexion = "No se han encontrado errores.";
            $this->comprobar      = 1;
            return $this->conexion;
        } catch (PDOException $e) {
            $this->error_conexion = $e;
            $this->comprobar      = 0;
            Errores::Capturar()->Manejo_Excepciones($e);
        } finally {
            unset($this->gestor, $this->DNS);
        }
    }
    
    public function Conectar()
    {return $this->conexion;}

    public function Probar_Conexion()
    {return $this->comprobar;}

    public function Error_Conexion()
    {return $this->error_conexion;}

}

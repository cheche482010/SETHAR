<?php

ini_set("max_execution_time", "0");
error_reporting(E_ERROR);
require_once "traits/Componentes.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

interface Metodos_BD
{
    public function Conectar();
    public function Probar_Conexion();
    public function Error_Conexion();
    public function Manager();
}
class BASE_DATOS implements Metodos_BD
{
    use Componentes {Conexion as private;}

    private $gestor;
    private $comprobar;
    private $error_conexion;
    private $manager;

    public $configuracion;
    public $setup;
    public $conexion;

    public function __construct()
    {
        $this->gestor = $this->Conexion()["Mysql"];
    
        $this->configuracion = [
            'url'      => "{$this->gestor["Servidor"]}:host={$this->gestor["Host"]};port={$this->gestor["Puerto"]};dbname={$this->gestor["Base_Datos"]};charset=utf8mb4",
            'user'     => $this->gestor["Usuario"],
            'password' => $this->gestor["Contraseña"],
        ];

        $this->Iniciar_Conexion();
    }
    private function Iniciar_Conexion()
    {
        try
        {
            $this->conexion = DriverManager::getConnection($this->configuracion);
            $this->error_conexion = "No se han encontrado errores.";
            $this->comprobar = 1;
            
            $this->setup = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/modelo/entidad"), true);
            $this->manager = EntityManager::create($this->conexion, $this->setup);
            return $this->conexion;
        }
        catch (\Doctrine\DBAL\Exception $e) {
            $this->error_conexion = 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: </br>' . $e;
            return $this->error_conexion;
        }
    }
    public function Conectar()
    {return $this->conexion;}

    public function Probar_Conexion()
    {return $this->comprobar;}

    public function Error_Conexion()
    {return $this->error_conexion;}

    public function Manager()
    {return $this->manager;}

}

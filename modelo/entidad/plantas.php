<?php
// namespace y uso de clases necesarios
namespace App\Modelo\Entidad;

use Doctrine\ORM\Mapping as ORM;
/**
 * @Entity
 * @Table(name="plantas")
 **/
class Plantas_Entidad
{
    /** 
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     **/
    private $id;

    /**
     * @Column(type="string", name="nombre")
     **/
    private $nombre;

    /**
     * @Column(type="integer", name="estado")
     **/
    private $estado;

    // Getters y setters para los atributos
}

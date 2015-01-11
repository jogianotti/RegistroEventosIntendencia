<?php

namespace RegistroEventos\CoreBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Contacto
 *
 * @ORM\Table(name="contactos")
 * @ORM\Entity(repositoryClass="RegistroEventos\CoreBundle\Repository\ContactoRepository")
 */
class Contacto
{
    use TimestampableEntity;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_contacto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=60)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=60, nullable=true)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoFijo", type="string", length=40, nullable=true)
     */
    private $telefonoFijo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoMovil", type="string", length=40, nullable=true)
     */
    private $telefonoMovil;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_empresa", type="string", length=255, nullable=true)
     */
    private $cargoEmpresa;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Contacto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Contacto
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set telefonoFijo
     *
     * @param string $telefonoFijo
     * @return Contacto
     */
    public function setTelefonoFijo($telefonoFijo)
    {
        $this->telefonoFijo = $telefonoFijo;

        return $this;
    }

    /**
     * Get telefonoFijo
     *
     * @return string 
     */
    public function getTelefonoFijo()
    {
        return $this->telefonoFijo;
    }

    /**
     * Set telefonoMovil
     *
     * @param string $telefonoMovil
     * @return Contacto
     */
    public function setTelefonoMovil($telefonoMovil)
    {
        $this->telefonoMovil = $telefonoMovil;

        return $this;
    }

    /**
     * Get telefonoMovil
     *
     * @return string 
     */
    public function getTelefonoMovil()
    {
        return $this->telefonoMovil;
    }

    /**
     * Set cargoEmpresa
     *
     * @param string $cargoEmpresa
     * @return Contacto
     */
    public function setCargoEmpresa($cargoEmpresa)
    {
        $this->cargoEmpresa = $cargoEmpresa;

        return $this;
    }

    /**
     * Get cargoEmpresa
     *
     * @return string 
     */
    public function getCargoEmpresa()
    {
        return $this->cargoEmpresa;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Contacto
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}

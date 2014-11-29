<?php

namespace RegistroEventos\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Detalle
 *
 * @ORM\Table(name="detalles")
 * @ORM\Entity(repositoryClass="RegistroEventos\CoreBundle\Repository\DetalleRepository")
 */
class Detalle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="fechaDetalle", type="datetime")
     */
    private $fechaDetalle;

    /**
     * @ORM\Column(name="fechaSistema", type="datetime")
     */
    private $fechaSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text")
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="Evento", inversedBy="detalles")
     * @ORM\JoinColumn(name="id_evento", referencedColumnName="id_evento",nullable=false)
     **/
    private $evento;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario",nullable=false)
     **/
    private $usuario;

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
     * Set fechaDetalle
     *
     * @param integer $fechaDetalle
     * @return Detalle
     */
    public function setFechaDetalle($fechaDetalle)
    {
        $this->fechaDetalle = $fechaDetalle;

        return $this;
    }

    /**
     * Get fechaDetalle
     *
     * @return integer 
     */
    public function getFechaDetalle()
    {
        return $this->fechaDetalle;
    }

    /**
     * Set fechaSistema
     *
     * @param integer $fechaSistema
     * @return Detalle
     */
    public function setFechaSistema($fechaSistema)
    {
        $this->fechaSistema = $fechaSistema;

        return $this;
    }

    /**
     * Get fechaSistema
     *
     * @return integer 
     */
    public function getFechaSistema()
    {
        return $this->fechaSistema;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Detalle
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
    
    function getEvento() {
        return $this->evento;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setEvento($evento) {
        $this->evento = $evento;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
}

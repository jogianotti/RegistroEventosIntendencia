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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="fechaDetalle", type="datetime")
     */
    private $fechaDetalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="fechaSistema", type="integer")
     */
    private $fechaSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text")
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="Detalle", inversedBy="eventos")
     * @ORM\JoinColumn(name="id_evento", referencedColumnName="id",nullable=false)
     **/
    private $evento;

    /**
     * @ORM\ManyToOne(targetEntity="Detalle", inversedBy="usuarios")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id",nullable=false)
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
}

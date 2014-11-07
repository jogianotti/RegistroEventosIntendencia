<?php

namespace RegistroEventos\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evento
 *
 * @ORM\Table(name="eventos")
 * @ORM\Entity(repositoryClass="RegistroEventos\CoreBundle\Repository\EventoRepository")
 */
class Evento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_evento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_sistema", type="datetime")
     */
    private $fechaSistema;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_evento", type="datetime")
     */
    private $fechaEvento;

    /**
     * @var string
     *
     * @ORM\Column(name="observacones", type="string", length=255)
     */
    private $observacones;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="eventos")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id",nullable=false)
     **/
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="TipoEvento", inversedBy="eventos")
     * @ORM\JoinColumn(name="id_tipo_evento", referencedColumnName="id",nullable=false)
     **/
    private $tipoEvento;

    /**
     * @ORM\OneToMany(targetEntity="Evento", mappedBy="detalle")
     **/
    private $detalles;


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
     * Set idEvento
     *
     * @param integer $idEvento
     * @return Evento
     */
    public function setIdEvento($idEvento)
    {
        $this->idEvento = $idEvento;

        return $this;
    }

    /**
     * Get idEvento
     *
     * @return integer 
     */
    public function getIdEvento()
    {
        return $this->idEvento;
    }

    /**
     * Set fechaSistema
     *
     * @param \DateTime $fechaSistema
     * @return Evento
     */
    public function setFechaSistema($fechaSistema)
    {
        $this->fechaSistema = $fechaSistema;

        return $this;
    }

    /**
     * Get fechaSistema
     *
     * @return \DateTime 
     */
    public function getFechaSistema()
    {
        return $this->fechaSistema;
    }

    /**
     * Set fechaEvento
     *
     * @param \DateTime $fechaEvento
     * @return Evento
     */
    public function setFechaEvento($fechaEvento)
    {
        $this->fechaEvento = $fechaEvento;

        return $this;
    }

    /**
     * Get fechaEvento
     *
     * @return \DateTime 
     */
    public function getFechaEvento()
    {
        return $this->fechaEvento;
    }

    /**
     * Set observacones
     *
     * @param string $observacones
     * @return Evento
     */
    public function setObservacones($observacones)
    {
        $this->observacones = $observacones;

        return $this;
    }

    /**
     * Get observacones
     *
     * @return string 
     */
    public function getObservacones()
    {
        return $this->observacones;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Evento
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipoEvento
     *
     * @param \stdClass $tipoEvento
     * @return Evento
     */
    public function setTipoEvento($tipoEvento)
    {
        $this->tipoEvento = $tipoEvento;

        return $this;
    }

    /**
     * Get tipoEvento
     *
     * @return \stdClass 
     */
    public function getTipoEvento()
    {
        return $this->tipoEvento;
    }

    /**
     * Set usuario
     *
     * @param \stdClass $usuario
     * @return Evento
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \stdClass 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}

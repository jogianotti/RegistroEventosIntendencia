<?php

namespace RegistroEventos\CoreBundle\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * TipoEvento
 *
 * @ORM\Table(name="tipos_eventos")
 * @ORM\Entity(repositoryClass="RegistroEventos\CoreBundle\Repository\TipoEventoRepository")
 */
class TipoEvento
{
    use TimestampableEntity;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="baja", type="boolean")
     */
    private $baja;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer")
     */
    private $prioridad;

    /**
     * @ORM\OneToMany(targetEntity="Evento", mappedBy="tipoEvento")
     **/
    protected $eventos;

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
     * @return TipoEvento
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
     * Set email
     *
     * @param string $email
     * @return TipoEvento
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set prioridad
     *
     * @param integer $prioridad
     * @return TipoEvento
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return integer 
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * Get baja
     *
     * @return bolean 
     */
    public function getBaja()
    {
        return $this->baja;
    }

    /**
     * Set baja
     *
     * @param boolean $baja
     * @return TipoEvento
     */
    public function setBaja($baja)
    {
        $this->baja = $baja;

        return $this;
    }
}

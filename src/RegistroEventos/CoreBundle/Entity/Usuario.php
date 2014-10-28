<?php

namespace RegistroEventos\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as UsuarioBase;
/**
 * Usuario
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="RegistroEventos\CoreBundle\Entity\UsuarioRepository")
 */
class Usuario extends UsuarioBase
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=80)
     */
    private $nombre;

    

    /**
     * @var boolean
     *
     * @ORM\Column(name="baja", type="boolean")
     */
    private $baja;
    

    /**
     * @ORM\OneToMany(targetEntity="Evento", mappedBy="usuario")
     **/
    protected $eventos;

    /**
     * @ORM\OneToMany(targetEntity="Detalle", mappedBy="usuario")
     **/
    protected $detalles;

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
     * @return Usuario
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
     * Set baja
     *
     * @param boolean $baja
     * @return Usuario
     */
    public function setBaja($baja)
    {
        $this->baja = $baja;

        return $this;
    }

    /**
     * Get baja
     *
     * @return boolean 
     */
    public function getBaja()
    {
        return $this->baja;
    }
}

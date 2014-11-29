<?php

namespace RegistroEventos\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as UsuarioBase;
/**
 * Usuario
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="RegistroEventos\CoreBundle\Repository\UsuarioRepository")
 */
class Usuario extends UsuarioBase
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id_usuario", type="integer")
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
     * @ORM\Column(name="baja", type="boolean", nullable=true, options={"default" = false})
     */
    private $baja;
    

    /**
     * @ORM\OneToMany(targetEntity="Evento", mappedBy="usuario")
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

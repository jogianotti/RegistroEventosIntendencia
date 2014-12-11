<?php

namespace RegistroEventos\CoreBundle\Entity;

use FOS\UserBundle\Model\User as UsuarioBase;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\AttributeOverride;
use Doctrine\ORM\Mapping\Column;

/**
 * Usuario
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="RegistroEventos\CoreBundle\Repository\UsuarioRepository")
 * 
 * @AttributeOverrides({
 *      @AttributeOverride(name="email",
 *          column=@Column(
 *              name     = "email",
 *              type     = "string",
                length   = 255,
 *              nullable = true
 *          )
 *      ),
 *      @AttributeOverride(name="emailCanonical",
 *          column=@Column(
 *              name="email_canonical",
 *              type="string",
 *              length=255,
 *              unique=true,
 *              nullable = true
 *          )
 *      )
 * })
 */
class Usuario extends UsuarioBase
{
    use TimestampableEntity;
    
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
    
    function __toString() {
        return $this->getNombre();
    }
}

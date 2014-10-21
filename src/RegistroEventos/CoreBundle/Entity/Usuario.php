<?php

// src/RegistroEventos/CoreBundle/Entity/Usuario.php

namespace RegistroEventos\CoreBundle\Entity;

use FOS\UserBundle\Model\User as UsuarioBase;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuarios")
 */
class Usuario extends UsuarioBase
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}

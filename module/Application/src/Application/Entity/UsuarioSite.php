<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity,
    Zend\Crypt\Password\Bcrypt;

/**
 * @ORM\Table(name="usuario_site")
 * @ORM\Entity
 */
class UsuarioSite extends AbstractEntity
{

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\Application\Entity\Usuario", inversedBy="sites")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="\Application\Entity\Site", inversedBy="usuarios")
     * @ORM\JoinColumn(name="site_id", referencedColumnName="id", nullable=false)
     */
    protected $site;

    /**
     * @ORM\Column(type="boolean", name="is_admin", nullable=false)
     */
    protected $isAdmin = false;

}

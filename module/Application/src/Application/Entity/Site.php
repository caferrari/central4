<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="site",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="un_site_sigla", columns={"sigla"})}
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Site extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\UsuarioSite", mappedBy="sites")
     */
    protected $usuarios;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=30)
     */
    protected $sigla;

    public function __construct($data)
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct($data);
    }

    /**
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function validate()
    {
        parent::validate();
    }

    public function addUsuario(\Application\Entity\Usuario $usuario)
    {
        $this->usuarios->add($usuario);
    }

}

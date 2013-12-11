<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="site")
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
     * @ORM\ManyToOne(targetEntity="Application\Entity\Orgao")
     * @ORM\JoinColumn(name="orgao_id", referencedColumnName="id")
     */
    protected $orgao;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\UsuarioSite", mappedBy="sites")
     */
    protected $usuarios;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $sigla;

    public function __construct($data) {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct($data);
    }

    public function addUsuario(\Application\Entity\Usuario $usuario) {
        $this->usuarios->add($usuario);
    }

}

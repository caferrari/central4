<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="orgao")
 */
class Orgao extends AbstractEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $telefone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $responsavel;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Site", mappedBy="sites")
     */
    protected $sites;

    public function __construct($data) {
        $this->sites = new \Doctrine\Common\Collections\ArrayCollection();
        parent::__construct($data);
    }

    public function addSite(\Application\Entity\Site $site) {
        $this->sites->add($site);
    }

}

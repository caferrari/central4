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

}

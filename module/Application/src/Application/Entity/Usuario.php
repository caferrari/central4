<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM,
    Common\AbstractEntity,
    Zend\Crypt\Password\Bcrypt;

/**
 * @ORM\Table(name="usuario",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="un_usuario_email", columns={"email"})}
 * )
 * @ORM\Entity(repositoryClass="Application\Repository\Usuario")
 * @ORM\HasLifecycleCallbacks
 */
class Usuario extends AbstractEntity
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
     * @ORM\Column(type="string", length=100)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    protected $tipo;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $ativo = true;

    /**
     * @ORM\Column(type="string", length=60)
     */
    protected $senha;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $salt;

    /**
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function validate()
    {
        parent::validate();
        if (($this->senha && strlen($this->senha) < 60)) {
            $this->senha = $this->getBcrypt()->create($this->generatePassword($this->senha));
        }

        if ('' == $this->senha) {
            $if = $this->getInputFilter();
            $if->get('senha')->setAllowEmpty(false);
            $if->get('senha')->setRequired(true);

            parent::validate();
        }

        return true;
    }

    public function verify($senha)
    {
        return $this->getBcrypt()->verify($this->generatePassword($senha), $this->senha);
    }

    public function getBcrypt()
    {
        return new Bcrypt(
            array(
                'salt' => $this->getSalt(),
                'cost' => 14
            )
        );
    }

    public function generatePassword($password)
    {
        return $password . sha1($password . $this->getSalt());
    }

    public function getSalt()
    {
        if (null == $this->salt) {
            $this->regenerateSalt();
        }
        return $this->salt;
    }

    public function regenerateSalt()
    {
        $this->salt = sha1(uniqid(mt_rand(), true));
    }

    public function isAdmin()
    {
        return 'b' === $this->tipo || $this->isMasterAdmin();
    }

    public function isMasterAdmin()
    {
        return 'a' === $this->tipo;
    }
}

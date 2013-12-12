<?php

namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager,
    Application\Entity\Usuario as UsuarioEntity;

class Usuario extends AbstractFixture
{

    public function load(ObjectManager $manager)
    {

        $data = array(
            'nome' => 'Administrador',
            'email' => 'admin@to.gov.br',
            'senha' => 'admin123'
        );

        $entity = new UsuarioEntity($data);

        $manager->persist($entity);
        $manager->flush();

    }

}

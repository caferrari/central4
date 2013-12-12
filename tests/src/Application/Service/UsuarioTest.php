<?php

namespace Application\Service;

use CafTest\TestCase\Service as ServiceTestCase,
    Application\Entity\Usuario as UsuarioEntity;

class UsuarioTest extends ServiceTestCase
{

    public function testSeInsereUsuario()
    {
        $em = $this->getEm();

        $service = new Usuario($em);
        $data = array(
            'nome' => 'Administrador',
            'email' => 'teste@to.gov.br',
            'senha' => '12345678'
        );
        $entity = $service->insert($data);

        $this->assertInstanceOf('\Application\Entity\Usuario', $entity);
    }

    public function testSeAtualizaDadosDoUsuarioSemAlterarSenha()
    {
        $em = $this->getEm();
        $service = new Usuario($em);
        $senhaAntiga = $em->getRepository('Application\Entity\Usuario')->findOneById(1)->senha;

        $data = array(
            'id' => 1,
            'nome' => 'Administrador X',
            'email' => 'teste@to.gov.br',
            'senha' => ''
        );

        $entity = $service->update($data);

        $this->assertInstanceOf('\Application\Entity\Usuario', $entity);
        $this->assertEquals($senhaAntiga, $entity->senha);
    }

    public function testSeAtualizaDadosDoUsuarioAlterandoASenha()
    {
        $em = $this->getEm();
        $service = new Usuario($em);

        $senhaAntiga = $em->getRepository('Application\Entity\Usuario')->findOneById(1)->senha;

        $data = array(
            'id' => 1,
            'nome' => 'Administrador X',
            'email' => 'teste@to.gov.br',
            'senha' => '1234567890'
        );

        $entity = $service->update($data);

        $this->assertInstanceOf('\Application\Entity\Usuario', $entity);
        $this->assertNotEquals($senhaAntiga, $entity->senha);
    }

    public function testSeDeletaUsuario()
    {
        $em = $this->getEm();
        $service = new Usuario($em);

        $entity = $service->delete(1);
        $this->assertInstanceOf('\Application\Entity\Usuario', $entity);

        $entity = $em->getRepository('Application\Entity\Usuario')->findOneById(1);
        $this->assertNull($entity);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSeInsereUsuarioInvalido()
    {
        $em = $this->getEm();
        $service = new Usuario($em);

        $data = array(
            'nome' => 'Administrador',
            'email' => 'bla',
            'senha' => '12345678'
        );

        $entity = $service->insert($data);
        $this->assertInstanceOf('\Application\Entity\Usuario', $entity);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSeInsereUsuarioSemSenha()
    {
        $em = $this->getEm();
        $service = new Usuario($em);

        $data = array(
            'nome' => 'Administrador',
            'email' => 'bla@bla.com',
            'senha' => ''
        );

        $entity = $service->insert($data);
        $this->assertInstanceOf('\Application\Entity\Usuario', $entity);
    }

}

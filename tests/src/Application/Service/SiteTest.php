<?php

namespace Application\Service;

use CafTest\TestCase\Service as ServiceTestCase,
    Application\Entity\Site as SiteEntity;

class SiteTest extends ServiceTestCase
{

    public function testSeInsereSite()
    {
        $em = $this->getEm();

        $service = new Site($em);
        $data = array(
            'nome' => 'Secretaria da Comunicação',
            'sigla' => 'secom'
        );
        $entity = $service->insert($data);

        $this->assertInstanceOf('\Application\Entity\Site', $entity);
    }

    public function testSeAtualizaDadosDoSite()
    {
        $em = $this->getEm();
        $service = new Site($em);

        $data = array(
            'id' => 1,
            'nome' => 'Agência Tocantinense de Notícias',
            'sigla' => 'atn'
        );

        $entity = $service->update($data);

        $this->assertInstanceOf('\Application\Entity\Site', $entity);

        $entity = $em->getRepository('Application\Entity\Site')->findOneById(1);
        $this->assertInstanceOf('\Application\Entity\Site', $entity);

        $this->assertEquals('Agência Tocantinense de Notícias', $entity->nome);
        $this->assertEquals('atn', $entity->sigla);
    }

    public function testSeDeletaSite()
    {
        $em = $this->getEm();
        $service = new Site($em);

        $entity = $service->delete(1);
        $this->assertInstanceOf('\Application\Entity\Site', $entity);

        $entity = $em->getRepository('Application\Entity\Site')->findOneById(1);
        $this->assertNull($entity);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSeInsereSiteInvalido()
    {
        $em = $this->getEm();
        $service = new Site($em);

        $data = array(
            'nome' => '',
            'email' => ''
        );

        $entity = $service->insert($data);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSeInsereSiteSemSigla()
    {
        $em = $this->getEm();
        $service = new Site($em);

        $data = array(
            'nome' => 'Naturatins',
            'sigla' => ''
        );

        $entity = $service->insert($data);
        $this->assertInstanceOf('\Application\Entity\Site', $entity);
    }

}

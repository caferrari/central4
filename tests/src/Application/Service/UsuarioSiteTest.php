<?php

namespace Application\Service;

use CafTest\TestCase\Service as ServiceTestCase,
    Application\Entity\Site as SiteEntity,
    Application\Entity\Usuario as UsuarioEntity;

class UsuarioSiteTest extends ServiceTestCase
{

    public function testSeRelacionaUsuarioAoSite() {
        $em = $this->getEm();

        $site = (new Site($em))->insert(
            array(
                'nome' => 'Secretaria da Comunicação',
                'sigla' => 'atn'
            )
        );

        $usuario = (new Usuario($em))->insert(
            array(
                'nome' => 'Administrador',
                'email' => 'teste@to.gov.br',
                'senha' => '12345678',
            )
        );

        $us = (new UsuarioSite($em))->relacionar($site, $usuario);

        $this->assertInstanceOf('\Application\Entity\UsuarioSite', $us);

        $this->assertEquals($site, $us->site);
        $this->assertEquals($usuario, $us->usuario);

    }

}

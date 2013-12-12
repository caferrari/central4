<?php

namespace Application\Entity;

use CafTest\TestCase\Entity as EntityTestCase;

class SiteTest extends EntityTestCase
{

    /**
     * @dataProvider providerForValidSites
     */
    public function testSeValidaSite($data)
    {
        $site = new Site($data);
        $this->assertTrue($site->isValid());
    }

    /**
     * @dataProvider providerForInvalidSites
     */
    public function testSeDaExecptionAoInserirUsuarioInvalido($data, $message)
    {
        try {
            $site = new Site($data);
            $site->validate();
            $this->fail('Usuário foi inserido mesmo inválido, deveria dar exception: ' . $message);
        } catch (\Exception $e) {
            $this->assertInstanceOf('InvalidArgumentException', $e);
            $this->assertEquals($message, $e->getMessage());
        }
    }

    public function providerForInvalidSites()
    {
        return array(
            array(
                array(
                    'nome' => '',
                    'sigla' => 'asdasdasd'
                ),
                'Digite um nome para o site'
            ),
            array(
                array(
                    'nome' => 'Bla bla',
                    'sigla' => ''
                ),
                'Digite uma sigla para o site;Sigla inválida'
            ),
            array(
                array(
                    'nome' => 'Bla bla',
                    'sigla' => 'Dasd4fffd'
                ),
                'Sigla inválida'
            ),
            array(
                array(
                    'nome' => 'Bla bla',
                    'sigla' => 'a'
                ),
                'Sigla inválida'
            ),
            array(
                array(
                    'nome' => 'Bli bli',
                    'sigla' => 'asdasdasdsadfajsdfgajdgfssdadfsfadfsfdasfddaf'
                ),
                'Sigla inválida'
            )

        );

    }

    public function providerForValidSites()
    {
        return array(
            array(
                array(
                    'nome' => 'Agência Tocantinense de Notícias',
                    'sigla' => 'atn'
                )
            ),
            array(
                array(
                    'nome' => 'Secretaria da Comunicação',
                    'sigla' => 'secom'
                )
            ),
            array(
                array(
                    'nome' => 'Naturatins',
                    'sigla' => 'naturatins'
                )
            )
        );

    }

}

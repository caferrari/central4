<?php

namespace Application\Entity;

use CafTest\ModelTestCase;

class UsuarioTest extends ModelTestCase
{

    /**
     * @dataProvider providerForValidUsuarios
     */
    public function testSeValidaUsuario($data)
    {
        $usuario = new Usuario($data);
        $this->assertTrue($usuario->isValid());
    }

    /**
     * @dataProvider providerForValidUsuarios
     */
    public function testSeEncriptaSenhaCorretamente($data)
    {
        $usuario = new Usuario($data);
        $usuario->validate();

        $this->assertStringStartsWith('$2y$', $usuario->senha);
        $this->assertTrue($usuario->verify($data['senha']));
    }

    /**
     * @dataProvider providerForInvalidUsuarios
     */
    public function testSeDaExecptionAoInserirUsuarioInvalido($data, $message)
    {
        try {
            $usuario = new Usuario($data);
            $usuario->validate();
            $this->fail('Usuário foi inserido mesmo inválido, deveria dar exception: ' . $message);
        } catch (\Exception $e) {
            $this->assertInstanceOf('InvalidArgumentException', $e);
            $this->assertEquals($message, $e->getMessage());
        }
    }

    public function providerForInvalidUsuarios()
    {
        return array(
            array(
                array(
                    'nome' => '',
                    'email' => 'asdasdasd@to.gov.br',
                    'senha' => '12345678',
                ),
                'Nome não deve estar em branco'
            ),
            array(
                array(
                    'nome' => 'Bla bla',
                    'email' => 'sasdasdasd',
                    'senha' => 'asdfghjk',
                ),
                'e-mail inválido'
            ),
            array(
                array(
                    'nome' => 'Bla bla',
                    'email' => '',
                    'senha' => 'asdfghjk',
                ),
                'e-mail é obrigatório!;e-mail inválido'
            ),
            array(
                array(
                    'nome' => 'Bli bli',
                    'email' => 'adminasdasd@to.gov.br',
                    'senha' => '123',
                ),
                'Senha deve ter no mínimo 8 caracteres'
            )

        );

    }

    public function providerForValidUsuarios()
    {
        return array(
            array(
                array(
                    'nome' => 'Administrador',
                    'email' => 'teste@to.gov.br',
                    'senha' => '12345678',
                )
            ),
            array(
                array(
                    'nome' => 'Outro Usuário',
                    'email' => 'teste2@to.gov.br',
                    'senha' => 'asdfghjk',
                )
            )
        );

    }

}

<?php

namespace Application\Controller;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use Common\AbstractController,
    Application\Form\Login as LoginForm;

class Usuario extends AbstractController
{

    use \Common\Controller\IndexAction;
    use \Common\Controller\NovoAction;
    use \Common\Controller\EditarAction;
    use \Common\Controller\ExcluirAction;

    public function __construct()
    {
        parent::__construct();

        $this->entity = '\Application\Entity\Usuario';
        $this->service = 'application.usuario';
        $this->editView = 'application/usuario/novo';
    }

    public function loginAction()
    {

        $form = new LoginForm;

        $request = $this->getRequest();

        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $auth = $this->getService('authservice');

            $auth->getAdapter()->setCredentials($data['email'], $data['senha']);

            $result = $auth->authenticate();

            if ($result->isValid()) {
                return $this->redirect()->toRoute('index');
            }

            $this->error('Usuário ou senha incorretos!');

        }

        return array('form' => $form);
    }

    public function logoutAction()
    {
        $auth = $this->getService('authservice');
        $auth->clearIdentity();
        return $this->redirect()->toRoute('login');
    }

    public function getMessages() {
        return array(
            'success' => array(
                'insert' => 'Usuário inserido com sucesso',
                'edit' => 'Usuário editado com sucesso',
                'delete' => 'Usuário excluído com sucesso'
            ),
            'error' => array(
                'insert' => 'Erro ao inserir usuário',
                'edit' => 'Erro ao editar usuário',
                'delete' => 'Erro ao excluir usuário',
                'unique' => 'Já existe um usuário com este email',
                'id' => 'id deve ser numérico'
            )
        );
    }

}

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

    public function __construct()
    {
        parent::__construct();

        $this->entity = '\Application\Entity\Usuario';
        $this->service = 'application.usuario';
        $this->editView = 'admin/usuario/novo';

        $this->messages['error']['unique'] = 'Já existe um usuário utilizando este email';
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
                return $this->redirect()->toRoute('admin');
            }

            $this->error('Usuário ou senha incorretos!');

        }

        return array('form' => $form);
    }

    public function logoutAction()
    {
        $auth = $this->getService('authservice');
        $auth->clearIdentity();
        return $this->redirect()->toRoute('admin/login');
    }

}

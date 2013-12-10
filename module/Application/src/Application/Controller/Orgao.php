<?php

namespace Application\Controller;

use Common\AbstractController;

class Orgao extends AbstractController
{

    use \Common\Controller\IndexAction;
    use \Common\Controller\NovoAction;
    use \Common\Controller\EditarAction;

    public function __construct()
    {
        parent::__construct();
        $this->messages['error']['unique'] = 'Já existe um orgão com este nome!';

        $this->entity = '\Application\Entity\Orgao';
        $this->service = 'application.orgao';
        $this->editView = 'application/orgao/novo';
    }

}

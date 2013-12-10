<?php

namespace Common\Controller;

use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

trait IndexAction
{

    public function indexAction()
    {
        $dados = $this->getRepository()->findAll();

        $page = (int)$this->getRequest()->getQuery('page', '1');

        $paginator = new Paginator(new ArrayAdapter($dados));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(20);
        return array('data' => $paginator, 'page' => $page);
    }

}

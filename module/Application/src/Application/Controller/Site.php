<?php

namespace Application\Controller;

use Common\AbstractController;

class Site extends AbstractController
{

    use \Common\Controller\IndexAction;
    use \Common\Controller\NovoAction;
    use \Common\Controller\EditarAction;
    use \Common\Controller\ExcluirAction;

    public function __construct()
    {
        parent::__construct();

        $this->entity = '\Application\Entity\Site';
        $this->service = 'application.site';
        $this->editView = 'application/site/novo';
    }

}

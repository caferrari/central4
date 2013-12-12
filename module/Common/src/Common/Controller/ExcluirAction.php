<?php

namespace Common\Controller;

trait ExcluirAction
{

    public function excluirAction()
    {
        $id = $this->getRequest()->getQuery('id', false);
        if (is_numeric($id)) {
            $this->getService()->delete($id);
            $this->success('delete');
        } else {
            $this->error('delete');
        }

        return $this->redirect()->toRoute('crud', array('controller' => $this->controller));
    }

}

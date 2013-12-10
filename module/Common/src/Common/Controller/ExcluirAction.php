<?php

namespace Common\Controller;

trait IndexAction
{

    public function excluirAction()
    {
        $id = $this->getRequest()->getQuery('id', false);
        if (is_numeric($id)) {
            $this->getService()->delete($id);
            $this->success($this->getMessage('delete', 'success'));
        } else {
            $this->success($this->getMessage('delete', 'error'));
        }

        return $this->redirect()->toRoute('crud', array('controller' => $this->controller));
    }

}

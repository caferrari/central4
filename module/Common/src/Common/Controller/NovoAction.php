<?php

namespace Common\Controller;

trait NovoAction
{

    public function novoAction()
    {
        $form = $this->getForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            try {
                $this->getService()->insert($request->getPost()->toArray());
                $this->success('insert');
                $this->redirect()->toRoute('crud', array('controller' => $this->controller));
            } catch(\Doctrine\DBAL\DBALException $e) {
                $pdoe = $e->getPrevious();
                if (23505 == $pdoe->getCode()) {
                    $this->error('unique');
                } else {
                    $this->error($e->getMessage);
                }
            } catch (\Exception $e) {
                $this->error('insert');
            }
        }

        return array('form' => $form);
    }

}

<?php

namespace Common\Controller;

trait NovoAction
{

    public function novoAction()
    {
        $form = $this->getForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            try {
                $form->validate();

                $this->getService()->insert($form->getData());
                $this->success($this->getMessage('insert', 'success'));
                $this->redirect()->toRoute('crud', array('controller' => $this->controller));
            } catch(\Doctrine\DBAL\DBALException $e) {
                $pdoe = $e->getPrevious();
                if (23505 == $pdoe->getCode()) {
                    $this->error($this->getMessage('unique', 'error'));
                } else {
                    throw $e;
                }
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }

        return array('form' => $form);
    }

}

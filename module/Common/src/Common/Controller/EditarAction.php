<?php

namespace Common\Controller;

trait EditarAction
{

    public function editarAction()
    {

        $form = $this->getForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            try {
                $form->validate();
                $this->getService()->update($form->getData());
                $this->success($this->getMessage('edit', 'success'));
                return $this->redirect()->toRoute('crud', array('controller' => $this->controller));
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }

        $id = $this->getRequest()->getQuery('id', false);
        if (is_numeric($id)) {
            $entity = $this->getRepository()->find($id);
            $this->form = $form->setData($entity->toArray());

            $children = $this->layout()->getChildren();
            return $this->render($this->editView);
        }

        $this->error('id must be numeric');
        return $this->redirect()->toRoute('crud', array('controller' => $this->controller));
    }

}

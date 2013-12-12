<?php

namespace Common\Controller;

trait EditarAction
{

    public function editarAction()
    {

        $id = $this->getRequest()->getQuery('id', false);
        $request = $this->getRequest();

        if ($request->isPost()) {
            try {
                $this->getService()->update($request->getPost()->toArray());
                $this->success('edit');
                return $this->redirect()->toRoute('crud', array('controller' => $this->controller));
            } catch (\Exception $e) {
                $this->error('edit');
            }
        }

        if (is_numeric($id)) {

            $this->form = $this->getForm();

            if (!$request->isPost()) {
                $entity = $this->getRepository()->find($id);
                $this->form->setData($entity->toArray());
            }

            $children = $this->layout()->getChildren();
            return $this->render($this->editView);
        }

        $this->error('id');
        return $this->redirect()->toRoute('crud', array('controller' => $this->controller));
    }

}

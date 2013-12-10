<?php

namespace Application\Service;

use Common\AbstractService;

class Usuario extends AbstractService
{

    public function update(array $data)
    {

        $entity = $this->getReference($data['id']);

        if (!empty($data['senha'])) {
            $entity->regenerateSalt();
        } else {
            unset($data['senha']);
        }

        $entity->setData($data);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

}

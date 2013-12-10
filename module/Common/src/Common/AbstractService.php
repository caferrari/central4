<?php

namespace Common;

use Doctrine\ORM\EntityManager;

class AbstractService
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(array $data)
    {
        $entity = $this->createEntity($data);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function update(array $data)
    {
        $entity = $this->getReference($data['id']);

        $entity->setData($data);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->getReference($id);
        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
            return $entity;
        }
    }

    protected function createEntity(array $data)
    {
        $entity = $this->getEntityName();
        return new $entity($data);
    }

    protected function getReference($id, $entity = null)
    {
        if (null === $entity) {
            $entity = $this->getEntityName();
        }
        return $this->em->getReference($entity, $id);
    }

    protected function getEntityName()
    {
        return str_replace('\\Service\\', '\\Entity\\', get_called_class());
    }
}

<?php

namespace ISConfiguracao\Service;

use ISBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Grupo extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'ISConfiguracao\Entity\Grupo';
    }

    public function update(array $data)
    {
        $grupo = $this->em->getReference($this->entity, $data['id']);

        (new Hydrator\ClassMethods())->hydrate($data, $grupo);

        $grupo->setDataAlteracao();

        $this->em->persist($grupo);
        $this->em->flush();

        return $grupo;
    }
}

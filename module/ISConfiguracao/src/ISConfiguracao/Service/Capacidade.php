<?php

namespace ISConfiguracao\Service;

use ISBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Capacidade extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'ISConfiguracao\Entity\Capacidade';
    }

    public function insert(array $data)
    {
        $unidadeCurricular = $this->em->getReference("ISConfiguracao\Entity\UnidadeCurricular", $data['unidade_curricular']);

        $capacidade = new \ISConfiguracao\Entity\Capacidade($data);
        $capacidade->setunidadeCurricular($unidadeCurricular);

        $this->em->persist($capacidade);
        $this->em->flush();

        return $capacidade;
    }

    public function update(array $data)
    {
        $capacidade = $this->em->getReference($this->entity, $data['id']);
        $unidadeCurricular = $this->em->getReference("ISConfiguracao\Entity\UnidadeCurricular", $data['unidade_curricular']);

        (new Hydrator\ClassMethods())->hydrate($data, $capacidade);

        $capacidade->setunidadeCurricular($unidadeCurricular);
        $capacidade->setDataAlteracao();

        $this->em->persist($capacidade);
        $this->em->flush();

        return $capacidade;
    }
}

<?php

namespace ISConfiguracao\Service;

use ISBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class UnidadeCurricular extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'ISConfiguracao\Entity\UnidadeCurricular';
    }

    public function insert(array $data)
    {
        $curso = $this->em->getReference("ISConfiguracao\Entity\Curso", $data['curso']);

        $unidadecurricular = new \ISConfiguracao\Entity\UnidadeCurricular($data);
        $unidadecurricular->setCurso($curso);

        $this->em->persist($unidadecurricular);
        $this->em->flush();

        return $unidadecurricular;
    }

    public function update(array $data)
    {
        $unidadecurricular = $this->em->getReference($this->entity, $data['id']);
        $curso = $this->em->getReference("ISConfiguracao\Entity\Curso", $data['curso']);

        (new Hydrator\ClassMethods())->hydrate($data, $unidadecurricular);

        $unidadecurricular->setCurso($curso);
        $unidadecurricular->setDataAlteracao();

        $this->em->persist($unidadecurricular);
        $this->em->flush();

        return $unidadecurricular;
    }
}

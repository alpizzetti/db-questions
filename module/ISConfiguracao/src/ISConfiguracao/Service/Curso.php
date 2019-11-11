<?php

namespace ISConfiguracao\Service;

use ISBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Curso extends AbstractService {

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'ISConfiguracao\Entity\Curso';
    }

    public function insert(array $data) {
        $unidade = $this->em->getReference("ISConfiguracao\Entity\Unidade", $data['unidade']);

        $curso = new \ISConfiguracao\Entity\Curso($data);
        $curso->setUnidade($unidade);

        $this->em->persist($curso);
        $this->em->flush();

        return $curso;
    }

    public function update(array $data) {
        $curso = $this->em->getReference($this->entity, $data['id']);
        $unidade = $this->em->getReference("ISConfiguracao\Entity\Unidade", $data['unidade']);

        (new Hydrator\ClassMethods())->hydrate($data, $curso);

        $curso->setUnidade($unidade);
        $curso->setDataAlteracao();

        $this->em->persist($curso);
        $this->em->flush();

        return $curso;
    }

}

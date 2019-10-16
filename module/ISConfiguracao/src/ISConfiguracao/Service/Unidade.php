<?php

namespace ISConfiguracao\Service;

use ISBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Unidade extends AbstractService {

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'ISConfiguracao\Entity\Unidade';
    }

    public function insert(array $data) {
        $unidade = new \ISConfiguracao\Entity\Unidade($data);
        
        $this->em->persist($unidade);
        $this->em->flush();

        return $unidade;
    }

    public function update(array $data) {
        $unidade = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $unidade);

        $this->em->persist($unidade);
        $this->em->flush();

        return $unidade;
    }

}

<?php

namespace ISConfiguracao\Service;

use Doctrine\ORM\EntityManager;
use ISBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Privilegio extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'ISConfiguracao\Entity\Privilegio';
    }

    public function insert(array $data) {
        $privilegio = new $this->entity($data);
        $privilegio->setGrupo($this->em->getReference('ISConfiguracao\Entity\Grupo', $data['grupo']));
        $privilegio->setFuncionalidade($this->em->getReference('ISConfiguracao\Entity\Funcionalidade', $data['funcionalidade']));
        $privilegio->setLer($data['ler']);
        $privilegio->setEscrever($data['escrever']);

        $this->em->persist($privilegio);
        $this->em->flush();

        return $privilegio;
    }

    public function update(array $data) {
        $privilegio = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $privilegio);

        $privilegio->setGrupo($this->em->getReference('ISConfiguracao\Entity\Grupo', $data['grupo']));
        $privilegio->setFuncionalidade($this->em->getReference('ISConfiguracao\Entity\Funcionalidade', $data['funcionalidade']));
        
        $this->em->persist($privilegio);
        $this->em->flush();

        return $privilegio;
    }

}

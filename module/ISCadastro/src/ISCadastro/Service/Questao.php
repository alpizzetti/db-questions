<?php

namespace ISCadastro\Service;

use ISBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Questao extends AbstractService {

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'ISCadastro\Entity\Questao';
    }

    public function insert(array $data) {
        $unidadeCurricular = $this->em->getReference("ISConfiguracao\Entity\UnidadeCurricular", $data['unidade_curricular']);
        $usuario = $this->em->getReference("ISConfiguracao\Entity\Usuario", $data['usuarioId']);
        
        $questao = new \ISCadastro\Entity\Questao($data);
        $questao->setUnidadeCurricular($unidadeCurricular);
        $questao->setUsuario($usuario);

        $this->em->persist($questao);
        $this->em->flush();

        return $questao;
    }

    public function update(array $data) {
        $unidadeCurricular = $this->em->getReference("ISConfiguracao\Entity\UnidadeCurricular", $data['unidade_curricular']);
        $questao = $this->em->getReference($this->entity, $data['id']);
        
        (new Hydrator\ClassMethods())->hydrate($data, $questao);
        
        $questao->setUnidadeCurricular($unidadeCurricular);

        $this->em->persist($questao);
        $this->em->flush();

        return $questao;
    }

}

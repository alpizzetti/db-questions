<?php

namespace ISConfiguracao\Service;

use ISBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;

class Unidade extends AbstractService {

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'ISConfiguracao\Entity\Unidade';
    }

}

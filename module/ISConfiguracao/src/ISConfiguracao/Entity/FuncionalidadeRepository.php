<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\EntityRepository;

class FuncionalidadeRepository extends EntityRepository
{
    public function popularCombobox()
    {
        $dql = "SELECT fun.id, fun.nome" . " FROM ISConfiguracao\Entity\Funcionalidade fun" . " ORDER BY fun.nome";

        $funcionalidades = $this->_em->createQuery($dql)->getResult();
        $retorno = [];

        foreach ($funcionalidades as $funcionalidade) {
            $retorno[$funcionalidade['id']] = $funcionalidade['nome'];
        }

        return $retorno;
    }
}

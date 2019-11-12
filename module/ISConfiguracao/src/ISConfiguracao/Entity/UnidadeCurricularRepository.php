<?php

namespace ISConfiguracao\Entity;

use ISBase\Paginator\AdapterQuery;
use Doctrine\ORM\EntityRepository;

class UnidadeCurricularRepository extends EntityRepository {

    public function listagemIndex($request) {
        $dql = "SELECT uni.id, uni.nome, uni.status"
                . " FROM ISConfiguracao\Entity\UnidadeCurricular uni"
                . " WHERE uni.status = :status";

        $params['status'] = $request['status'];

        if (!empty($request['curso'])) {
            $params['curso'] = $request['curso'];
            $dql .= " AND uni.curso = :curso";
        }
        if (!empty($request['nome'])) {
            $params['nome'] = $request['nome'] . "%";
            $dql .= " AND uni.nome LIKE :nome";
        }

        $dql .= " ORDER BY uni.nome";

        $query = $this->getEntityManager()->createQuery($dql)->setParameters($params);

        return (new AdapterQuery($query, $request['pagina'], 20, $this->getEntityManager()))->getPaginator();
    }

    public function popularCombobox() {
        $dql = "SELECT uni.id, uni.nome"
                . " FROM ISConfiguracao\Entity\UnidadeCurricular uni"
                . " WHERE uni.status = :status"
                . " ORDER BY uni.nome";

        $params['status'] = true;

        $unidadescurriculares = $this->getEntityManager()->createQuery($dql)->setParameters($params)->getResult();
        $saida = [];

        foreach ($unidadescurriculares as $unidadescurricular) {
            $saida[$unidadescurricular['id']] = $unidadescurricular['nome'];
        }

        return $saida;
    }

}

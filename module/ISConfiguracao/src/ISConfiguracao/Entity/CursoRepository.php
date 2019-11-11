<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\EntityRepository;
use ISBase\Paginator\AdapterQuery;

class CursoRepository extends EntityRepository {

    public function listagemIndex($request) {
        $dql = "SELECT cur.id, cur.nome, cur.tipo, cur.status"
                . " FROM ISConfiguracao\Entity\Curso cur"
                . " WHERE cur.status = :status";

        $params['status'] = $request['status'];

        if (!empty($request['unidade'])) {
            $params['unidade'] = $request['unidade'];
            $dql .= " AND cur.unidade = :unidade";
        }
        if (!empty($request['tipo'])) {
            $params['tipo'] = $request['tipo'];
            $dql .= " AND cur.tipo = :tipo";
        }
        if (!empty($request['nome'])) {
            $params['nome'] = $request['nome'] . "%";
            $dql .= " AND cur.nome LIKE :nome";
        }

        $dql .= " ORDER BY cur.nome";

        $query = $this->getEntityManager()->createQuery($dql)->setParameters($params);

        return (new AdapterQuery($query, $request['pagina'], 20, $this->getEntityManager()))->getPaginator();
    }

}

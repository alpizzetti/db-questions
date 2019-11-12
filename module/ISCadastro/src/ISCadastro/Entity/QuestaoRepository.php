<?php

namespace ISCadastro\Entity;

use Doctrine\ORM\EntityRepository;
use ISBase\Paginator\AdapterQuery;

class QuestaoRepository extends EntityRepository {

    public function listagemIndex($request) {
        $dql = "SELECT que.id, que.enunciado, que.dificuldade, que.status, uni.nome AS unidade"
                . " FROM ISCadastro\Entity\Questao que"
                . " INNER JOIN que.unidadeCurricular uni"
                . " WHERE que.status = :status";

        $params['status'] = $request['status'];

        if (!empty($request['filtro'])) {
            $params['filtro'] = $request['filtro'] . "%";
            $dql .= " AND (que.enunciado LIKE :filtro OR que.comando LIKE :filtro OR que.suporte LIKE :filtro)";
        }
        if (!empty($request['dificuldade'])) {
            $params['dificuldade'] = $request['dificuldade'];
            $dql .= " AND que.dificuldade = :dificuldade";
        }
        if (!empty($request['unidade_curricular'])) {
            $params['unidade_curricular'] = $request['unidade_curricular'];
            $dql .= " AND que.unidade = :unidade_curricular";
        }

        $dql .= " ORDER BY que.enunciado";

        $query = $this->getEntityManager()->createQuery($dql)->setParameters($params);

        return (new AdapterQuery($query, $request['pagina'], 20, $this->getEntityManager()))->getPaginator();
    }

}

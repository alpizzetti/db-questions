<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\EntityRepository;
use ISBase\Paginator\AdapterQuery;

class CursoRepository extends EntityRepository
{

    public function listagemIndex($request)
    {
        $dql = "SELECT cur.id, cur.nome, cur.tipo, cur.status, uni.nome AS unidade"
            . " FROM ISConfiguracao\Entity\Curso cur"
            . " INNER JOIN cur.unidade uni"
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

    public function popularCombobox()
    {
        $dql = "SELECT cur.id, cur.nome"
            . " FROM ISConfiguracao\Entity\Curso cur"
            . " WHERE cur.status = :status"
            . " ORDER BY cur.nome";

        $params['status'] = true;

        $cursos = $this->getEntityManager()->createQuery($dql)->setParameters($params)->getResult();
        $saida = [];

        foreach ($cursos as $curso) {
            $saida[$curso['id']] = $curso['nome'];
        }

        return $saida;
    }
}

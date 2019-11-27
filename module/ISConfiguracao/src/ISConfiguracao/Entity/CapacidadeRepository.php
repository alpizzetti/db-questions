<?php

namespace ISConfiguracao\Entity;

use ISBase\Paginator\AdapterQuery;
use Doctrine\ORM\EntityRepository;

class CapacidadeRepository extends EntityRepository
{
    public function listagemIndex($request)
    {
        $dql =
            "SELECT cap.id, cap.numero, cap.descricao, cap.status, uni.nome AS unidadeCurricular" .
            " FROM ISConfiguracao\Entity\Capacidade cap" .
            " INNER JOIN cap.unidadeCurricular uni" .
            " WHERE cap.status = :status";

        $params['status'] = $request['status'];

        if (!empty($request['unidadeCurricular'])) {
            $params['unidadeCurricular'] = $request['unidadeCurricular'];
            $dql .= " AND cap.unidadeCurricular = :unidadeCurricular";
        }
        if (!empty($request['numero'])) {
            $params['numero'] = $request['numero'] . "%";
            $dql .= " AND cap.numero LIKE :numero";
        }

        if (!empty($request['descricao'])) {
            $params['descricao'] = $request['descricao'] . "%";
            $dql .= " AND cap.descricao LIKE :descricao";
        }

        $dql .= " ORDER BY unidadeCurricular";

        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters($params);

        return (new AdapterQuery($query, $request['pagina'], 20, $this->getEntityManager()))->getPaginator();
    }

    public function popularCombobox($unidadeCurricular = null)
    {
        $dql = "SELECT cap.id, cap.numero" . " FROM ISConfiguracao\Entity\Capacidade cap" . " WHERE cap.status = :status";

        $params['status'] = true;

        if (!empty($unidadeCurricular)) {
            $dql .= " AND cap.unidadeCurricular = :unidadeCurricular";
            $params['unidadeCurricular'] = $unidadeCurricular;
        }

        $dql .= " ORDER BY cap.numero";

        $unidadescurriculares = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters($params)
            ->getResult();
        $saida = [];

        foreach ($unidadescurriculares as $unidadescurricular) {
            $saida[$unidadescurricular['id']] = $unidadescurricular['numero'];
        }

        return $saida;
    }
}

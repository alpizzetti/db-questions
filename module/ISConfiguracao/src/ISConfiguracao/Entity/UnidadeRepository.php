<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\EntityRepository;
use ISBase\Paginator\AdapterQuery;

class UnidadeRepository extends EntityRepository
{
    public function listagemIndex($request)
    {
        $dql =
            "SELECT uni.id, uni.nome, uni.email, uni.telefone, uni.status, DATE(MAX(ace.data)) AS ultimoAcesso, COUNT(ace.id) AS totalAcessos" .
            " FROM ISConfiguracao\Entity\Unidade uni" .
            " LEFT JOIN uni.usuarios usu" .
            " LEFT JOIN usu.acessos ace" .
            " WHERE uni.status = :status";

        $params['status'] = $request['status'];

        if (!empty($request['estado'])) {
            $params['estado'] = $request['estado'];
            $dql .= " AND uni.estado = :estado";
        }
        if (!empty($request['filtro'])) {
            $tags = explode(" ", $request['filtro']);

            foreach ($tags as $key => $tag) {
                $param = "filtro_" . $key;
                $params[$param] = "%" . $tag . "%";
                $dql .= " AND (uni.tags LIKE :$param)";
            }
        }

        $dql .= " GROUP BY uni.id ORDER BY uni.nome";

        $this->getEntityManager()
            ->getConfiguration()
            ->addCustomDatetimeFunction('DATE', 'ISBase\Doctrine\DateFunction');
        $query = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters($params);

        return (new AdapterQuery($query, $request['pagina'], 20, $this->getEntityManager()))->getPaginator();
    }

    public function popularCombobox()
    {
        $dql = "SELECT uni.id, uni.nome" . " FROM ISConfiguracao\Entity\Unidade uni" . " WHERE uni.status = :status" . " ORDER BY uni.nome";

        $params['status'] = true;

        $unidades = $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters($params)
            ->getResult();

        foreach ($unidades as $unidade) {
            $saida[$unidade['id']] = $unidade['nome'];
        }

        return $saida;
    }
}

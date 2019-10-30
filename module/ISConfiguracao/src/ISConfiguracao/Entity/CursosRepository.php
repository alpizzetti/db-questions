<?php

namespace ISCadastro\Entity;

use Doctrine\ORM\EntityRepository;
use ISBase\Paginator\AdapterQuery;

class CursosRepository extends EntityRepository
{

  public function listagemIndex($request)
  {
    /**$dql = "SELECT pri.id, pri.ler, pri.escrever, gru.nome AS grupo, fun.nome AS funcionalidade"
      . " FROM ISCadastro\Entity\Privilegio pri"
      . " JOIN pri.grupo gru"
      . " JOIN pri.funcionalidade fun";

    $params = [];

    if (!empty($request['grupo'])) {
      $params['grupo'] = $request['grupo'];
      $dql .= " WHERE pri.grupo = :grupo";

      if (!empty($request['funcionalidade'])) {
        $params['funcionalidade'] = $request['funcionalidade'];
        $dql .= " AND pri.funcionalidade = :funcionalidade";
      }
    } else if (!empty($request['funcionalidade'])) {
      $params['funcionalidade'] = $request['funcionalidade'];
      $dql .= " WHERE p.funcionalidade = :funcionalidade";
    }

    $dql .= " ORDER BY gru.nome, fun.nome";

    $query = $this->getEntityManager()->createQuery($dql)->setParameters($params);

    return (new AdapterQuery($query, $request['pagina'], 20, $this->getEntityManager()))->getPaginator();**/
  }
}

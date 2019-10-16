<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\EntityRepository;
use ISBase\Paginator\AdapterQuery;
use ISConfiguracao\Permissions\SessaoAcl;

class GrupoRepository extends EntityRepository {

    public function listagemIndex($request) {
        $dql = "SELECT gru"
                . " FROM ISConfiguracao\Entity\Grupo gru"
                . " WHERE gru.status = :status";

        $params['status'] = $request['status'];

        if (!empty($request['nome'])) {
            $params['nome'] = "%" . $request['nome'] . "%";
            $dql .= " AND gru.nome LIKE :nome";
        }
        
        $dql .= " ORDER BY gru.nome";
        
        $query = $this->getEntityManager()->createQuery($dql)->setParameters($params);
        
        return (new AdapterQuery($query, $request['pagina'], 20, $this->getEntityManager()))->getPaginator();
    }

    public function popularCombobox() {
        $dql = "SELECT gru.id, gru.nome"
                . " FROM ISConfiguracao\Entity\Grupo gru"
                . " WHERE gru.status = 1";
        
        if (!(new SessaoAcl())->getUsuario("administrador")) {
            $dql.= " AND (gru.id >= 2 AND gru.id <= 4)";
        }
        
        $dql.= " ORDER BY gru.nome";
        
        $grupos = $this->_em->createQuery($dql)->getResult();
        $retorno = [];
        
        foreach ($grupos as $grupo) {
            $retorno[$grupo['id']] = $grupo['nome'];
        }
        
        return $retorno;
    }
}

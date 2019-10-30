<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\EntityRepository;
use ISBase\Paginator\AdapterQuery;

class UsuarioRepository extends EntityRepository
{

    public function listagemIndex($request)
    {
        $dql = "SELECT usu.id, usu.nome, usu.sexo, usu.email, usu.status, gru.nome AS grupoNome, uni.nome as unidade, COUNT(ace.id) AS totalAcessos"
            . " FROM ISConfiguracao\Entity\Usuario usu"
            . " JOIN usu.grupo gru"
            . " JOIN usu.unidade uni"
            . " LEFT JOIN usu.acessos ace"
            . " WHERE usu.status = :status";

        $params['status'] = $request['status'];

        if (!empty($request['unidade'])) {
            $params['unidade'] = $request['unidade'];
            $dql .= " AND uni.id = :unidade";
        }
        if (!empty($request['filtro'])) {
            $params['filtro'] = "%" . $request['filtro'] . "%";
            $dql .= " AND (usu.nome LIKE :filtro OR usu.email LIKE :filtro)";
        }
        if (!empty($request['grupo'])) {
            $params['grupo'] = $request['grupo'];
            $dql .= " AND gru.id = :grupo";
        }

        $dql .= " GROUP BY usu.id ORDER BY usu.nome";

        $this->_em->getConfiguration()->addCustomDatetimeFunction('DATE', 'ISBase\Doctrine\DateFunction');
        $query = $this->getEntityManager()->createQuery($dql)->setParameters($params);

        return (new AdapterQuery($query, $request['pagina'], 20, $this->getEntityManager()))->getPaginator();
    }

    public function autenticacao($email, $senha)
    {
        $dql = "SELECT usu"
            . " FROM ISConfiguracao\Entity\Usuario usu"
            . " WHERE usu.email = :email AND usu.status = :status";

        $param = ['email' => $email, 'status' => true];

        $usuario = $this->getEntityManager()->createQuery($dql)->setMaxResults(1)->setParameters($param)->getOneOrNullResult();

        if (!empty($usuario) && $usuario->criptografarSenha($senha) == $usuario->getSenha()) {
            return $usuario;
        } else {
            return null;
        }
    }

    public function selecionarPorEmailStatus($email, $status = true)
    {
        $dql = "SELECT usu"
            . " FROM ISConfiguracao\Entity\Usuario usu"
            . " WHERE usu.email = :email AND usu.status = :status";

        $param = array('email' => $email, 'status' => $status);

        return $this->_em->createQuery($dql)->setMaxResults(1)->setParameters($param)->getOneOrNullResult();
    }

    public function selecionarPorTokenTocarSenha($token, $status = true)
    {
        $dql = "SELECT usu"
            . " FROM ISConfiguracao\Entity\Usuario usu"
            . " WHERE usu.tokenTrocarSenha = :token AND usu.status = :status";

        $param = array('token' => $token, 'status' => $status);

        return $this->_em->createQuery($dql)->setMaxResults(1)->setParameters($param)->getOneOrNullResult();
    }
}

<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\EntityRepository;

class UsuarioAcessoRepository extends EntityRepository
{

        public function selecionarAcessosUnidade($unidadeId, $limite)
        {
                $dql = "SELECT ace.data, usu.nome"
                        . " FROM ISConfiguracao\Entity\UsuarioAcesso ace"
                        . " JOIN ace.usuario usu"
                        . " JOIN usu.unidade uni"
                        . " WHERE uni.id = :unidadeId"
                        . " ORDER BY ace.data DESC";

                return $this->getEntityManager()
                        ->createQuery($dql)
                        ->setParameter("unidadeId", $unidadeId)
                        ->setMaxResults($limite)
                        ->getResult();
        }

        public function selecionarAcessosUsuario($usuarioId, $limite)
        {
                $dql = "SELECT ace.data"
                        . " FROM ISConfiguracao\Entity\UsuarioAcesso ace"
                        . " WHERE ace.usuario = :usuarioId"
                        . " ORDER BY ace.data DESC";

                return $this->getEntityManager()
                        ->createQuery($dql)
                        ->setParameter("usuarioId", $usuarioId)
                        ->setMaxResults($limite)
                        ->getResult();
        }
}

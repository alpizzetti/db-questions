<?php

namespace ISCadastro\Entity;

use Doctrine\ORM\EntityRepository;

class QuestaoImagemImagemRepository extends EntityRepository
{
    public function selecionarImagens($questaoId)
    {
        $dql = "SELECT img" . " FROM ISCadastro\Entity\QuestaoImagem img" . " WHERE img.status = :status AND img.questao = :questao";
        return $this->getEntityManager()
            ->createQuery($dql)
            ->setParameters(['status' => true, 'questao' => $questaoId])
            ->getResult();
    }
}

<?php

namespace ISCadastro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Table(name="questoes_imagens")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="ISCadastro\Entity\QuestaoImagemImagemRepository")
 */
class QuestaoImagem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="ISCadastro\Entity\Questao")
     * @ORM\JoinColumn(name="questao", referencedColumnName="id")
     */
    private $questao;

    /**
     * @var string
     *
     * @ORM\Column(name="arquivo", type="string", length=100, nullable=false)
     */
    private $arquivo;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=15, nullable=false)
     */
    private $item;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_criacao", type="datetime", nullable=false)
     */
    private $dataCriacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_alteracao", type="datetime", nullable=true)
     */
    private $dataAlteracao;

    public function __construct(array $options = array())
    {
        $this->dataCriacao = new \DateTime("now");
        $this->status = true;

        (new Hydrator\ClassMethods())->hydrate($options, $this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getQuestao()
    {
        return $this->questao;
    }

    public function getArquivo()
    {
        return $this->arquivo;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    public function getDataAlteracao()
    {
        return $this->dataAlteracao;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setQuestao($questao)
    {
        $this->questao = $questao;
        return $this;
    }

    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;
        return $this;
    }

    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setDataCriacao()
    {
        $this->dataCriacao = new \DateTime("now");
        return $this;
    }

    public function setDataAlteracao()
    {
        $this->dataAlteracao = new \DateTime("now");
        return $this;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}

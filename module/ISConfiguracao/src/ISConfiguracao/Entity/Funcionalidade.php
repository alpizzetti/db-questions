<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="funcionalidades")
 * @ORM\Entity(repositoryClass="ISConfiguracao\Entity\FuncionalidadeRepository")
 */
class Funcionalidade
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    public function __construct($options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}

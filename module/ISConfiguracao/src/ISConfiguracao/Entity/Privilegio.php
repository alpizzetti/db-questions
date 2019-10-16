<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Privilegio
 *
 * @ORM\Table(name="privilegios")
 * @ORM\Entity(repositoryClass="ISConfiguracao\Entity\PrivilegioRepository")
 */
class Privilegio {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ler", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $ler;

    /**
     * @var boolean
     *
     * @ORM\Column(name="escrever", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $escrever;

    /**
     * @var \ISConfiguracao\Entity\Grupo
     *
     * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\Grupo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupo", referencedColumnName="id", unique=true, nullable=true)
     * })
     */
    private $grupo;

    /**
     * @var \ISConfiguracao\Entity\Funcionalidade
     *
     * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\Funcionalidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="funcionalidade", referencedColumnName="id", unique=true, nullable=true)
     * })
     */
    private $funcionalidade;
    
    public function __construct($options = array()) {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setLer($ler) {
        $this->ler = $ler;

        return $this;
    }
    
    public function getLer() {
        return $this->ler;
    }
    
    public function setEscrever($escrever) {
        $this->escrever = $escrever;

        return $this;
    }
    
    public function getEscrever() {
        return $this->escrever;
    }
    
    public function setGrupo($grupo = null) {
        $this->grupo = $grupo;

        return $this;
    }
    
    public function getGrupo() {
        return $this->grupo;
    }
    
    public function setFuncionalidade($funcionalidade = null) {
        $this->funcionalidade = $funcionalidade;
        return $this;
    }
    
    public function getFuncionalidade() {
        return $this->funcionalidade;
    }
    
    public function toArray() {
        return (new Hydrator\ClassMethods())->extract($this);
    }

}

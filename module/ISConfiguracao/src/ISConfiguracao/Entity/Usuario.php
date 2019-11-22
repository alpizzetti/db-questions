<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use ISBase\Util\RandomString;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Math\Rand;
use Zend\Stdlib\Hydrator;
use ISBase\Util\IdealizeUtil;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="UsuarioRepository")
 */
class Usuario
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
     * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\Grupo")
     * @ORM\JoinColumn(name="grupo", referencedColumnName="id")
     */
    private $grupo;

    /**
     * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\Unidade")
     * @ORM\JoinColumn(name="unidade", referencedColumnName="id")
     */
    private $unidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1, nullable=false)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula", type="integer", length=20, nullable=false)
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=100, nullable=false)
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=100, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="token_web", type="string", length=100, nullable=true)
     */
    private $tokenWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="token_trocar_senha", type="string", length=100, nullable=true)
     */
    private $tokenTrocarSenha;

    /**
     * @var string
     *
     * @ORM\Column(name="token_google", type="string", length=16, nullable=true)
     */
    private $tokenGoogle;

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

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ISConfiguracao\Entity\UsuarioAcesso", mappedBy="usuario")
     */
    private $acessos;

    public function __construct(array $options = array())
    {
        $this->salt = base64_encode(Rand::getBytes(8, true));
        $this->acessos = new ArrayCollection();
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->dataCriacao = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getGrupo()
    {
        return $this->grupo;
    }

    public function getUnidade()
    {
        return $this->unidade;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getPrimeiroNome()
    {
        $apelido = explode(" ", $this->getNome());

        return !empty($apelido[0]) ? $apelido[0] : $apelido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getMatricula()
    {
        return $this->matricula;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getTokenWeb()
    {
        return $this->tokenWeb;
    }

    public function getTokenTrocarSenha()
    {
        return $this->tokenTrocarSenha;
    }

    public function getTokenGoogle()
    {
        return $this->tokenGoogle;
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

    public function getAcessos()
    {
        return $this->acessos;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
        return $this;
    }

    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;
        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = IdealizeUtil::normalizarNome($nome);
        return $this;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
        return $this;
    }

    public function setMatricula(string $matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = strtolower($email);
        return $this;
    }

    public function setSenha($senha)
    {
        $this->senha = $this->criptografarSenha($senha);
        return $this;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    public function setTokenWeb($gerar = true)
    {
        if ($gerar) {
            $this->tokenWeb = (new RandomString())->gerar(100);
        } else {
            $this->tokenWeb = null;
        }
        return $this;
    }

    public function setTokenTrocarSenha($gerar = true)
    {
        if ($gerar) {
            $this->tokenTrocarSenha = (new RandomString())->gerar(100);
        } else {
            $this->tokenTrocarSenha = null;
        }
        return $this;
    }

    public function setTokenGoogle($tokenGoogle)
    {
        $this->tokenGoogle = $tokenGoogle;
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

    public function criptografarSenha($senha)
    {
        return base64_encode(Pbkdf2::calc('sha256', $senha, $this->salt, 10000, strlen($senha * 2)));
    }
}

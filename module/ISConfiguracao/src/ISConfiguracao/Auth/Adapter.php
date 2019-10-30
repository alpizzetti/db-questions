<?php

namespace ISConfiguracao\Auth;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface
{

    protected $em;
    protected $email;
    protected $senha;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
        return $this;
    }

    public function setEmailSenha($dados)
    {
        $this->email = $dados['email'];
        $this->senha = $dados['senha'];
    }

    public function authenticate()
    {
        $usuario = $this->em->getRepository("ISConfiguracao\Entity\Usuario")->autenticacao($this->getEmail(), $this->getSenha());

        if ($usuario) {
            return new Result(Result::SUCCESS, array("usuario" => $usuario));
        } else {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
        }
    }
}

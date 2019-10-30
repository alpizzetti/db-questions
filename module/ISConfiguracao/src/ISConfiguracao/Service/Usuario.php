<?php

namespace ISConfiguracao\Service;

use Doctrine\ORM\EntityManager;
use ISBase\Mail\Mail;
use ISBase\Service\AbstractService;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Stdlib\Hydrator;

class Usuario extends AbstractService
{
    protected $transport;
    protected $view;

    public function __construct(EntityManager $em, SmtpTransport $transport, $view)
    {
        parent::__construct($em);
        $this->entity = "ISConfiguracao\Entity\Usuario";
        $this->transport = $transport;
        $this->view = $view;
    }

    public function insert(array $data)
    {
        $grupo = $this->em->getReference("ISConfiguracao\Entity\Grupo", $data['grupo']);
        $unidade = $this->em->getReference("ISConfiguracao\Entity\Unidade", $data['unidade']);

        $usuario = new \ISConfiguracao\Entity\Usuario($data);
        $usuario->setGrupo($grupo);
        $usuario->setUnidade($unidade);

        $this->em->persist($usuario);
        $this->em->flush();

        return $usuario;
    }

    public function update(array $data)
    {
        $usuario = $this->em->getReference($this->entity, $data['id']);
        $grupo = $this->em->getReference('ISConfiguracao\Entity\Grupo', $data['grupo']);
        $unidade = $this->em->getReference("ISConfiguracao\Entity\Unidade", $data['unidade']);

        (new Hydrator\ClassMethods())->hydrate($data, $usuario);

        $usuario->setUnidade($unidade);
        $usuario->setGrupo($grupo);
        $usuario->setDataAlteracao();

        $this->em->persist($usuario);
        $this->em->flush();

        return $usuario;
    }

    public function updateMeusDadosPerfil(array $data, $usuario)
    {
        $usuario->setNome($data['nome']);
        $usuario->setDataAlteracao();

        $this->em->persist($usuario);
        $this->em->flush();

        return $usuario;
    }

    public function updateMeusDadosSenha(array $data, $usuario)
    {
        $usuario->setsenha($data['senha']);
        $usuario->setDataAlteracao();

        $this->em->persist($usuario);
        $this->em->flush();

        return $usuario;
    }

    public function logAcesso($usuario)
    {
        $log = new \ISConfiguracao\Entity\UsuarioAcesso();
        $log->setUsuario($usuario);

        $this->em->persist($log);
        $this->em->flush();

        return $log;
    }

    public function criarToken($usuario)
    {
        $usuario->setTokenWeb();

        $this->em->persist($usuario);
        $this->em->flush();

        $this->logAcesso($usuario);

        return true;
    }

    public function senhaRedefinir($usuario, $global)
    {
        $usuario->setTokenTrocarSenha();

        $this->em->persist($usuario);
        $this->em->flush();

        $mail = new Mail($this->transport, $this->view, 'redefinir-senha');
        $mail->setSubject('Redefinir sua senha')
            ->setTo($usuario->getEmail())
            ->setData(array('url' => $global['url'], 'link' => $global['url'] . 'usuarios/senha/redefinir/confirmar?token=' . $usuario->getTokenTrocarSenha(), 'nome' => $usuario->getNome(true)))
            ->prepare()
            ->send();

        return true;
    }

    public function senhaConfirmar($usuario, $senha)
    {
        $usuario->setTokenTrocarSenha(false);
        $usuario->setSenha($senha);

        $this->em->persist($usuario);
        $this->em->flush();

        return true;
    }
}

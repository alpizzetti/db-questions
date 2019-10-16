<?php

namespace ISConfiguracao\Permissions;

use Zend\Session\Container;

class SessaoAcl {

    private $sessao;
    private $serviceLocator;

    public function __construct($serviceLocator = null) {
        $this->sessao = new Container('ISAdministracao');
        $this->serviceLocator = $serviceLocator;
    }

    public function setAcl($usuario, $usuarioSessao = null) {
        $grupo = $usuario->getGrupo();

        $acl = array(
            'unidade' => [
                'id' => $usuario->getUnidade()->getId(),
            ],
            'usuario' => [
                'id' => $usuario->getId(),
                'grupo' => $usuario->getGrupo()->getId(),
                'nome' => $usuario->getNome(),
                'primeiroNome' => $usuario->getPrimeiroNome(),
                'administrador' => $grupo->getAdministrador(),
                'token' => $usuario->getTokenWeb(),
                'imagem' => $usuario->getSexo() == "M" ? "padrao_masc.jpg" : "padrao_femi.jpg",
                'usuarioSessao' => $usuarioSessao
            ],
            'funcionalidades' => [
                'configuracoes' => [
                    'acl' => $this->salvarAcesso($grupo->getNome(), 'Configurações Controle de Acesso'),
                    'unidades' => $this->salvarAcesso($grupo->getNome(), 'Configurações Unidades'),
                    'usuarios' => $this->salvarAcesso($grupo->getNome(), 'Configurações Usuários'),
                ]
            ]
        );

        $this->sessao->offsetSet('acl', $acl);

        return $this;
    }

    public function getUnidade($item = null) {
        $acl = $this->sessao->offsetGet('acl');

        if (empty($item)) {
            return $acl['unidade'];
        } else {
            return $acl['unidade'][$item];
        }
    }

    public function getUsuario($item = null) {
        $acl = $this->sessao->offsetGet('acl');

        if (empty($item)) {
            return $acl['usuario'];
        } else {
            return $acl['usuario'][$item];
        }
    }

    public function getAcl($modulo = null, $funcionalidade = null, $acao = null) {
        $acl = $this->sessao->offsetGet('acl');

        if(!empty($modulo) && !empty($funcionalidade) && !empty($acao)) {
            return $acl['funcionalidades'][$modulo][$funcionalidade][$acao];
        } else if(!empty($modulo) && !empty($funcionalidade)) {
            return $acl['funcionalidades'][$modulo][$funcionalidade];
        } else if(!empty($modulo)) {
            return $acl['funcionalidades'][$modulo];
        } else {
            return $acl;
        }
    }

    private function salvarAcesso($grupo, $funcionalidade) {
        $acl = $this->serviceLocator->get('ISConfiguracao\Permissions\Acl');

        return array(
            'ler' => $acl->isAllowed($grupo, $funcionalidade, 'ler'),
            'escrever' => $acl->isAllowed($grupo, $funcionalidade, 'escrever')
        );
    }

}

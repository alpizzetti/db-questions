<?php

namespace ISConfiguracao\Permissions;

use Zend\Session\Container;

class SessaoAcl
{
    private $sessao;
    private $serviceLocator;

    public function __construct($serviceLocator = null)
    {
        $this->sessao = new Container('ISAdministracao');
        $this->serviceLocator = $serviceLocator;
    }

    public function setAcl($usuario, $usuarioSessao = null)
    {
        $grupo = $usuario->getGrupo();

        $acl = array(
            'unidade' => [
                'id' => $usuario->getUnidade()->getId()
            ],
            'usuario' => [
                'id' => $usuario->getId(),
                'grupo' => $usuario->getGrupo()->getId(),
                'nome' => $usuario->getNome(),
                'email' => $usuario->getEmail(),
                'primeiroNome' => $usuario->getPrimeiroNome(),
                'administrador' => $grupo->getAdministrador(),
                'token' => $usuario->getTokenWeb(),
                'tokenGoogle' => $usuario->getTokenGoogle(),
                'imagem' => $usuario->getSexo() == "M" ? "padrao_masc.jpg" : "padrao_femi.jpg",
                'usuarioSessao' => $usuarioSessao
            ],
            'funcionalidades' => [
                'configuracoes' => [
                    'acl' => $this->salvarAcesso($grupo->getNome(), 'Configurações Controle de Acesso'),
                    'usuarios' => $this->salvarAcesso($grupo->getNome(), 'Configurações de Usuários'),
                    'unidades' => $this->salvarAcesso($grupo->getNome(), 'Configurações de Unidades'),
                    'cursos' => $this->salvarAcesso($grupo->getNome(), 'Configurações de Cursos'),
                    'unidadescurriculares' => $this->salvarAcesso($grupo->getNome(), 'Configurações de Unidades Curriculares'),
                    'capacidades' => $this->salvarAcesso($grupo->getNome(), 'Configurações de Capacidades')
                ],
                'cadastros' => [
                    'questoes' => $this->salvarAcesso($grupo->getNome(), 'Cadastro de Questões'),
                    'moderador' => $this->salvarAcesso($grupo->getNome(), 'Moderador de Questões')
                ],
                'relatorios' => [
                    'basico' => $this->salvarAcesso($grupo->getNome(), 'Relatórios')
                ]
            ]
        );

        $this->sessao->offsetSet('acl', $acl);

        return $this;
    }

    public function getUnidade($item = null)
    {
        $acl = $this->sessao->offsetGet('acl');

        if (empty($item)) {
            return $acl['unidade'];
        } else {
            return $acl['unidade'][$item];
        }
    }

    public function getUsuario($item = null)
    {
        $acl = $this->sessao->offsetGet('acl');

        if (empty($item)) {
            return $acl['usuario'];
        } else {
            return $acl['usuario'][$item];
        }
    }

    public function getAcl($modulo = null, $funcionalidade = null, $acao = null)
    {
        $acl = $this->sessao->offsetGet('acl');

        if (!empty($modulo) && !empty($funcionalidade) && !empty($acao)) {
            return $acl['funcionalidades'][$modulo][$funcionalidade][$acao];
        } elseif (!empty($modulo) && !empty($funcionalidade)) {
            return $acl['funcionalidades'][$modulo][$funcionalidade];
        } elseif (!empty($modulo)) {
            return $acl['funcionalidades'][$modulo];
        } else {
            return $acl;
        }
    }

    private function salvarAcesso($grupo, $funcionalidade)
    {
        $acl = $this->serviceLocator->get('ISConfiguracao\Permissions\Acl');

        return array(
            'ler' => $acl->isAllowed($grupo, $funcionalidade, 'ler'),
            'escrever' => $acl->isAllowed($grupo, $funcionalidade, 'escrever')
        );
    }

    public function setValores($nome, $valor)
    {
        $this->sessao->offsetSet($nome, $valor);
    }

    public function getValores($nome)
    {
        return $this->sessao->offsetGet($nome);
    }
}

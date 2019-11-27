<?php

namespace ISConfiguracao\Controller;

use ISConfiguracao\Form\AutenticacaoEntrar;
use ISConfiguracao\Form\AutenticacaoSenhaRedefinir;
use ISConfiguracao\Form\AutenticacaoGoogle;
use ISBase\Controller\CrudController as CrudController;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use ISConfiguracao\Permissions\SessaoAcl;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class AutenticacaoController extends CrudController
{
    private $sessionStorage;

    public function __construct()
    {
        parent::__construct();

        $this->sessionStorage = "ISConfiguracao";
        $this->service = "ISConfiguracao\Service\Usuario";
        $this->entity = "ISConfiguracao\Entity\Usuario";
    }

    public function entrarAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $retorno['mensagem'] = "";
            $retorno['sucesso'] = false;
            $request = $request->getPost()->toArray();

            if (!empty($request['email']) && !empty($request['senha'])) {
                $usuario = $this->getEntityManager()
                    ->getRepository($this->entity)
                    ->autenticacao($request["email"], $request['senha']);

                if (!empty($usuario)) {
                    $retorno['sucesso'] = true;
                    $this->sessao->setValores("usuarioId", $usuario->getId());
                } else {
                    $retorno['mensagem'] = "Dados inválidos.";
                }
            } else {
                $retorno['mensagem'] = "Informe seus dados de acesso.";
            }

            return new JsonModel($retorno);
        }

        return (new ViewModel(array('form' => new AutenticacaoEntrar(), 'mensagens' => $this->flashMessenger()->getMessages())))
            ->setTemplate("is-configuracao/usuarios/autenticacao-entrar.phtml")
            ->setTerminal(true);
    }

    public function googleAuthenticatorAction()
    {
        $request = $this->getRequest();
        $usuarioId = $this->sessao->getValores("usuarioId");

        if (!empty($usuarioId)) {
            $usuario = $this->getEntityManager()
                ->getRepository($this->entity)
                ->find($usuarioId);

            if (!empty($usuario)) {
                $qrCodeUrl = null;

                if ($request->isPost()) {
                    $retorno['mensagem'] = "";
                    $retorno['sucesso'] = false;
                    $request = $request->getPost()->toArray();

                    if (!empty($request['codigo'])) {
                        $validacao = (new \ISBase\Util\GoogleAuthenticator())->verifyCode($usuario->getTokenGoogle(), $request['codigo'], 2);

                        if ($validacao) {
                            $retorno['sucesso'] = true;
                            $sessionStorage = new SessionStorage("ISConfiguracao");
                            $sessionStorage->write($usuario);
                            (new SessaoAcl($this->getServiceLocator()))->setAcl($usuario);
                        } else {
                            $retorno['mensagem'] = "Código inválido.";
                        }
                    } else {
                        $retorno['mensagem'] = "Informe o código de autenticação.";
                    }

                    return new JsonModel($retorno);
                } elseif (empty($usuario->getTokenGoogle())) {
                    $this->getServiceLocator()
                        ->get($this->service)
                        ->criarToken($usuario);
                    $ga = new \ISBase\Util\GoogleAuthenticator();
                    $qrCodeUrl = $ga->getQRCodeGoogleUrl($usuario->getEmail(), $usuario->getTokenGoogle(), 'Banco de Dados de Questões - SENAI/SC');
                }

                return (new ViewModel(array(
                    'form' => new AutenticacaoGoogle(),
                    'mensagens' => $this->flashMessenger()->getMessages(),
                    'qrCodeUrl' => $qrCodeUrl
                )))
                    ->setTemplate("is-configuracao/usuarios/autenticacao-google-authenticator.phtml")
                    ->setTerminal(true);
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function sairAction()
    {
        $usuarioSessao = $this->sessao->getUsuario();

        if (!empty($usuarioSessao)) {
            $usuario = $this->getEntityManager()
                ->getRepository($this->entity)
                ->find($usuarioSessao['id']);

            if (!empty($usuario)) {
                $auth = new AuthenticationService();
                $auth->setStorage(new SessionStorage($this->sessionStorage));
                $auth->clearIdentity();

                (new Container($this->sessionStorage))
                    ->getManager()
                    ->getStorage()
                    ->clear();
            }
        }

        return $this->redirect()->toRoute("isconfiguracao-autenticacao-entrar");
    }

    public function senhaRedefinirAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $retorno["sucesso"] = false;
            $request = $request->getPost()->toArray();

            if (!empty($request['email'])) {
                $usuario = $this->getEntityManager()
                    ->getRepository($this->entity)
                    ->selecionarPorEmailStatus($request["email"]);

                if (!empty($usuario)) {
                    $retorno["sucesso"] = $this->getServiceLocator()
                        ->get($this->service)
                        ->senhaRedefinir($usuario, $this->getGlobalConfig());

                    if ($retorno["sucesso"]) {
                        $this->setMensagemSucesso("Obrigado! Confira (" . $usuario->getEmail() . ") para obter o link de redefinição de senha.");
                    }
                } else {
                    $retorno["mensagem"] = "O e-mail informado não está cadastrado.";
                }
            } else {
                $retorno["mensagem"] = "Insira um endereço de e-mail válido.";
            }

            return new JsonModel($retorno);
        }

        return (new ViewModel(array('form' => new AutenticacaoSenhaRedefinir())))
            ->setTemplate("is-configuracao/usuarios/autenticacao-senha-redefinir.phtml")
            ->setTerminal(true);
    }

    public function senhaConfirmarAction()
    {
        $token = $this->params()->fromQuery("token", null);

        if (!empty($token)) {
            $usuario = $this->getEntityManager()
                ->getRepository($this->entity)
                ->selecionarPorTokenTocarSenha($token);

            if (!empty($usuario)) {
                $form = new \ISConfiguracao\Form\AutenticacaoSenhaConfirmar();
                $form->get('token')->setValue($token);
                $request = $this->getRequest();

                if ($request->isPost()) {
                    $request = $request->getPost()->toArray();
                    $retorno["sucesso"] = false;
                    $retorno["mensagem"] = $this->validarFormSenhaConfirmar($request);

                    if (empty($retorno["mensagem"])) {
                        $retorno["sucesso"] = $this->getServiceLocator()
                            ->get($this->service)
                            ->senhaConfirmar($usuario, $request['senha']);
                    }

                    if ($retorno["sucesso"]) {
                        $this->setMensagemSucesso("Sua senha foi redefinida.");
                    }

                    return new JsonModel($retorno);
                }

                return (new ViewModel(array('form' => $form)))
                    ->setTemplate("is-configuracao/usuarios/autenticacao-senha-confirmar.phtml")
                    ->setTerminal(true);
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    private function validarFormSenhaConfirmar($request)
    {
        $mensagem = "";

        if (empty($request['senha'])) {
            $mensagem .= "<br/> - Nova senha";
        }
        if (empty($request['senha_repete'])) {
            $mensagem .= "<br/> - Confirmação da nova senha";
        }
        if (empty($mensagem)) {
            if ($request['senha'] != $request['senha_repete']) {
                $mensagem .= "<br/> - As senhas não são iguais";
            } elseif (strlen($request['senha']) < 6) {
                $mensagem .= "<br/> -Informe uma senha maior que 6 caracteres";
            }
        }
        if (!empty($mensagem)) {
            $mensagem = "Informe os campos obirgatórios: " . $mensagem;
        }

        return $mensagem;
    }
}

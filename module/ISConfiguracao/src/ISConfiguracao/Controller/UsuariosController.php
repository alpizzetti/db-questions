<?php

namespace ISConfiguracao\Controller;

use ISBase\Controller\CrudController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class UsuariosController extends CrudController {

    public function __construct() {
        parent::__construct();

        $this->entity = "ISConfiguracao\Entity\Usuario";
        $this->service = "ISConfiguracao\Service\Usuario";
        $this->controller = "usuarios";
        $this->route = "isconfiguracao-admin/default";
        $this->modulo = "configuracoes";
        $this->funcionalidade = "usuarios";
        $this->messages = array(
            "success" => array(
                "edit" => "Editado com sucesso.",
                "delete" => "Excluído com sucesso.",
                "ativar" => "Ativado com sucesso."
            ),
            "error" => array(
                "edit" => "Erro ao editar.",
                "delete" => "Erro ao remover.",
                "ativar" => "Erro ao ativar."
            )
        );
    }

    public function indexAction() {
        if ($this->getAcesso("ler")) {
            $form = $this->getServiceLocator()->get("ISConfiguracao\Form\UsuarioIndex");
            $request['filtro'] = $this->params()->fromQuery("filtro", null);
            $request['status'] = $this->params()->fromQuery("status", 1);
            $request['grupo'] = $this->params()->fromQuery("grupo", null);
            $request['unidade'] = $this->params()->fromQuery("unidade", $this->unidadeId);
            $request['pagina'] = $this->params()->fromQuery("pagina", 1);

            $filtros = "&unidade=" . $request['unidade'];
            $filtros .= !empty($request['filtro']) ? "&filtro=" . $request['filtro'] : "";
            $filtros .= !empty($request["grupo"]) ? "&grupo=" . $request['grupo'] : "";
            $filtros .= $request['status'] != 1 ? "&status=" . $request['status'] : "";

            return new ViewModel(array(
                "filtros" => $filtros,
                "acl" => $this->getAcl(),
                "form" => $form->setData($request),
                "mensagens" => $this->flashMessenger()->getMessages(),
                "administrador" => $this->sessao->getUsuario("administrador"),
                "dados" => $this->getEntityManager()->getRepository($this->entity)->listagemIndex($request)
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function novoAction() {
        if ($this->getAcesso()) {
            $form = $this->getServiceLocator()->get("ISConfiguracao\Form\UsuarioDados");
            $request = $this->getRequest();

            if ($request->isPost()) {
                if ($form->setData($request->getPost())->isValid()) {
                    $request = $request->getPost()->toArray();

                    if ($this->validarEmail($request["id"], $request["email"])) {
                        $usuario = $this->getServiceLocator()->get($this->service)->insert($request);

                        if (!empty($usuario)) {
                            $this->setMensagemSucesso("Usuário inserido com sucesso.");
                            return $this->redirect()->toRoute($this->route, array("controller" => $this->controller, "action" => "novo"));
                        }
                    } else {
                        $this->setMensagemErro("E-mail já cadastrado no sistema.");
                    }
                }
            } else {
                $form->get("unidade")->setValue($this->unidadeId);
            }

            return new ViewModel(array(
                "form" => $form,
                "mensagens" => $this->flashMessenger()->getCurrentMessages()
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function editarAction() {
        if ($this->getAcesso()) {
            $usuario = $this->getEntityManager()->getRepository($this->entity)->find($this->params()->fromRoute("id", 0));

            if (!empty($usuario)) {
                $form = $this->getServiceLocator()->get("ISConfiguracao\Form\UsuarioDados");
                $form->setInputFilter(new \ISConfiguracao\Form\UsuarioDadosFilter("editar"));
                $form->setData($usuario->toArray());
                $request = $this->getRequest();

                if ($request->isPost()) {
                    if ($form->setData($request->getPost())->isValid()) {
                        $request = $request->getPost()->toArray();

                        if ($this->validarEmail($request["id"], $request["email"])) {
                            $this->getServiceLocator()->get($this->service)->update($request);
                            $this->setMensagemSucesso("Usuário editado com sucesso.");

                            return $this->redirect()->toRoute($this->route, array("controller" => $this->controller, "action" => "editar", "id" => $usuario->getId()));
                        } else {
                            $this->setMensagemErro("E-mail já cadastrado no sistema.");
                        }
                    }
                }

                return new ViewModel(array(
                    "form" => $form,
                    "usuario" => $usuario,
                    "mensagens" => $this->flashMessenger()->getCurrentMessages()
                ));
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function editarSenhaAction() {
        if ($this->getAcesso()) {
            $usuario = $this->getEntityManager()->getRepository($this->entity)->find($this->params()->fromRoute("id", 0));

            if (!empty($usuario)) {
                $form = new \ISConfiguracao\Form\UsuarioSenha();
                $request = $this->getRequest();

                if ($request->isPost()) {
                    $form->setData($request->getPost());

                    if ($form->isValid()) {
                        $request = $request->getPost()->toArray();
                        $this->getServiceLocator()->get($this->service)->updateMeusDadosSenha($request, $usuario);
                        $this->setMensagemSucesso("Senha atualizada.");
                    }
                }

                return new ViewModel(array(
                    "form" => $form,
                    "usuario" => $usuario,
                    "mensagens" => $this->flashMessenger()->getCurrentMessages(),
                ));
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function meusDadosPerfilAction() {
        $usuario = $this->getEntityManager()->getRepository($this->entity)->find($this->usuarioId);

        if (!empty($usuario)) {
            $form = new \ISConfiguracao\Form\MeusDadosPerfil();
            $form->setData($usuario->toArray());
            $request = $this->getRequest();

            if ($request->isPost()) {
                $form->setData($request->getPost());

                if ($form->isValid()) {
                    $this->getServiceLocator()->get($this->service)->updateMeusDadosPerfil($request->getPost()->toArray(), $usuario);
                    $this->setMensagemSucesso("Seu perfil foi atualizado.");

                    return $this->redirect()->toRoute($this->route, array("controller" => $this->controller, "action" => "meusDadosPerfil"));
                }
            }

            return (new ViewModel(array(
                "form" => $form,
                "mensagens" => $this->flashMessenger()->getCurrentMessages()
            )));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function meusDadosSenhaAction() {
        $usuario = $this->getEntityManager()->getRepository($this->entity)->find($this->usuarioId);

        if (!empty($usuario)) {
            $form = new \ISConfiguracao\Form\MeusDadosSenha();
            $form->setData($usuario->toArray());
            $request = $this->getRequest();

            if ($request->isPost()) {
                $form->setData($request->getPost());

                if ($form->isValid()) {
                    $request = $request->getPost()->toArray();
                    $autenticacao = $this->getEntityManager()->getRepository($this->entity)->autenticacao($usuario->getEmail(), $request["senha_atual"]);

                    if (!empty($autenticacao)) {
                        $this->getServiceLocator()->get($this->service)->updateMeusDadosSenha($request, $usuario);
                        $this->setMensagemSucesso("Sua senha foi atualizada.");

                        return $this->redirect()->toRoute($this->route, array("controller" => $this->controller, "action" => "meusDadosSenha"));
                    } else {
                        $this->setMensagemErro("A senha informada não confere com a atual.");
                    }
                }
            }

            return (new ViewModel(array(
                "form" => $form,
                "mensagens" => $this->flashMessenger()->getCurrentMessages()
            )));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function ativarRemoverAction() {
        if ($this->getAcesso()) {
            $usuario = $this->getEntityManager()->getRepository($this->entity)->find($this->params()->fromRoute('id', 0));

            if (!empty($usuario)) {
                $service = $this->getServiceLocator()->get($this->service);

                if ($usuario->getStatus()) {
                    $service->alterStatus($usuario->getId(), false);
                    $this->setMensagemSucesso($this->getMensagem('delete', 'success'));
                } else {
                    $validacao = $this->validarEmail($usuario->getId(), $usuario->getEmail());

                    if ($validacao) {
                        $service->alterStatus($usuario->getId(), true);
                        $this->setMensagemSucesso($this->getMensagem('ativar', 'success'));
                    } else {
                        $this->setMensagemErro("E-mail já cadastrado no sistema.");
                    }
                }

                return $this->redirect()->toRoute("isconfiguracao-admin/default", array("controller" => "usuarios", "action" => "index"));
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function autenticarComoAction() {
        if ($this->getAcesso() || !empty($this->sessao->getUsuario("usuarioSessao"))) {
            $usuario = $this->getEntityManager()->getRepository($this->entity)->find($this->params()->fromRoute("id", 0));

            if (!empty($usuario)) {
                $sessaoAut = new \ISConfiguracao\Permissions\SessaoAcl($this->getServiceLocator());

                if (empty($this->sessao->getUsuario("usuarioSessao"))) {
                    $sessaoAut->setAcl($usuario, $this->usuarioId);

                    return $this->redirect()->toRoute("home");
                } else {
                    $sessaoAut->setAcl($usuario, null);

                    return $this->redirect()->toRoute("isconfiguracao-admin/default", array("controller" => "usuarios", "action" => "index"));
                }
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function localizarAcessosAction() {
        $request = $this->getRequest();
        $retorno["sucesso"] = false;

        if ($request->isPost()) {
            $request = $request->getPost()->toArray();

            if (!empty($request["id"])) {
                $usuario = $this->getEntityManager()->getRepository($this->entity)->find($request["id"]);

                if (!empty($usuario)) {
                    $retorno["sucesso"] = true;
                    $retorno["conteudo"] = "<ul>";
                    $acessos = $this->getEntityManager()->getRepository("ISConfiguracao\Entity\UsuarioAcesso")->selecionarAcessosUsuario($usuario->getId(), 500);

                    foreach ($acessos as $acesso) {
                        $retorno["conteudo"] .= "<li>" . \ISBase\Util\DataHora::dateTimeToString($acesso["data"]) . "</li>";
                    }
                    $retorno["conteudo"] .= "</ul>";
                }
            }
        }

        return new JsonModel($retorno);
    }

    private function validarEmail($id, $email) {
        $usuario = $this->getEntityManager()->getRepository($this->entity)->selecionarPorEmailStatus($email);

        if ($usuario != null) {
            if ($id == $usuario->getId()) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

}

<?php

namespace ISBase\Controller;

use ISConfiguracao\Permissions\SessaoAcl;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Session\Container;

abstract class CrudController extends AbstractActionController {

    protected $em;
    protected $service;
    protected $entity;
    protected $form;
    protected $formSevice;
    protected $route;
    protected $controller;
    protected $actionNovo;
    protected $actionEditar;
    protected $actionRemover;
    protected $modulo;
    protected $funcionalidade;
    protected $messages;
    protected $sessao;
    protected $unidadeId;
    protected $usuarioId;

    public function __construct() {
        $this->sessao = new SessaoAcl();
        $this->unidadeId = $this->sessao->getUnidade("id");
        $this->usuarioId = $this->sessao->getUsuario("id");
        $this->usuarioAdmin = $this->sessao->getUsuario("administrador");
    }

    public function indexAction() {
        if ($this->getAcesso('ler')) {
            $list = $this->getEntityManager()->getRepository($this->entity)->findAll();
            $pagina = $this->params()->fromQuery('pagina', 1);

            $paginator = new Paginator(new ArrayAdapter($list));
            $paginator->setCurrentPageNumber($pagina)->setDefaultItemCountPerPage(15);

            return new ViewModel(array('dados' => $paginator, 'pagina' => $pagina, 'mensagens' => $this->flashMessenger()->getMessages()));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function novoAction() {
        if ($this->getAcesso()) {
            $form = $this->formSevice ? $this->getServiceLocator()->get($this->form) : new $this->form();
            $request = $this->getRequest();

            if ($request->isPost()) {
                $form->setData($request->getPost());

                if ($form->isValid()) {
                    $this->getServiceLocator()->get($this->service)->insert($request->getPost()->toArray());
                    $this->setMensagemSucesso($this->getMensagem('insert', 'success'));

                    return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => $this->actionNovo));
                }
            }

            return new ViewModel(array(
                'form' => $form,
                'mensagens' => $this->flashMessenger()->getMessages()
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function editarAction() {
        if ($this->getAcesso()) {
            $form = $this->formSevice ? $this->getServiceLocator()->get($this->form) : new $this->form();
            $repository = $this->getEntityManager()->getRepository($this->entity);
            $entity = $repository->find($this->params()->fromRoute('id', 0));

            if (!empty($entity)) {
                $form->setData($entity->toArray());
                $request = $this->getRequest();

                if ($request->isPost()) {
                    $form->setData($request->getPost());

                    if ($form->isValid()) {
                        $this->getServiceLocator()->get($this->service)->update($request->getPost()->toArray());
                        $this->setMensagemSucesso($this->getMensagem('edit', 'success'));

                        return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => $this->actionEditar, 'id' => $entity->getId()));
                    }
                }

                return new ViewModel(array(
                    'form' => $form,
                    'mensagens' => $this->flashMessenger()->getMessages()
                ));
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function removerAction() {
        if ($this->getAcesso()) {
            $service = $this->getServiceLocator()->get($this->service);

            if ($service->delete($this->params()->fromRoute('id', 0))) {
                $this->setMensagemSucesso($this->getMensagem('delete', 'success'));

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => $this->actionRemover));
            } else {
                $this->setMensagemErro($this->getMensagem('delete', 'error'));
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function ativarRemoverAction() {
        if ($this->getAcesso()) {
            $entity = $this->getEntityManager()->getRepository($this->entity)
                    ->find($this->params()->fromRoute('id', 0));

            if (!empty($entity)) {
                $service = $this->getServiceLocator()->get($this->service);

                if ($entity->getStatus()) {
                    $service->alterStatus($entity->getId(), false);
                    $this->setMensagemSucesso($this->getMensagem('delete', 'success'));
                } else {
                    $service->alterStatus($entity->getId(), true);
                    $this->setMensagemSucesso($this->getMensagem('ativar', 'success'));
                }

                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => $this->actionRemover));
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function autoCompliteAction() {
        $filtro = $this->params()->fromQuery('filtro', null);
        $entity = $this->entity;
        $result = [];

        if (!empty($filtro) && !empty($entity)) {
            $result = $this->getEntityManager()->getRepository($entity)->autoComplite($filtro);
        }

        return new JsonModel($result);
    }

    public function validarAcessoSimultaneo() {
        $usuarioSessao = $this->sessao->getUsuario();
        $usuario = $this->getEntityManager()->getRepository('ISConfiguracao\Entity\Usuario')->find($usuarioSessao['id']);

        if ($usuarioSessao['token'] != $usuario->getTokenWeb()) {
            $auth = new AuthenticationService();
            $auth->setStorage(new SessionStorage('ISConfiguracao'));
            $auth->clearIdentity();

            (new Container('ISConfiguracao'))->getManager()->getStorage()->clear();

            if (!empty($usuario->getTokenWeb())) {
                $this->setMensagemErro("No momento, sua conta está sendo usada em outro local. A sua conta é estritamente pessoal e só pode ser utilizada em um único dispositivo por vez.");
            } else {
                $this->setMensagemInformacao("Atualizamos o sistema, pra isso precisamos que você faça login novamente.");
            }

            return false;
        }

        return true;
    }

    public function getAcl($funcionalidade = null) {
        if (empty($funcionalidade)) {
            return $this->sessao->getAcl($this->modulo, $this->funcionalidade);
        } else {
            return $this->sessao->getAcl($this->modulo, $funcionalidade);
        }
    }

    public function getMensagem($action, $type) {
        return $this->messages[$type][$action];
    }

    public function getAcesso($privilegio = "escrever") {
        return $this->sessao->getAcl($this->modulo, $this->funcionalidade, $privilegio);
    }
    
    public function getAcesso2($funcionalidade, $privilegio = "escrever") {
        return $this->sessao->getAcl($this->modulo, $funcionalidade, $privilegio);
    }

    public function getAcessoFuncionalidade($funcionalidade, $privilegio = "escrever") {
        return $this->sessao->getAcl($this->modulo, $funcionalidade, $privilegio);
    }

    public function setMensagemInformacao($mensagem) {
        $this->flashMessenger()->addMessage(array("info" => $mensagem));
    }

    public function setMensagemSucesso($message) {
        $this->flashMessenger()->addMessage(array("success" => $message));
    }

    public function setMensagemErro($mensagem) {
        $this->flashMessenger()->addMessage(array("danger" => $mensagem));
    }

    public function getGlobalConfig($item = "sistema") {
        return $this->getServiceLocator()->get('Config')[$item];
    }

    protected function getEntityManager() {
        if (empty($this->em)) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }

        return $this->em;
    }

}

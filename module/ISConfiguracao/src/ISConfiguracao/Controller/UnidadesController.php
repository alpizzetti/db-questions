<?php

namespace ISConfiguracao\Controller;

use ISBase\Controller\CrudController as CrudController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class UnidadesController extends CrudController {

    public function __construct() {
        parent::__construct();

        $this->entity = 'ISConfiguracao\Entity\Unidade';
        $this->form = 'ISConfiguracao\Form\Unidade';
        $this->formSevice = false;
        $this->service = 'ISConfiguracao\Service\Unidade';
        $this->controller = 'unidades';
        $this->route = 'isconfiguracao-admin/default';
        $this->actionNovo = 'novo';
        $this->actionEditar = 'editar';
        $this->actionRemover = 'index';
        $this->modulo = 'configuracoes';
        $this->funcionalidade = 'unidades';
        $this->messages = array(
            'success' => array(
                'insert' => 'Inserida com sucesso.',
                'edit' => 'Editada com sucesso.',
                'delete' => 'Excluída com sucesso.',
                'ativar' => 'Ativada com sucesso.'
            ),
            'error' => array(
                'insert' => 'Erro ao inserir.',
                'edit' => 'Erro ao editar.',
                'delete' => 'Erro ao remover.',
                'ativar' => 'Erro ao ativar.'
            )
        );
    }

    public function indexAction() {
        if ($this->getAcesso('ler')) {
            $request['status'] = $this->params()->fromQuery('status', 1);
            $request['estado'] = $this->params()->fromQuery('estado', null);
            $request['franquia'] = $this->params()->fromQuery('franquia', null);
            $request['filtro'] = $this->params()->fromQuery('filtro', null);
            $request['pagina'] = $this->params()->fromQuery('pagina', 1);

            $filtros = $request['status'] != 1 ? "&status=" . $request['status'] : "";
            $filtros .= !empty($request['estado']) ? "&estado=" . $request['estado'] : "";
            $filtros .= !empty($request['franquia']) ? "&franquia=" . $request['franquia'] : "";
            $filtros .= !empty($request['filtro']) ? "&filtro=" . $request['filtro'] : "";

            $form = $this->getServiceLocator()->get("ISConfiguracao\Form\UnidadeIndex");
            
            return new ViewModel(array(
                'filtros' => $filtros,
                'acl' => $this->getAcl(),
                'form' => $form->setData($request),
                'mensagens' => $this->flashMessenger()->getMessages(),
                'dados' => $this->getEntityManager()->getRepository($this->entity)->listagemIndex($request),
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }
    
    public function novoAction() {
        if ($this->getAcesso()) {
            $form = $this->getServiceLocator()->get($this->form);
            $request = $this->getRequest();

            if ($request->isPost()) {
                $form->setData($request->getPost());
                $request = $request->getPost()->toArray();
                $form->setInputFilter(new \ISConfiguracao\Form\UnidadeFilter($request['pessoa']));

                if ($form->isValid()) {
                    $this->getServiceLocator()->get($this->service)->insert($request);
                    $this->setMensagemSucesso($this->getMensagem('insert', 'success'));

                    return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => $this->actionNovo));
                }
            } else {
                $request = [];
                $request['pessoa'] = "PJ";
            }

            return new ViewModel(array(
                'form' => $form,
                'pessoa' => $request['pessoa'],
                'mensagens' => $this->flashMessenger()->getCurrentMessages()
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }
    
    public function editarAction() {
        if ($this->getAcesso()) {
            $unidade = $this->getEntityManager()->getRepository($this->entity)->find($this->params()->fromRoute('id', 0));

            if (!empty($unidade)) {
                $form = $this->getServiceLocator()->get($this->form);
                $form->setData($unidade->toArray());
                $request = $this->getRequest();

                if ($request->isPost()) {
                    $form->setData($request->getPost());
                    $request = $request->getPost()->toArray();
                    $form->setInputFilter(new \ISConfiguracao\Form\UnidadeFilter($request['pessoa']));

                    if ($form->isValid()) {
                        $this->getServiceLocator()->get($this->service)->update($request);
                        $this->setMensagemSucesso($this->getMensagem('edit', 'success'));

                        return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => $this->actionEditar, 'id' => $unidade->getId()));
                    }
                } else {
                    $request = [];
                    $request['pessoa'] = $unidade->getPessoa();
                }

                return new ViewModel(array(
                    'form' => $form,
                    'unidade' => $unidade,
                    'pessoa' => $request['pessoa'],
                    'mensagens' => $this->flashMessenger()->getMessages()
                ));
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
                $unidade = $this->getEntityManager()->getRepository($this->entity)->find($request["id"]);

                if (!empty($unidade)) {
                    $retorno["sucesso"] = true;
                    $retorno['conteudo'] = "<ul>";
                    $acessos = $this->getEntityManager()->getRepository("ISConfiguracao\Entity\UsuarioAcesso")->selecionarAcessosUnidade($unidade->getId(), 500);

                    foreach ($acessos as $acesso) {
                        $retorno['conteudo'] .= "<li>" . \ISBase\Util\DataHora::dateTimeToString($acesso['data']) . " - " . $acesso['nome'] . "</li>";
                    }
                    $retorno['conteudo'] .= "</ul>";
                }
            }
        }

        return new JsonModel($retorno);
    }

}

<?php

namespace ISConfiguracao\Controller;

use ISBase\Controller\CrudController;
use Zend\View\Model\ViewModel;

class PrivilegiosController extends CrudController
{
    public function __construct()
    {
        parent::__construct();

        $this->entity = 'ISConfiguracao\Entity\Privilegio';
        $this->form = 'ISConfiguracao\Form\Privilegio';
        $this->formSevice = true;
        $this->service = 'ISConfiguracao\Service\Privilegio';
        $this->controller = 'privilegios';
        $this->route = 'isconfiguracao-admin/default';
        $this->actionNovo = 'novo';
        $this->actionEditar = 'editar';
        $this->actionRemover = 'index';
        $this->modulo = 'configuracoes';
        $this->funcionalidade = 'acl';
        $this->messages = array(
            'success' => array(
                'insert' => 'Inserido com sucesso.',
                'edit' => 'Editado com sucesso.',
                'delete' => 'Excluído com sucesso.',
                'ativar' => 'Ativado com sucesso.'
            ),
            'error' => array(
                'insert' => 'Erro ao inserir.',
                'edit' => 'Erro ao editar.',
                'delete' => 'Erro ao remover.',
                'ativar' => 'Erro ao ativar.'
            )
        );
    }

    public function indexAction()
    {
        if ($this->getAcesso('ler')) {
            $form = $this->getServiceLocator()->get("ISConfiguracao\Form\PrivelegioIndex");
            $request['pagina'] = $this->params()->fromQuery('pagina', 1);
            $request['grupo'] = $this->params()->fromQuery("grupo", "");
            $request['funcionalidade'] = $this->params()->fromQuery("funcionalidade", "");

            $filtros = !empty($request['grupo']) ? "&grupo=" . $request['grupo'] : "";
            $filtros .= !empty($request['funcionalidade']) ? "&funcionalidade=" . $request['funcionalidade'] : "";

            return new ViewModel(array(
                "filtros" => $filtros,
                'acl' => $this->getAcl(),
                "form" => $form->setData($request),
                'mensagens' => $this->flashMessenger()->getMessages(),
                'dados' => $this->getEntityManager()
                    ->getRepository($this->entity)
                    ->listagemIndex($request)
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function novoAction()
    {
        if ($this->getAcesso()) {
            $form = $this->getServiceLocator()->get($this->form);
            $request = $this->getRequest();

            if ($request->isPost()) {
                $form->setData($request->getPost());

                if ($form->isValid()) {
                    $service = $this->getServiceLocator()->get($this->service);
                    $service->insert($request->getPost()->toArray());
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

    public function editarAction()
    {
        if ($this->getAcesso()) {
            $form = $this->getServiceLocator()->get($this->form);
            $privilegios = $this->getEntityManager()
                ->getRepository($this->entity)
                ->find($this->params()->fromRoute('id', 0));

            if (!empty($privilegios)) {
                $form->setData($privilegios->toArray());
                $request = $this->getRequest();

                if ($request->isPost()) {
                    $form->setData($request->getPost());

                    if ($form->isValid()) {
                        $this->getServiceLocator()
                            ->get($this->service)
                            ->update($request->getPost()->toArray());
                        $this->setMensagemSucesso($this->getMensagem('edit', 'success'));

                        return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => $this->actionEditar, 'id' => $privilegios->getId()));
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

    public function removerAction()
    {
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
}

<?php

namespace ISCadastro\Controller;

use ISBase\Controller\CrudController as CrudController;
use Zend\View\Model\ViewModel;

class QuestoesController extends CrudController
{

    public function __construct()
    {
        parent::__construct();

        $this->entity = 'ISCadastro\Entity\Questao';
        $this->service = 'ISCadastro\Service\Questao';
        $this->form = 'ISCadastro\Form\Questao';
        $this->controller = 'questoes';
        $this->formSevice = true;
        $this->route = 'iscadastro-admin/default';
        $this->actionNovo = 'novo';
        $this->actionEditar = 'editar';
        $this->actionRemover = 'index';
        $this->modulo = 'cadastros';
        $this->funcionalidade = 'questoes';
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

    public function indexAction()
    {
        if ($this->getAcesso('ler')) {
            $request['status'] = $this->params()->fromQuery('status', 1);
            $request['filtro'] = $this->params()->fromQuery('filtro', null);
            $request['dificuldade'] = $this->params()->fromQuery('dificuldade', null);
            $request['unidade_curricular'] = $this->params()->fromQuery('unidade', null);
            $request['pagina'] = $this->params()->fromQuery('pagina', 1);

            $filtros = $request['status'] != 1 ? "&status=" . $request['status'] : "";
            $filtros .= !empty($request['filtro']) ? "&filtro=" . $request['filtro'] : "";
            $filtros .= !empty($request['dificuldade']) ? "&dificuldade=" . $request['dificuldade'] : "";
            $filtros .= !empty($request['unidade']) ? "&unidade=" . $request['unidade'] : "";

            return new ViewModel(array(
                'filtros' => $filtros,
                'acl' => $this->getAcl(),
                'mensagens' => $this->flashMessenger()->getMessages(),
                'dados' => $this->getEntityManager()->getRepository($this->entity)->listagemIndex($request),
                'form' => $this->getServiceLocator()->get('ISCadastro\Form\QuestaoIndex')->setData($request)
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
                    $request = $request->getPost()->toArray();
                    $request['usuarioId'] = $this->usuarioId;

                    $this->getServiceLocator()->get($this->service)->insert($request);
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
}

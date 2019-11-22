<?php

namespace ISConfiguracao\Controller;

use ISBase\Controller\CrudController as CrudController;
use Zend\View\Model\ViewModel;

class CursosController extends CrudController
{
    public function __construct()
    {
        parent::__construct();
        $this->entity = 'ISConfiguracao\Entity\Curso';
        $this->service = 'ISConfiguracao\Service\Curso';
        $this->form = 'ISConfiguracao\Form\Curso';
        $this->controller = 'cursos';
        $this->formSevice = true;
        $this->route = 'isconfiguracao-admin/default';
        $this->actionNovo = 'novo';
        $this->actionEditar = 'editar';
        $this->actionRemover = 'index';
        $this->modulo = 'configuracoes';
        $this->funcionalidade = 'cursos';
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
            $request['nome'] = $this->params()->fromQuery('nome', null);
            $request['pagina'] = $this->params()->fromQuery('pagina', 1);
            $request['unidade'] = $this->params()->fromQuery('unidade', null);
            $request['tipo'] = $this->params()->fromQuery('tipo', null);

            $filtros = $request['status'] != 1 ? "&status=" . $request['status'] : "";
            $filtros .= !empty($request['nome']) ? "&nome=" . $request['nome'] : "";
            $filtros .= !empty($request['unidade']) ? "&unidade=" . $request['unidade'] : "";
            $filtros .= !empty($request['tipo']) ? "&tipo=" . $request['tipo'] : "";

            return new ViewModel(array(
                'filtros' => $filtros,
                'acl' => $this->getAcl(),
                'mensagens' => $this->flashMessenger()->getMessages(),
                'form' => $this->getServiceLocator()
                    ->get('ISConfiguracao\Form\CursoIndex')
                    ->setData($request),
                'dados' => $this->getEntityManager()
                    ->getRepository($this->entity)
                    ->listagemIndex($request)
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }
}

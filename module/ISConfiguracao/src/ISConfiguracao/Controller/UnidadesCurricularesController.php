<?php

namespace ISConfiguracao\Controller;

use ISBase\Controller\CrudController as CrudController;
use Zend\View\Model\ViewModel;

class UnidadesCurricularesController extends CrudController {

    public function __construct() {
        parent::__construct();

        $this->entity = 'ISConfiguracao\Entity\UnidadeCurricular';
        $this->service = 'ISConfiguracao\Service\UnidadeCurricular';
        $this->form = 'ISConfiguracao\Form\UnidadeCurricular';
        $this->controller = 'unidadescurriculares';
        $this->formSevice = true;
        $this->route = 'isconfiguracao-admin/default';
        $this->actionNovo = 'novo';
        $this->actionEditar = 'editar';
        $this->actionRemover = 'index';
        $this->modulo = 'configuracoes';
        $this->funcionalidade = 'unidadescurriculares';
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
            $request['pagina'] = $this->params()->fromQuery('pagina', 1);
            $request['nome'] = $this->params()->fromQuery('nome', null);
            $request['cursos'] = $this->params()->fromQuery('cursos', null);

            $filtros = $request['status'] != 1 ? "&status=" . $request['status'] : "";
            $filtros .= !empty($request['nome']) ? "&nome=" . $request['nome'] : "";
            $filtros .= !empty($request['cursos']) ? "&cursos=" . $request['cursos'] : "";

            return new ViewModel(array(
                'filtros' => $filtros,
                'acl' => $this->getAcl(),
                'mensagens' => $this->flashMessenger()->getMessages(),
                'dados' => $this->getEntityManager()->getRepository($this->entity)->listagemIndex($request),
                'form' => $this->getServiceLocator()->get('ISConfiguracao\Form\UnidadeCurricularIndex')->setData($request)
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

}

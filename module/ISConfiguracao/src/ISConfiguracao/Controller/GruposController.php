<?php

namespace ISConfiguracao\Controller;

use ISBase\Controller\CrudController;
use Zend\View\Model\ViewModel;

class GruposController extends CrudController {

    public function __construct() {
        parent::__construct();

        $this->entity = 'ISConfiguracao\Entity\Grupo';
        $this->service = 'ISConfiguracao\Service\Grupo';
        $this->form = 'ISConfiguracao\Form\Grupo';
        $this->controller = 'grupos';
        $this->formSevice = false;
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

    public function indexAction() {
        if ($this->getAcesso('ler')) {
            $request['nome'] = $this->params()->fromQuery("nome", "");
            $request['status'] = $this->params()->fromQuery("status", 1);
            $request['pagina'] = $this->params()->fromQuery("pagina", 1);

            $filtros = !empty($request['nome']) ? "&nome=" . $request['nome'] : "";
            $filtros .= $request['status'] != 1 ? "&status=" . $request['status'] : "";

            return new ViewModel(array(
                "filtros" => $filtros,
                'acl' => $this->getAcl(),
                "mensagens" => $this->flashMessenger()->getMessages(),
                "form" => (new \ISConfiguracao\Form\GrupoIndex())->setData($request),
                "dados" => $this->getEntityManager()->getRepository($this->entity)->listagemIndex($request)
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

}

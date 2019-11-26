<?php

namespace ISConfiguracao\Controller;

use ISBase\Controller\CrudController as CrudController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CapacidadesController extends CrudController
{
    public function __construct()
    {
        parent::__construct();

        $this->entity = 'ISConfiguracao\Entity\Capacidade';
        $this->service = 'ISConfiguracao\Service\Capacidade';
        $this->form = 'ISConfiguracao\Form\Capacidade';
        $this->controller = 'capacidades';
        $this->formSevice = true;
        $this->route = 'isconfiguracao-admin/default';
        $this->actionNovo = 'novo';
        $this->actionEditar = 'editar';
        $this->actionRemover = 'index';
        $this->modulo = 'configuracoes';
        $this->funcionalidade = 'capacidades';
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
            $request['pagina'] = $this->params()->fromQuery('pagina', 1);
            $request['numero'] = $this->params()->fromQuery('numero', null);
            $request['unidadeCurricular'] = $this->params()->fromQuery('unidadeCurricular', null);

            $filtros = $request['status'] != 1 ? "&status=" . $request['status'] : "";
            $filtros .= !empty($request['numero']) ? "&numero=" . $request['numero'] : "";
            $filtros .= !empty($request['unidadeCurricular']) ? "&unidadeCurricular=" . $request['unidadeCurricular'] : "";

            return new ViewModel(array(
                'filtros' => $filtros,
                'acl' => $this->getAcl(),
                'mensagens' => $this->flashMessenger()->getMessages(),
                'dados' => $this->getEntityManager()
                    ->getRepository($this->entity)
                    ->listagemIndex($request),
                'form' => $this->getServiceLocator()
                    ->get('ISConfiguracao\Form\CapacidadeIndex')
                    ->setData($request)
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function carregarCapacidadesAction()
    {
        $request = $this->getRequest();
        $retorno["sucesso"] = false;

        if ($request->isPost()) {
            $request = $request->getPost()->toArray();
            $capacidades = $this->getEntityManager()
                ->getRepository($this->entity)
                ->popularCombobox($request["unidadeCurricular"]);
            $retorno["capacidades"] = "<option value=''>Selecione</option>";

            if (!empty($capacidades)) {
                $retorno["sucesso"] = true;

                foreach ($capacidades as $key => $unidadeCurricular) {
                    $retorno["capacidades"] .= "<option value='" . $key . "'>" . $unidadeCurricular . "</option>";
                }
            }
        }

        return new JsonModel($retorno);
    }
}

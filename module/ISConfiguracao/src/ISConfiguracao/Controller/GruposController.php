<?php

namespace ISConfiguracao\Controller;

use ISBase\Controller\CrudController;
use Zend\View\Model\ViewModel;

class GruposController extends CrudController {

    public function __construct() {
        parent::__construct();

        $this->entity = 'ISConfiguracao\Entity\Grupo';
        $this->service = 'ISConfiguracao\Service\Grupo';
        $this->controller = 'grupos';
        $this->funcionalidade = 'acl';
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
                "mensagens" => $this->flashMessenger()->getMessages(),
                "form" => (new \ISConfiguracao\Form\GrupoIndex())->setData($request),
                "dados" => $this->getEntityManager()->getRepository($this->entity)->listagemIndex($request)
            ));
        }

        return $this->notFoundAction()->setTerminal(true);
    }

}

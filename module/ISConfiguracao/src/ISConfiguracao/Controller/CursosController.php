<?php

namespace ISConfiguracao\Controller;

use ISBase\Controller\CrudController as CrudController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class CursosController extends CrudController
{

  public function __construct()
  {
    parent::__construct();

    $this->entity = 'ISConfiguracao\Entity\Cursos';
    $this->service = 'ISConfiguracao\Service\Cursos';
    $this->form = 'ISConfiguracao\Form\Cursos';
    $this->controller = 'cursos';
    $this->formSevice = false;
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
      $request['estado'] = $this->params()->fromQuery('estado', null);
      $request['filtro'] = $this->params()->fromQuery('filtro', null);
      $request['pagina'] = $this->params()->fromQuery('pagina', 1);

      $filtros = $request['status'] != 1 ? "&status=" . $request['status'] : "";
      $filtros .= !empty($request['estado']) ? "&estado=" . $request['estado'] : "";
      $filtros .= !empty($request['filtro']) ? "&filtro=" . $request['filtro'] : "";

      $form = new \ISConfiguracao\Form\CursoIndex();

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

  public function localizarAcessosAction()
  {
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

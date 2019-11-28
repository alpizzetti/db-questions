<?php

namespace ISCadastro\Controller;

use ISBase\Controller\CrudController as CrudController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

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
                'insert' => 'Inserida com sucesso, agora você pode fazer o upload das imagens se necessário.',
                'edit' => 'Editada com sucesso.',
                'delete' => 'Marcada como pendente com sucesso.',
                'ativar' => 'Validada com sucesso.'
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
                'dados' => $this->getEntityManager()
                    ->getRepository($this->entity)
                    ->listagemIndex($request),
                'form' => $this->getServiceLocator()
                    ->get('ISCadastro\Form\QuestaoIndex')
                    ->setData($request)
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
                $request = $request->getPost()->toArray();

                if ($form->isValid()) {
                    $request['usuarioId'] = $this->usuarioId;
                    $questao = $this->getServiceLocator()
                        ->get($this->service)
                        ->insert($request);
                    $this->setMensagemSucesso($this->getMensagem('insert', 'success'));

                    return $this->redirect()->toRoute($this->route, array(
                        'controller' => $this->controller,
                        'action' => $this->actionEditar,
                        'id' => $questao->getId()
                    ));
                } elseif (!empty($request['unidade_curricular'])) {
                    $capacidades = $this->getEntityManager()
                        ->getRepository('ISConfiguracao\Entity\Capacidade')
                        ->popularCombobox($request["unidade_curricular"]);
                    $form->get("capacidade")->setValueOptions($capacidades);
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
            $questao = $this->getEntityManager()
                ->getRepository($this->entity)
                ->find($this->params()->fromRoute('id', 0));

            if (!empty($questao)) {
                $form->setData($questao->toArray());
                $request = $this->getRequest();

                if ($request->isPost()) {
                    $form->setData($request->getPost());
                    $request = $request->getPost()->toArray();

                    if ($form->isValid()) {
                        $this->getServiceLocator()
                            ->get($this->service)
                            ->update($request);
                        $this->setMensagemSucesso($this->getMensagem('edit', 'success'));

                        return $this->redirect()->toRoute($this->route, array(
                            'controller' => $this->controller,
                            'action' => $this->actionEditar,
                            'id' => $questao->getId()
                        ));
                    }
                } else {
                    $capacidades = $this->getEntityManager()
                        ->getRepository('ISConfiguracao\Entity\Capacidade')
                        ->popularCombobox($questao->getUnidadeCurricular()->getId());
                    $form->get("capacidade")->setValueOptions($capacidades);
                }

                return new ViewModel(array(
                    'form' => $form,
                    'mensagens' => $this->flashMessenger()->getMessages(),
                    'tabela_imagens' => $this->imagensTabela($questao->getImagens())
                ));
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function imagensEnviarAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $retorno['sucesso'] = false;
            $dados = $request->getPost()->toArray();
            $imagens = $request->getFiles()->toArray();
            $retorno['mensagem'] = $this->imagensValidarFormulario($imagens, $dados);

            if (empty($retorno['mensagem'])) {
                $retorno['sucesso'] = $this->getServiceLocator()
                    ->get($this->service)
                    ->imagensEnviar($imagens['imagens'], $dados);
                $imagens = $this->getEntityManager()
                    ->getRepository('ISCadastro\Entity\QuestaoImagem')
                    ->selecionarImagens($dados['id']);
                $retorno['tabela_imagens'] = $this->imagensTabela($imagens);
            }

            return new JsonModel($retorno);
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    public function imagensRemoverAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $request = $request->getPost()->toArray();
            $retorno['mensagem'] = null;
            $retorno['sucesso'] = false;

            if (!empty($request['id'])) {
                $imagem = $this->getEntityManager()
                    ->getRepository('ISCadastro\Entity\QuestaoImagem')
                    ->find($request['id']);

                if (!empty($imagem)) {
                    $retorno['sucesso'] = $this->getServiceLocator()
                        ->get($this->service)
                        ->imagensRemover($imagem);
                    $questao = $this->getEntityManager()
                        ->getRepository($this->entity)
                        ->find($imagem->getQuestao()->getId());
                    $retorno['tabela_imagens'] = $this->imagensTabela($questao->getImagens());
                } else {
                    $retorno['mensagem'] = "ID inválido.";
                }
            } else {
                $retorno['mensagem'] = "ID inválido.";
            }

            return new JsonModel($retorno);
        }

        return $this->notFoundAction();
    }

    public function ativarRemoverAction()
    {
        if ($this->getAcesso()) {
            $questao = $this->getEntityManager()
                ->getRepository($this->entity)
                ->find($this->params()->fromRoute('id', 0));

            if (!empty($questao)) {
                $service = $this->getServiceLocator()->get($this->service);

                if ($questao->getStatus()) {
                    $service->alterStatus($questao->getId(), false);
                    $this->setMensagemSucesso($this->getMensagem('delete', 'success'));

                    return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'action' => $this->actionRemover));
                } else {
                    $service->alterStatus($questao->getId(), true);
                    $this->setMensagemSucesso($this->getMensagem('ativar', 'success'));

                    return $this->redirect()->toUrl("/mod-cadastro/questoes/index?status=0");
                }
            }
        }

        return $this->notFoundAction()->setTerminal(true);
    }

    private function imagensValidarFormulario($imagens, $dados)
    {
        $retorno = "";

        if (empty($dados['item'])) {
            $retorno .= "Informe o item<br/>";
        }
        if (!empty($imagens['imagens'])) {
            foreach ($imagens['imagens'] as $imagem) {
                $extensao = pathinfo($imagem["name"], PATHINFO_EXTENSION);

                if (!in_array($extensao, ["jpg", "JPG", "jpeg", "JPEG", "png", "PNG"])) {
                    $retorno .= "Extensões permitidas: jpg ou png<br/>";
                }
                if (filesize($imagem['tmp_name']) > 20971520) {
                    //20MB
                    $retorno .= "Arquivo muito grande, limite 20mb<br/>";
                }
            }
        } else {
            $retorno .= "Informe uma ou mais imagens.";
        }

        return $retorno;
    }

    private function imagensTabela($imagens)
    {
        $model = new ViewModel();
        $model->setTemplate("is-cadastro/questoes/tabela-imagens.phtml");
        $model->setOption('has_parent', true);
        $model->setVariables(['imagens' => $imagens]);

        return $this->getServiceLocator()
            ->get('View')
            ->render($model);
    }
}

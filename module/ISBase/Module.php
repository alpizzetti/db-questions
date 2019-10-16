<?php

namespace ISBase;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
use Zend\ModuleManager\ModuleManager;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $e->getApplication()->getServiceManager()->get('viewhelpermanager')->setFactory('controllerName', function($sm) use ($e) {
            $viewHelper = new \ISBase\View\Helper\ControllerName($e->getRouteMatch());
            return $viewHelper;
        });

        (new ModuleRouteListener())->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function($e) {
            $result = $e->getResult();
            $result->setTerminal(true);
        });
        
        $sm = $e->getApplication()->getServiceManager();
        $viewModel = $e->getApplication()->getMvcEvent()->getViewModel();
        $viewModel->url = $sm->get('Config')['sistema']['url'];
        
        $app = $e->getApplication();
        $app->getEventManager()->attach('dispatch', function($e) {
            $routeMatch = $e->getRouteMatch();
            $viewModel = $e->getViewModel();
            $viewModel->setVariable('controller', $routeMatch->getParam('controller'));
            $viewModel->setVariable('action', $routeMatch->getParam('action'));
        }, -100);
    }

    public function init(ModuleManager $moduleManager) {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController', MvcEvent::EVENT_DISPATCH, array($this, 'validaAuth'), 100);
    }

    public function validaAuth($e) {
        $auth = new AuthenticationService();
        $auth->setStorage(new SessionStorage('ISConfiguracao'));

        $controller = $e->getTarget();
        $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();

        if (!$auth->hasIdentity() && ($matchedRoute == 'home' || $matchedRoute == 'autoCompliteLogradouro'
                || $matchedRoute == 'iscadastro-admin' || $matchedRoute == 'iscadastro-admin/default'
                || $matchedRoute == 'isconfiguracao-admin' || $matchedRoute == 'isconfiguracao-admin/default'
                || $matchedRoute == 'isrelatorio-admin' || $matchedRoute == 'isrelatorio-admin/default'
                || $matchedRoute == 'isfinanceiro-admin' || $matchedRoute == 'isfinanceiro-admin/default'
                || $matchedRoute == 'isvenda-admin' || $matchedRoute == 'isvenda-admin/default')) {
            return $controller->redirect()->toRoute('isconfiguracao-autenticacao-entrar');
        }
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}

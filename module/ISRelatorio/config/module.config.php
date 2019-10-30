<?php

namespace ISConfiguracao;

return array(
    'router' => array(
        'routes' => array(
            'isconfiguracao-autenticacao-entrar' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/usuarios/entrar',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ISConfiguracao\Controller',
                        'controller' => 'Autenticacao',
                        'action' => 'entrar'
                    )
                )
            ),
            'isconfiguracao-autenticacao-sair' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/usuarios/sair',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ISConfiguracao\Controller',
                        'controller' => 'Autenticacao',
                        'action' => 'sair'
                    )
                )
            ),
            'isconfiguracao-autenticacao-senha-redefinir' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/usuarios/senha/redefinir',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ISConfiguracao\Controller',
                        'controller' => 'Autenticacao',
                        'action' => 'senhaRedefinir'
                    )
                )
            ),
            'isconfiguracao-autenticacao-senha-confirmar' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/usuarios/senha/redefinir/confirmar',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ISConfiguracao\Controller',
                        'controller' => 'Autenticacao',
                        'action' => 'senhaConfirmar'
                    )
                )
            ),
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ISConfiguracao\Controller',
                        'controller' => 'Usuarios',
                        'action' => 'index'
                    )
                )
            ),
            'isconfiguracao-admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/mod-configuracoes',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ISConfiguracao\Controller',
                        'controller' => 'Usuarios',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+'
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'ISConfiguracao\Controller',
                                'controller' => 'usuarios'
                            )
                        )
                    )
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'ISConfiguracao\Controller\Autenticacao' => 'ISConfiguracao\Controller\AutenticacaoController',
            'ISConfiguracao\Controller\Grupos' => 'ISConfiguracao\Controller\GruposController',
            'ISConfiguracao\Controller\Privilegios' => 'ISConfiguracao\Controller\PrivilegiosController',
            'ISConfiguracao\Controller\Unidades' => 'ISConfiguracao\Controller\UnidadesController',
            'ISConfiguracao\Controller\Usuarios' => 'ISConfiguracao\Controller\UsuariosController',
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/500',
        'template_map' => array(
            'partials/notificacoes' => __DIR__ . '/../../ISBase/view/partials/notificacoes.phtml',
            'partials/paginacao' => __DIR__ . '/../../ISBase/view/partials/paginacao.phtml',
            'layout/layout' => __DIR__ . '/../../ISBase/view/layout/is-base.phtml',
            'error/404' => __DIR__ . '/../../ISBase/view/error/404.phtml',
            'error/500' => __DIR__ . '/../../ISBase/view/error/500.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    )
);
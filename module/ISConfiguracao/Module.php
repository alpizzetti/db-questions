<?php

namespace ISConfiguracao;

use ISConfiguracao\Auth\Adapter as AuthAdapter;
use Zend\Mail\Transport\Smtp as SmtpTransport,
    Zend\Mail\Transport\SmtpOptions;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'ISConfiguracao\Form\UsuarioIndex' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $grupos = $em->getRepository('ISConfiguracao\Entity\Grupo')->popularCombobox();
                    $unidades = $em->getRepository('ISConfiguracao\Entity\Unidade')->popularCombobox();

                    return new Form\UsuarioIndex('usuarioIndex', $grupos, $unidades);
                },
                'ISConfiguracao\Form\UnidadeCurricularIndex' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $cursos = $em->getRepository('ISConfiguracao\Entity\Curso')->popularCombobox();

                    return new Form\UnidadeCurricularIndex($cursos);
                },
                'ISConfiguracao\Form\UnidadeCurricular' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $cursos = $em->getRepository('ISConfiguracao\Entity\Curso')->popularCombobox();

                    return new Form\UnidadeCurricular($cursos);
                },
                'ISConfiguracao\Form\UsuarioDados' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $grupos = $em->getRepository('ISConfiguracao\Entity\Grupo')->popularCombobox();
                    $unidades = $em->getRepository('ISConfiguracao\Entity\Unidade')->popularCombobox();

                    return new Form\UsuarioDados('usuario', $grupos, $unidades);
                },
                'ISConfiguracao\Form\Privilegio' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $grupos = $em->getRepository('ISConfiguracao\Entity\Grupo')->popularCombobox();
                    $funcionalidades = $em->getRepository('ISConfiguracao\Entity\Funcionalidade')->popularCombobox();

                    return new Form\Privilegio('privilegio', $grupos, $funcionalidades);
                },
                'ISConfiguracao\Form\PrivelegioIndex' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $grupos = $em->getRepository('ISConfiguracao\Entity\Grupo')->popularCombobox();
                    $funcionalidades = $em->getRepository('ISConfiguracao\Entity\Funcionalidade')->popularCombobox();

                    return new Form\PrivelegioIndex('privilegioIndex', $grupos, $funcionalidades);
                },
                'ISConfiguracao\Form\CursoIndex' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $unidades = $em->getRepository('ISConfiguracao\Entity\Unidade')->popularCombobox();

                    return new Form\CursoIndex($unidades);
                },
                'ISConfiguracao\Form\Curso' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $unidades = $em->getRepository('ISConfiguracao\Entity\Unidade')->popularCombobox();

                    return new Form\Curso($unidades);
                },
                'ISConfiguracao\Service\Privilegio' => function ($sm) {
                    return new Service\Privilegio($sm->get('Doctrine\ORM\Entitymanager'));
                },
                'ISConfiguracao\Service\Unidade' => function ($sm) {
                    return new Service\Unidade($sm->get('Doctrine\ORM\EntityManager'));
                },
                'ISConfiguracao\Service\Curso' => function ($sm) {
                    return new Service\Curso($sm->get('Doctrine\ORM\EntityManager'));
                },
                'ISConfiguracao\Service\Grupo' => function ($sm) {
                    return new Service\Grupo($sm->get('Doctrine\ORM\EntityManager'));
                },
                'ISConfiguracao\Service\UnidadeCurricular' => function ($sm) {
                    return new Service\UnidadeCurricular($sm->get('Doctrine\ORM\EntityManager'));
                },
                'ISConfiguracao\Service\Usuario' => function ($sm) {
                    return new Service\Usuario($sm->get('Doctrine\ORM\EntityManager'), $sm->get('ISConfiguracao\Mail\Transport'), $sm->get('View'));
                },
                'ISConfiguracao\Auth\Adapter' => function ($sm) {
                    return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
                },
                'ISConfiguracao\Permissions\Acl' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');

                    $repoGrupo = $em->getRepository('ISConfiguracao\Entity\Grupo');
                    $grupos = $repoGrupo->findAll();

                    $repoFuncionalidade = $em->getRepository('ISConfiguracao\Entity\Funcionalidade');
                    $funcionalidades = $repoFuncionalidade->findAll();

                    $repoPrivilegio = $em->getRepository('ISConfiguracao\Entity\Privilegio');
                    $privilegios = $repoPrivilegio->findAll();

                    return new Permissions\Acl($grupos, $funcionalidades, $privilegios);
                },
                'ISConfiguracao\Mail\Transport' => function ($sm) {
                    $config = $sm->get('Config');
                    $transport = new SmtpTransport();
                    $options = new SmtpOptions($config['mail']);
                    $transport->setOptions($options);

                    return $transport;
                },
            )
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'UsuarioAcesso' => function ($serviceManager) {
                    $serviceLocator = $serviceManager->getServiceLocator();

                    return new View\Helper\UsuarioAcesso($serviceLocator);
                }
            )
        );
    }
}

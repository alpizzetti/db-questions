<?php

namespace ISCadastro;

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
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'ISCadastro\Form\QuestaoIndex' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $unidadesCurriculares = $em->getRepository('ISConfiguracao\Entity\UnidadeCurricular')->popularCombobox();

                    return new Form\QuestaoIndex($unidadesCurriculares);
                },
                'ISCadastro\Form\Questao' => function ($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $unidadesCurriculares = $em->getRepository('ISConfiguracao\Entity\UnidadeCurricular')->popularCombobox();

                    return new Form\Questao($unidadesCurriculares);
                },
                'ISCadastro\Service\Questao' => function ($sm) {
                    return new Service\Questao($sm->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }
}

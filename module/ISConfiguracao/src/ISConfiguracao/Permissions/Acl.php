<?php

namespace ISConfiguracao\Permissions;

use Zend\Permissions\Acl\Acl as ClassAcl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Acl extends ClassAcl
{
    protected $grupos;
    protected $funcionalidades;
    protected $privilegios;

    public function __construct(array $grupos, array $funcionalidades, array $privilegios)
    {
        $this->grupos = $grupos;
        $this->funcionalidades = $funcionalidades;
        $this->privilegios = $privilegios;

        $this->carregarGrupos();
        $this->carregarFuncionalidades();
        $this->carregarPrivilegios();
    }

    protected function carregarGrupos()
    {
        foreach ($this->grupos as $grupo) {
            if ($grupo->getHerda()) {
                $this->addRole(new Role($grupo->getNome()), new Role($grupo->getHerda()->getNome()));
            } else {
                $this->addRole(new Role($grupo->getNome()));
            }

            if ($grupo->getAdministrador()) {
                $this->allow($grupo->getNome(), array(), array());
            }
        }
    }

    protected function carregarFuncionalidades()
    {
        foreach ($this->funcionalidades as $funcionalidade) {
            $this->addResource(new Resource($funcionalidade->getNome()));
        }
    }

    protected function carregarPrivilegios()
    {
        foreach ($this->privilegios as $privilegio) {
            if ($privilegio->getLer()) {
                $this->allow($privilegio->getGrupo()->getNome(), $privilegio->getFuncionalidade()->getNome(), "ler");
            }
            if ($privilegio->getEscrever()) {
                $this->allow($privilegio->getGrupo()->getNome(), $privilegio->getFuncionalidade()->getNome(), "escrever");
            }
        }
    }
}

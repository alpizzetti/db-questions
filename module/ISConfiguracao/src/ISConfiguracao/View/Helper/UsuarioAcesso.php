<?php

namespace ISConfiguracao\View\Helper;

use Zend\View\Helper\AbstractHelper;

class UsuarioAcesso extends AbstractHelper {

    public function __invoke() {
        return new \ISConfiguracao\Permissions\SessaoAcl();
    }

}

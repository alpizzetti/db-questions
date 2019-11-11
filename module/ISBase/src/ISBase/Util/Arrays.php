<?php

namespace ISBase\Util;

class Arrays {
    

    public static function cursosTipos($tipo = null) {
        if (empty($tipo)) {
            return array(
                "ensmed" => "Ensino Médio",
                "tec" => "Técnico",
                "sup" => "Superior",
            );
        } else {
            if ($tipo == "ensmed") {
                return "Ensino Médio";
            } else if ($tipo == "tec") {
                return "Técnico";
            } else if ($tipo == "sup") {
                return "Superior";
            }
        }
    }
}

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
    
    public static function questoesDificuldades($tipo = null) {
        if (empty($tipo)) {
            return array(
                "mui_fac" => "Muito Fácil",
                "fac" => "Fácil",
                "med" => "Médio",
                "dif" => "Difícil",
                "mui_dif" => "Muito Difício",
            );
        } else {
            if ($tipo == "mui_fac") {
                return "Muito Fácil";
            } else if ($tipo == "fac") {
                return "Fácil";
            } else if ($tipo == "med") {
                return "Médio";
            } else if ($tipo == "dif") {
                return "Difícil";
            } else if ($tipo == "mui_dif") {
                return "Muito Difício";
            }
        }
    }
}

<?php

namespace ISBase\Util;

class IdealizeUtil {

    const NN_PONTO = '\.';
    const NN_PONTO_ESPACO = '. ';
    const NN_ESPACO = ' ';
    const NN_REGEX_MULTIPLOS_ESPACOS = '\s+';
    const NN_REGEX_NUMERO_ROMANO = '^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$';

    public static function normalizarNome($nome) {
        $nome = mb_ereg_replace(self::NN_PONTO, self::NN_PONTO_ESPACO, $nome);
        $nome = mb_ereg_replace(self::NN_REGEX_MULTIPLOS_ESPACOS, self::NN_ESPACO, $nome);
        $nome = mb_convert_case($nome, MB_CASE_TITLE, mb_detect_encoding($nome));
        $partesNome = mb_split(self::NN_ESPACO, $nome);
        $excecoes = array(
            'de', 'di', 'do', 'da', 'dos', 'das', 'dello', 'della',
            'dalla', 'dal', 'del', 'e', 'em', 'na', 'no', 'nas', 'nos', 'van', 'von',
            'y'
        );

        for ($i = 0; $i < count($partesNome); ++$i) {
            foreach ($excecoes as $excecao)
                if (mb_strtolower($partesNome[$i]) == mb_strtolower($excecao))
                    $partesNome[$i] = $excecao;
            if (mb_ereg_match(self::NN_REGEX_NUMERO_ROMANO, mb_strtoupper($partesNome[$i])))
                $partesNome[$i] = mb_strtoupper($partesNome[$i]);
        }

        return implode(self::NN_ESPACO, $partesNome);
    }

    public static function validarEmail($email) {
        if (!preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(.[[:lower:]]{2,3})(.[[:lower:]]{2})?$/", $email)) {
            return false;
        } else {
            $dominio = explode('@', $email);

            if (!checkdnsrr($dominio[1], 'A')) {
                return false;
            } else {
                return true;
            }
        }
    }

    public static function itensLocalizados($total, $item) {
        if ($item == "usuario") {
            if ($total == 0) {
                return "Nenhum usuário localizado";
            } else if ($total == 1) {
                return "Um usuário localizado";
            } else {
                return $total . " usuários localizados";
            }
        } else if ($item == "unidade") {
            if ($total == 0) {
                return "Nenhuma unidade localizada";
            } else if ($total == 1) {
                return "Uma unidade localizada";
            } else {
                return $total . " unidades localizadas";
            }
        } else if ($item == "grupo") {
            if ($total == 0) {
                return "Nenhum grupo localizado";
            } else if ($total == 1) {
                return "Um grupo localizado";
            } else {
                return $total . " grupos localizados";
            }
        } else if ($item == "privilegio") {
            if ($total == 0) {
                return "Nenhum privilégio localizado";
            } else if ($total == 1) {
                return "Um privilégio localizado";
            } else {
                return $total . " privilégios localizados";
            }
        }
    }

}

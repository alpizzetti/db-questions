<?php

namespace ISBase\Util;

class RandomString
{
    private $letrasMin;
    private $letrasMai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private $numeros = '1234567890';
    private $simbolos = '!@#$%*-';

    public function __construct()
    {
        $this->letrasMin = 'abcdefghijklmnopqrstuvwxyz';
        $this->letrasMai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $this->numeros = '1234567890';
        $this->simbolos = '!@#$%*-';
    }

    function gerar($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
    {
        $retorno = '';
        $caracteres = '';

        $caracteres .= $this->letrasMin;
        if ($maiusculas) {
            $caracteres .= $this->letrasMai;
        }
        if ($numeros) {
            $caracteres .= $this->numeros;
        }
        if ($simbolos) {
            $caracteres .= $this->simbolos;
        }

        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }
}

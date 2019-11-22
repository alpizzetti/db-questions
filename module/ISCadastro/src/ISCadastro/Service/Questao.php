<?php

namespace ISCadastro\Service;

use ISBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;
use ISBase\Util\Imagem;
use ISBase\Util\Canvas;
use ISBase\Util\RandomString;

class Questao extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'ISCadastro\Entity\Questao';
    }

    public function insert(array $data)
    {
        $unidadeCurricular = $this->em->getReference(
            "ISConfiguracao\Entity\UnidadeCurricular",
            $data['unidade_curricular']
        );
        $usuario = $this->em->getReference(
            "ISConfiguracao\Entity\Usuario",
            $data['usuarioId']
        );

        $questao = new \ISCadastro\Entity\Questao($data);
        $questao->setUnidadeCurricular($unidadeCurricular);
        $questao->setUsuario($usuario);

        $this->em->persist($questao);
        $this->em->flush();

        return $questao;
    }

    public function update(array $data)
    {
        $unidadeCurricular = $this->em->getReference(
            "ISConfiguracao\Entity\UnidadeCurricular",
            $data['unidade_curricular']
        );
        $questao = $this->em->getReference($this->entity, $data['id']);

        (new Hydrator\ClassMethods())->hydrate($data, $questao);

        $questao->setUnidadeCurricular($unidadeCurricular);

        $this->em->persist($questao);
        $this->em->flush();

        return $questao;
    }

    public function imagensEnviar($imagens, $dados)
    {
        $questao = $this->em->getReference($this->entity, $dados['id']);

        foreach ($imagens as $imagem) {
            $extensao = pathinfo($imagem["name"], PATHINFO_EXTENSION);
            $hash =
                $questao->getId() .
                "-" .
                (new RandomString())->gerar(10, false, true, false);

            $diretorio = "./public/questoes/" . $hash;
            $arquivoOriginal = $diretorio . "." . $extensao;
            $arquivoFinal = $diretorio . ".jpg";

            if (move_uploaded_file($imagem["tmp_name"], $arquivoOriginal)) {
                ini_set("memory_limit", "256M");

                Imagem::convertImage($arquivoOriginal, $arquivoFinal, 100);

                $canvas = new Canvas();
                $canvas
                    ->carrega($arquivoFinal)
                    ->hexa("#FFFFFF")
                    ->redimensiona(1000, 0, "preenchimento")
                    ->grava($arquivoFinal, 100);

                $proImg = new \ISCadastro\Entity\QuestaoImagem();
                $proImg->setArquivo($hash . ".jpg");
                $proImg->setQuestao($questao);
                $proImg->setItem($dados['item']);

                $this->em->persist($proImg);
                $this->em->flush();
            }
        }

        return true;
    }

    public function imagensRemover($imagem)
    {
        $imagemDiretorio = "./public/questoes/" . $imagem->getArquivo();

        if (file_exists($imagemDiretorio)) {
            unlink($imagemDiretorio);
        }

        $this->em->remove($imagem);
        $this->em->flush();

        return true;
    }
}

<?php

namespace ISBase\Paginator;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as PaginatorORM;
use Zend\Paginator\Paginator as ZendPaginator;

class AdapterQuery {

    private $query;
    private $page;
    private $contPerPage;
    private $entityManager;
    private $selectFields;

    public function __construct($query, $page, $contPerPage, $entityManager, $selectFields = false) {
        $this->query = $query;
        $this->page = $page;
        $this->contPerPage = $contPerPage;
        $this->entityManager = $entityManager;
        $this->selectFields = $selectFields;
    }

    private function getPaginatorORM() {
        return (new PaginatorORM($this->query))
                        ->setUseOutputWalkers($this->selectFields);
    }

    public function getPaginator() {
        $paginator = new ZendPaginator(new PaginatorAdapter($this->getPaginatorORM()));
        $paginator->setCurrentPageNumber($this->page)->setDefaultItemCountPerPage($this->contPerPage);
        
        return $paginator;
    }

}

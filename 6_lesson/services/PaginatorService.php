<?php


namespace App\services;


use App\entities\Entity;
use App\repositories\GoodRepository;
use App\repositories\Repository;

class PaginatorService
{
    protected $items = [];
    protected $count = 0;
    protected $perPage = 10;
    protected $baseRote;
    protected $RepoName;

    /**
     * PaginatorService constructor.
     * @param $nameRepo
     * @param $baseRote
     */
    public function __construct(Repository $nameRepo , $baseRote)
    {
        $this->baseRote = $baseRote;
        $this->RepoName = $nameRepo;
    }

    /**
     * @param int $pageNumber
     */
    public function setItems( $pageNumber = 1)
    {
        $countData = $this->RepoName->getCountList();
        $this->count = $countData['count'];
        $this->items = $this->RepoName->getWithPage($pageNumber, $this->perPage);
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getUrls()
    {
        $linkPages = ceil($this-> count / $this->perPage);

        $urls = [];

        if ($linkPages <= 1)
        {
            return $urls;
        }
        for ($i = 1; $i <= $linkPages; $i++){
            if ($i > 1){
                $urls[$i] = $this->baseRote . '/?page=' . $i;
            }else {
                $urls[$i] = $this->baseRote;
            }
        }
        return $urls;
    }
}

<?php


namespace App\services;


use App\models\Model;

class PaginatorService
{
    protected $items = [];
    protected $count = 0;
    protected $perPage = 10;
    protected $baseRote;

    /**
     * PaginatorService constructor.
     * @param $baseRote
     */
    public function __construct($baseRote)
    {
        $this->baseRote = $baseRote;
    }


    public function setItems(Model $model , $pageNumber = 1)
    {
        $countData = $model->getCountList();
        $this->count = $countData['count'];
        $this->items = $model->getWithPage($pageNumber, $this->perPage);
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
                $urls[$i] = $this->baseRote . '&page=' . $i;
            }else {
                $urls[$i] = $this->baseRote;
            }
        }
        return $urls;
    }
}

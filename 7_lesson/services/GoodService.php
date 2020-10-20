<?php


namespace App\services;


use App\entities\Good;
use App\repositories\GoodRepository;

class GoodService extends Service
{
    public function save($id, $arrFromPost)
    {
        $goodForEdit = new Good();
        if (!empty($id)) {
            $goodForEdit = $this->container->goodRepository->getOne($id);
        }
        foreach ($arrFromPost as $key => $value) {
            $goodForEdit->$key = $value;

        }
        $res = $this->container->goodRepository->save($goodForEdit);
        if (!empty($id)){
            return;
        }

        if ($res) {
            $msg = true;
        } else {
            $msg = false;
        }
        return $msg;
    }
}

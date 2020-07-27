<?php


namespace App\services;


use App\entities\Good;
use App\repositories\GoodRepository;

class GoodService
{
    public function save($id, $arrFromPost)
    {
        $goodForEdit = new Good();
        if (!empty($id)) {
            $goodForEdit = (new GoodRepository())->getOne($id);
        }
        foreach ($arrFromPost as $key => $value) {
            $goodForEdit->$key = $value;

        }
        $res = (new GoodRepository())->save($goodForEdit);
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

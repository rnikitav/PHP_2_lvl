<?php


namespace App\controllers;


use App\models\Comments;
use App\models\Good;
use App\traits\TShop;

class ShopController
{
    private $action;
    protected $actionDefault = 'all';

    use TShop;

    public function allAction()
    {
        $goods = Good::getAll();
        $perPage = 10;
        $goodsNumb = count($goods);
        if ($goodsNumb <= 10) {
            return $this->render('goods',
                [
                    'goods' => $goods,
                ]);
        }
        $linkPages = ceil($goodsNumb / $perPage);
        $pageSql = (int)($this->getPage() * 10);
        $goodsWithCount = Good::getWithPage($pageSql, $perPage);
        return $this->render('goods',
            [
                'goods' => $goodsWithCount,
                'links' => $linkPages
            ]);

    }


    public function oneAction()
    {
        $id = $this->getId();
        $article = $this->getArticle();
        return $this->render('good',
            [
                'good' => Good::getOne($id),
                'comments' => Comments::getComments($article)
            ]);

    }

    public function addCommentAction()
    {
        $id = (int)$this->getId();
        $article = $this->getArticle();
        $goodForCom = new Comments();
        $goodForCom->article = $article;
        $goodForCom->comment = $_POST['commit'];
        $goodForCom->save();
        header("Location: ?c=shop&a=one&id={$id}&article={$article}");
    }

    public function editInfoAction()
    {
        $id = (int)$this->getId();
        $article = $this->getArticle();
        $goodForEdit = new Good();
        if (!empty($_POST['article'])) {
            $article = $_POST['article'];
        }
        foreach ($_POST as $key => $value) {
            if (!empty($value)) {
                $goodForEdit->$key = $value;
            }
        }
        $goodForEdit->id = $id;
        $goodForEdit->save();
        header("Location: ?c=shop&a=one&id={$id}&article={$article}");
    }


    public function addGoodPageAction()
    {
        $msg = '';
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return $this->render('addgoodpage',
                [
                    'msg' => $msg
                ]);
        }
        $goodForEdit = new Good();
        $goodForEdit->name = $_POST['name'];
        $goodForEdit->price = $_POST['price'];
        $goodForEdit->description = $_POST['description'];
        $goodForEdit->img = $_POST['img'];
        $goodForEdit->article = $_POST['article'];
        $res = $goodForEdit->save();
        if ($res->rowCount() > 0) {
            $msg = 'Товар успешно добавлен в БД';
        } else {
            $msg = 'Товар не добавлен в БД. Необходимо обязательно Name и Price';
        }


        return $this->render('addgoodpage',
            [
                'msg' => $msg
            ]);
    }


}

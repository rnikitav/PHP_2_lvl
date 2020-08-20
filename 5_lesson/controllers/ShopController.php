<?php


namespace App\controllers;


use App\models\Comments;
use App\models\Good;
use App\services\PaginatorService;
use App\traits\TShop;

class ShopController extends Controller
{
    protected $actionDefault = 'all';


    public function allAction()
    {
        $paginator = new PaginatorService('?c=shop');
        $goods = new Good();
        $paginator->setItems($goods, $this->getPage());
            return $this->render('goods',
                [
                    'paginator' => $paginator,
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

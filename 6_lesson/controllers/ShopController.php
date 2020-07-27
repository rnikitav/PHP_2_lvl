<?php


namespace App\controllers;


use App\entities\Comments;
use App\entities\Good;
use App\repositories\CommentsRepository;
use App\repositories\GoodRepository;
use App\services\GoodService;
use App\services\PaginatorService;
use App\services\Request;

class ShopController extends Controller
{
    protected $actionDefault = 'all';


    public function allAction()
    {
        $paginator = new PaginatorService(new GoodRepository(),'/shop');
        $paginator->setItems($this->getPage());
            return $this->render('goods',
                [
                    'paginator' => $paginator,
                ]);

    }


    public function oneAction()
    {
        $id = $this->getId();
        $article = $this->getArticle();
        $res = (new GoodRepository())->getOne($id);
        if ($res) {
            return $this->render('good',
                [
                    'good' => $res,
                    'comments' => (new CommentsRepository())->getComments($article)
                ]);
        }
        return $this->render('errorpage',
            [
                'msg' => 'Товар не найден'
            ]);


    }

    public function addCommentAction()
    {
        $id = $this->getId();
        $article = $this->getArticle();
        $goodForCom = new Comments();
        $goodForCom->article = $article;
        $goodForCom->comment = $_POST['commit'];
        (new CommentsRepository())->save($goodForCom);
        header("Location: /shop/one/?id={$id}&article={$article}");
    }

    public function editInfoAction()
    {
        $id = (int)$this->getId();
        $article = $this->getArticle();
        $arrFromPost = $this->request->post();
        (new GoodService())->save($id, $arrFromPost);
        header("Location: /shop/one/?id={$id}&article={$article}");
        return;
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
        $id = (int)$this->getId();
        $arrFromPost = $this->request->post();
        $res = (new GoodService())->save($id, $arrFromPost);

        if (!$res){
            return $this->render('addgoodpage',
                [
                    'msg' => 'Товар не добавлен в БД. Необходимо обязательно Name и Price',
                    'data' => $arrFromPost
                ]);
        }
        return $this->render('errorpage',
            [
                'msg' => 'Товар успешно добавлен в БД'
            ]);
    }
    public function delAction()
    {
        $id = $this->getId();
        /** @var Good $good */
//        $good = (new GoodRepository())->getOne($id);
        (new GoodRepository())->delete($id);
        header("Location: /");
    }

}

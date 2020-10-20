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
        $paginator = new PaginatorService($this->app->goodRepository,'/shop');
        $paginator->setItems($this->getPage());
            return $this->render('goods',
                [
                    'paginator' => $paginator,
                    'isAdmin' => $this->isAdmin,
                    'isSignIn' => $this->isSingIn,
                ]);

    }


    public function oneAction()
    {
        $id = $this->getId();
        $article = $this->getArticle();
        $res = $this->app->goodRepository->getOne($id);
        if ($res) {
            return $this->render('good',
                [
                    'good' => $res,
                    'comments' => $this->app->commentsRepository->getComments($article),
                    'isAdmin' => $this->isAdmin,
                    'isSignIn' => $this->isSingIn,
                ]);
        }
        return $this->render('errorpage',
            [
                'msg' => 'Товар не найден',
                'isAdmin' => $this->isAdmin,
                'isSignIn' => $this->isSingIn,
            ]);


    }

    public function addCommentAction()
    {
        $id = $this->getId();
        $article = $this->getArticle();
        $goodForCom = new Comments();
        $goodForCom->article = $article;
        $goodForCom->comment = $_POST['commit'];
        $this->app->commentsRepository->save($goodForCom);
        header("Location: /shop/one/?id={$id}&article={$article}");
    }

    public function editInfoAction()
    {
        $id = (int)$this->getId();
        $article = $this->getArticle();
        $arrFromPost = $this->request->post();
        $this->app->goodService->save($id, $arrFromPost);
        header("Location: /shop/one/?id={$id}&article={$article}");
        return;
    }


    public function addGoodPageAction()
    {
        $msg = '';
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return $this->app->renderer->render('addgoodpage',
                [
                    'msg' => $msg,
                    'isSignIn' => $this->isSingIn,
                    'isAdmin' => $this->isAdmin,
                ]);
        }
        $id = (int)$this->getId();
        $arrFromPost = $this->request->post();
        $res = $this->app->goodService->save($id, $arrFromPost);

        if (!$res){
            return $this->app->renderer->render('addgoodpage',
                [
                    'msg' => 'Товар не добавлен в БД. Необходимо обязательно Name и Price',
                    'data' => $arrFromPost,
                    'isSignIn' => $this->isSingIn,
                    'isAdmin' => $this->isAdmin,
                ]);
        }
        return $this->render('errorpage',
            [
                'msg' => 'Товар успешно добавлен в БД',
                'isSignIn' => $this->isSingIn,
                'isAdmin' => $this->isAdmin,
            ]);
    }
    public function delAction()
    {

        $id = $this->getId();

        /** @var Good $good */
        $this->app->goodRepository->delete($id);
        header("Location: /");
    }

}

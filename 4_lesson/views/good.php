<?php
/** @var \App\models\Good $good */
/** @var \App\models\Comments[] $comments */
?>
<div id="openedProduct-img">
    <img src="images/goods/<?= $good->img ?>" alt="photo">
</div>
<div id="openedProduct-content">
    <h1 id="openedProduct-name">
        <?= $good->name ?>
    </h1>
    <div id="openedProduct-desc">
        <?= $good->description ?>
    </div>
    <div id="openedProduct-price">
        Цена: <?= $good->price ?> $
    </div>
    <div class="btnByu">
        <a href="/?p=shopcart&a=add&article=<?= $good->article ?>" class="addToCart">Добавить в корзину PHP</a>
    </div>
</div>
<?php if ($this->getArticle()) : ?>
    <form method="post" action="?c=shop&a=addComment&article=<?=$good->article?>&id=<?=$good->id?>">
        <input type="text" placeholder="Ваш комментарий" name="commit" size="40">
        <input type="submit">
    </form>
<?php endif; ?>
<button class="editInfo">Изменить информаци</button>
<div class="hidden divEdit">
    <form method="post" action="?c=shop&a=editInfo&article=<?=$good->article?>&id=<?=$good->id?>"" class="editInfoForm">
        <input type="text" name="name" placeholder="Name" class="editInput">
        <input type="text" name="price" placeholder="Price" class="editInput">
        <input type="text" name="description" placeholder="Description" class="editInput">
        <input type="text" name="img" placeholder="img" class="editInput">
        <input type="text" name="article" placeholder="article" class="editInput">
        <input type="submit" value="Отправить изменения" class="editBtn">
    </form>
    <button class="closeEditInfo">Закрыть</button>
</div>
<div class="comments">
    <?php foreach ($comments as $comment) : ?>
        <h3><?= $comment->comment ?></h3>
    <?php endforeach; ?>
</div>
<script>
    let btn = document.querySelector('.editInfo');
    let clsBtn = document.querySelector('.closeEditInfo');
    let divEdit = document.querySelector('.divEdit');
    btn.addEventListener('click', function () {
        divEdit.classList.remove('hidden');
    });
    clsBtn.addEventListener('click', () => {
        divEdit.classList.add('hidden');
    });
</script>

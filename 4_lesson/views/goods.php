<?php
/** @var \App\models\Good[] $goods */
/** @var int $links */
?>
<h1>Каталог</h1>
<div>
    <?php foreach ($goods as $good) : ?>
        <div class="shopUnit">
            <img src="images/goods/<?= $good->img ?>" alt="phone">
            <div class="shopUnitName">
                <?= $good->name ?>
            </div>
            <div class="shopUnitShortDesc">
                <?= $good->description ?>
            </div>
            <div class="shopUnitPrice">
                Цена <?= $good->price ?> $
            </div>
            <a href="?c=shop&a=one&id=<?=$good->id?>&article=<?=$good->article?>" class="shopUnitMore">
                Подробнее
            </a>
        </div>

    <?php endforeach; ?>

    <?php if (isset($links)) :?>
        <p>Страницы</p>
    <?php for ($i = 0; $i < $links ; $i++) :?>
    <?php if ($i == 0) :?>
    <a href="?c=shop">1</a>
    <?php else: ?>
    <a href="?c=shop&page=<?=$i?>"><?=++$i?></a>
    <?php endif;?>
    <?php endfor; ?>
    <?php endif;?>
</div>

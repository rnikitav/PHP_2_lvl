<?php
/**@var \App\models\User[] $users*/
?>

<h1>Все пользователи</h1>
<?php foreach ($users as $user) : ?>
    <?php $user = json_decode($user, true); ?>
    <p>Имя: <?=$user['name']?></p>
    <p>Логин: <?=$user['login']?></p>
    <a href="?c=user&a=one&id=<?=$user['id']?>">Подробнее</a>
    <hr>
<?php endforeach; ?>

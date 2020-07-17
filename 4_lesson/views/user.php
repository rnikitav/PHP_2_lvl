<?php
/** @var \App\models\User $user */
?>
<h1>Пользователь</h1>
<?php
$user = json_decode($user, true);
?>
<p style="color: red">Имя: <?=$user['name'] ?></p>
<p style="color: green">Логин: <?=$user['login'] ?></p>

<a href="?c=user&a=all">Назад</a>

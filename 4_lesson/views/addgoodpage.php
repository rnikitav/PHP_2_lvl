<h1>Добавление товара</h1>

<h3><?=$msg?></h3>

<form method="post" action="?c=shop&a=addGoodPage" class="editInfoForm">
<input type="text" name="name" placeholder="Name" class="editInput">
<input type="text" name="price" placeholder="Price" class="editInput">
<input type="text" name="description" placeholder="Description" class="editInput">
<input type="text" name="img" placeholder="img" class="editInput">
<input type="text" name="article" placeholder="article" class="editInput">
<input type="submit" value="Отправить изменения" class="editBtn">
</form>

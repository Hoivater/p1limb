
%csrf% 
<h5 class = "mt-3">Добавить статью</h5>
<form name = "add_article" action = "%name_site%app/form/formRoute.php" method = "post">

%csrf%
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Название статьи</label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name = "name">
</div>
<div class="mb-3">
  <label for="exampleFormControlInput2" class="form-label">Обложка</label>
  <input type="text" class="form-control" id="exampleFormControlInput2" name = "image">
</div>


<div class="form-floating mt-3">
  <textarea class="form-control" placeholder="Краткое описание" id="floatingTextarea2" name  = "description" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Description/Краткое описание</label>
</div>


<div class="form-floating mt-3">
  <select class="form-select" id="floatingSelect" name = "category" aria-label="Floating label select example">
    <option selected>Показать возможные категории</option>
    ^start_repeat_selectmenu^
%name% %link%
    <option value="%link%">%name%</option>
    ^end_repeat_selectmenu^
  </select>
  <label for="floatingSelect">Выберите категорию</label>
</div>

<div class="form-floating mt-3">
  <textarea class="form-control" placeholder="Leave a comment here" name = "text" id="floatingTextarea2" style="height: 250px"></textarea>
  <label for="floatingTextarea2">Текст статьи</label>
</div>

<button type="submit" class="btn btn-primary mt-3" name = "nameForm" value = "add_article">Отправить</button>
</form>
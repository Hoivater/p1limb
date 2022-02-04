
<h5 class = "mt-3">Добавить статью</h5>
<form name = "add_article" action = "%name_site%app/form/formPulicRoute.php">

<div class="form-floating mt-3">
  <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
    <option selected>Показать возможные категории</option>
    ^start_repeat_selectmenu^
%name% %link%
    <option value="%link%">%name%</option>
    ^end_repeat_selectmenu^
  </select>
  <label for="floatingSelect">Выберите категорию</label>
</div>

<div class="form-floating mt-3">
  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Текст статьи</label>
</div>

</form>
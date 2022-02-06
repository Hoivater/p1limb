
%csrf% 
<h5 class = "mt-3">Добавить пункт меню</h5>
<form name = "add_article" action = "%name_site%app/form/formRoute.php" method = "post">

%csrf%
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Новый пункт меню: </label>
  <input type="text" class="form-control" id="exampleFormControlInput1" name = "name">
</div>



^start_repeat_selectmenu^
%name% %link% %id%
<div class="input-group mb-3">
  <div class="input-group-text">
    <input class="form-check-input mt-0" type="checkbox" name = "menu%id%" value="%link%" aria-label="Checkbox for following text input">
  </div>
  <input type="text" class="form-control" name = "text%id%" aria-label="Text input with checkbox" value = "%name%">
</div>
^end_repeat_selectmenu^





<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="delete" id="inlineRadio1" value="yes">
  <label class="form-check-label" for="inlineRadio1">Удалить выбранные</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="delete" id="inlineRadio2" value="no">
  <label class="form-check-label" for="inlineRadio2">Сохранить изменения в выбранных</label>
</div>
<br />


<button type="submit" class="btn btn-primary mt-3" name = "nameForm" value = "red_menu">Применить изменения</button>
</form>
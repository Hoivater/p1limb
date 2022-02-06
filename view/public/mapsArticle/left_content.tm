
%csrf% 
<div class="address mt-3">
  <p>Сортировать: <a href = "%name_site%maps_article/category" >- По категории</a> <a href = "%name_site%maps_article/date_creation">- По дате добавления</a></p>
</div>



<div class="container-fluid mt-3">

^start_repeat_articleMap^
%name% %category% %link% %date_creation%
<div class="row mt-2">
  <div class="col-4">
    <p>%name%</p>
    <p>%date_creation%</p>
  </div>
  <div class="col-2">
    <p>%category%</p>
  </div>
  <div class="col-6">
    <a href  = "%name_site%delete/%link%" class="delete btn btn-primary btn-sm">Удалить</a> <a href  = "%name_site%redaction_article/%link%" class="btn btn-primary btn-sm">Редактировать</a> <a href  = "%name_site%article/%link%" target = '_blank' class="btn btn-primary btn-sm">Открыть</a>
  </div>
</div>
^end_repeat_articleMap^

</div>
<script>
$('.delete').click(function(event) {
    event.preventDefault();
    var r=confirm("Подтвердить удаление?");
    if (r==true)   {
       window.location = $(this).attr('href');
    }

});
</script>

%csrf%
<h3>Галерея</h3>
<form name = "loadimage" action = "%name_site%app/form/FormRoute.php" method = "post" enctype="multipart/form-data">
%csrf%
<p>Для обложки предпочтительнее изображения с соотношением сторон 2,82</p>
<div class="mb-3">
  <label for="formFileMultiple" class="form-label">Изображение 1</label>
  <input class="form-control" type="file" id="formFileMultiple" name = "image" multiple>
</div>
<div class="mb-3">
  <label for="formFileMultiple2" class="form-label">Изображение 2</label>
  <input class="form-control" type="file" id="formFileMultiple2" name = "image2" multiple>
</div>
<div class="mb-3">
  <label for="formFileMultiple3" class="form-label">Изображение 3</label>
  <input class="form-control" type="file" id="formFileMultiple3" name = "image3" multiple>
</div>
<button type="submit" class="btn btn-primary mt-3" name = "nameForm" value = "add_images">Загрузить</button>
</form>
<div class="row" data-masonry="{'percentPosition': true }">
^start_repeat_galery^
%name_image%

<div class="card m-2" style="width: 18rem;">
  <img src="%name_site%resourse/visible/content/%name_image%" class="card-img-top mt-2">
  <div class="card-body">
    <h5 class="card-title">%name_site%resourse/visible/content/%name_image%</h5>
    <a href="%name_site%delete_image/%name_image%" class="delete btn btn-primary">Удалить</a>
  </div>
</div>
^end_repeat_galery^
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
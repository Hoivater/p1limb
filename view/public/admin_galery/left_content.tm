

<h3>Галерея</h3>
<div class="row" data-masonry="{'percentPosition': true }">
^start_repeat_galery^
%name_image%

<div class="card m-2" style="width: 18rem;">
  <img src="%name_site%resourse/visible/content/%name_image%" class="card-img-top mt-2">
  <div class="card-body">
    <h5 class="card-title">.. resourse/visible/content/ %name_image%</h5>
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
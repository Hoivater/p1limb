

<div class="container-fluid mt-3">

^start_repeat_comMap^
%id_article% %author% %email% %comment% %date% %id% %name_article% ` 
<div class="row">
	<div class="col-12">
		Статья: %name_article%
	</div>
</div>
<div class="row mt-2">
  <div class="col-3">
    <p>%author%</p>
    <p>%email%</p>
    <p>%date%</p>
  </div>
  <div class="col-7">
    <p>%comment%</p>
  </div>
  <div class="col-2">
    <a href  = "%name_site%delete_comment/%id%" class="delete btn btn-primary btn-sm">Удалить</a><br />  <a href  = "%name_site%article/%id_article%" target = '_blank' class="btn btn-primary btn-sm  mt-3">Открыть</a>
  </div>
</div>
^end_repeat_comMap^

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
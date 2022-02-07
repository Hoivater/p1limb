#norepeat
%date_creation% %name% %text% %linkback% %linkprev% %name_article_back% %name_article_prev% %csrf% %id% %user% [code] [/code] `
<div class="card mt-3">
  <div class="card-header">
    %date_creation%
  </div>
  <div class="card-body">
    <h5 class="card-title">%name%</h5>
    %text%
    <div class="text-center">
    	<a href="%name_site%article/%linkback%" class="btn btn-primary mt-3"><< %name_article_back%</a> <a href="%name_site%article/%linkprev%" class="btn btn-primary mt-3"> %name_article_prev% >></a>
    </div>
  </div>
  <div class="commentary">
  	<h3 class="m-3">Обсуждение</h3>

    %startall%
  	<div class="form_commentary p-3">
  		<form name = "form_comm" method = "post" action = '%name_site%app/form/FormRoute.php'>
        <input type="text" value = "%id%" name = "id" style='display:none;'>
  			<input type="text" value = "%user%" name = "user" style='display:none;'>
        <div class="input-group">
          %csrf%
			  <textarea class="form-control" aria-label="With textarea" name  = "comment"></textarea>
			  <span class="input-group-text"><button type = "submit" class="btn btn-light" name="nameForm" value = 'add_commentary'>Добавить</button></span>

			</div>
  		</form>
  	</div>
    %endall%

    %startnoauth%
    <h4 class="m-3">Для участия в обсуждении необходимо зарегистрироваться</h4>
    %endnoauth%

^start_repeat_OneComment^
%author% %date% %comment% 
<div class='one_commentary'>
  <div class="container-fluid">
    <div class="row">
      <div class="col-2">
        <p class="name_author">%author%</p>
        <p class="time">%date%</p>
      </div>
      <div class="col-10">
        <p class="text_commenatary p-3 pt-0 ">
          %comment%
        </p>

      </div>
    </div>
  </div>

</div>
^end_repeat_OneComment^

  </div>
</div>
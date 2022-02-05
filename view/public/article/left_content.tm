#norepeat
%date_creation% %name% %text% %linkback% %linkprev% %name_article_back% %name_article_prev% 
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
  		<form name = "form_comm" method = "post" action = '%name_site%app/form/FormPublicRoute.php'>
  			<div class="input-group">
			  <textarea class="form-control" aria-label="With textarea"></textarea>
			  <span class="input-group-text"><button type = "submit" class="btn btn-light">Добавить</button></span>
			</div>
  		</form>
  	</div>
    %endall%

    %startnoauth%
    <h4 class="m-3">Для участия в обсуждении необходимо зарегистрироваться</h4>
    %endnoauth%
  	<div class='one_commentary'>
  		<img class="avatar rounded-circle" src="/resourse/data/avatars.jpg">
  		<p class="name_author">Маорен</p>
  		<p class="time">12:21 21.12.2021</p>
  		<div class="clean"></div>
  		<p class="text_commenatary p-3 pt-0">
  			Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat odit in suscipit reprehenderit provident ipsa perspiciatis fugiat rerum quasi atque repellat asperiores magni, laboriosam eos at itaque quibusdam amet!
  		</p>
  	</div>
  	<div class="two_commentary">
  		<img class="avatar rounded-circle" src="/resourse/data/avatars.jpg">
  		<p class="name_author">Маорен</p>
  		<p class="time">12:21 21.12.2021</p>
  		<div class="clean"></div>
  		<p class="text_commenatary p-3 pt-0">
  			Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat odit in suscipit reprehenderit provident ipsa perspiciatis fugiat rerum quasi atque repellat asperiores magni, laboriosam eos at itaque quibusdam amet!
  		</p>
  	</div>
  </div>
</div>
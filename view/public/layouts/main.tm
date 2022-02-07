<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="%description%">
    <!-- Jquery -->
    <script src="%name_site%style/limb/js/jq_v_3_6_0.js"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="%name_site%style/public/css/dtbs.css">



    <script src="https://kit.fontawesome.com/de9f65bcf0.js" crossorigin="anonymous"></script>
<!-- Подсветка кода -->
    <script src="%name_site%style/public/js/rainbow-custom.min.js"></script>
		<link href="%name_site%style/public/css/code.css" rel="stylesheet">
<!-- Подсветка кода -->
    <link rel="shortcut icon" href="%name_site%favicon.svg" type="image/x-icon">
	<title>%title%</title>

</head>
<header class='container-fluid pt-3 pb-2'>
<img src="%name_site%resourse/visible/logo.svg" class='logo'>
<h3 style="float:left;"><a href = '%name_site%'>%header_text%</a></h3>
%startadmin%
<ul class="nav col-12 col-md-auto mb-2 justify-content-end mb-md-0">
  <li><a href="%name_site%redaction_menu" class="nav-link px-2 link-dark">Редактировать меню</a></li>
  <li><a href="%name_site%add_article" class="nav-link px-2 link-dark">Добавить статью</a></li>
  <li><a href="%name_site%commentary" class="nav-link px-2 link-dark">Комментарии</a></li>
  <li><a href="%name_site%maps_article" class="nav-link px-2 link-dark">Карта статей</a></li>
  <li><a href="%name_site%galery" class="nav-link px-2 link-dark">Галерея</a></li>
</ul>
%endadmin%
<div class="clean"></div>
</header>
<body>
<div  class='container'>
	<div class="row">
		<div class="col-md-9 col-12">
			%address%

			%left_content%

			<div class="mod_pag m-3">
				%module_pagination%
			</div>
		</div>
		<div class="col-md-3 mb-3">

			
			<p class="mt-3">
				%startadmin% 
					Добрый день, Администратор
				%endadmin%
				%startuser% 
					Добрый день, %name_user% 
				%enduser%
			</p>
			

			
				<p class="mt-3"></p>
			
			<h3 class='mt-3 '>Меню</h3>
			<div class="list-group mt-3">
<a href="%name_site%" class="list-group-item list-group-item-action">Главная страница</a>
^start_repeat_menu^
%name% %link%
<a href="%name_site%category/%link%" class="list-group-item list-group-item-action">%name%</a>
^end_repeat_menu^

			

			%startnoauth%
			  <a href="%name_site%registration" class="list-group-item list-group-item-action">Регистрация</a>
			  <a href="%name_site%auth" class="list-group-item list-group-item-action">Войти</a>
			%endnoauth%

			%startall%
			  <a href="%name_site%destructauth" class="list-group-item list-group-item-action">Выйти</a>
			%endall%

			</div>
			%smenu%
		</div>
	</div>

</div>
</body>

<footer class='container-fluid p-2 mb-0 pt-3'>
<h5 class='text-end'>...тестовая версия для limb и про limb... 2022 уеарс</h5>
</footer>

<script>
var tabElms = document.querySelectorAll('a[data-bs-toggle="list"]')
tabElms.forEach(function(tabElm) {
  tabElm.addEventListener('shown.bs.tab', function (event) {
    event.target // newly activated tab
    event.relatedTarget // previous active tab
  })
}
</script>
</html>
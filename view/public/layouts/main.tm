<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="%description%">
    <!-- Jquery -->
    <script src="/style/limb/js/jq_v_3_6_0.js"></script>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="/style/public/css/dtbs.css">



    <script src="https://kit.fontawesome.com/de9f65bcf0.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="/favicon.svg" type="image/x-icon">
	<title>%title%</title>

</head>
<header class='container-fluid pt-3 pb-2'>
<a href = '/'><img src="/resourse/visible/logo.png" class='logo'>
<h3>%header_text%</h3></a>
</header>
<body>
<div  class='container'>
	<div class="row">
		<div class="col-md-8 col-12">
			%left_content%

			<div class="mod_pag m-3">
				%module_pagination%
			</div>
		</div>
		<div class="col-md-4 mb-3">

			
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

^start_repeat_menu^
%name% %link%
<a href="/category/%link%" class="list-group-item list-group-item-action">%name%</a>
^end_repeat_menu^

			%startadmin%
			  <a href="/" class="list-group-item list-group-item-action">Добавить пункт меню</a>
			%endadmin%

			%startnoauth%
			  <a href="/registration" class="list-group-item list-group-item-action">Регистрация</a>
			  <a href="/auth" class="list-group-item list-group-item-action">Войти</a>
			%endnoauth%

			%startall%
			  <a href="/destructauth" class="list-group-item list-group-item-action">Выйти</a>
			%endall%

			</div>
		</div>
	</div>

</div>
</body>

<footer class='container-fluid p-2 mb-0 pt-3'>
<h5 class='text-end'>...тестовая версия для limb и про limb... 2022 уеарс</h5>
</footer>

<script>

</script>
</html>
<?php
	namespace limb\app\worker;
	use limb\app\base\control as Control;
	use limb\app\modules as Modules;#для авторизации

	/**
	 *
	 */
	class Limb
	{

		function __construct()
		{
			// code...
		}

		public function TemplateMaster($template, $data, $auth, $html)#основная функция для сборки страницы
		# [%массив%], массив с именами как у template, авторизация пользователя, html код для финишного возврата страницы после всех замен
		{
			//сразу меняем заданный темплате
			echo $html;
		}
	}
?>
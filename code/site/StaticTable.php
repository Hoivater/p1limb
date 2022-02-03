<?php
	
namespace limb\code\site;
use limb\app\worker as Worker;
use limb\app\base as Base; #для работы с базой данный

	// require "base/dataBase.php";
	/**
	 * Работа с бд для неизменяемой части страницы
	 */
	class StaticTable
	{
		public $data;

		function __construct()
		{

		}


		protected function Limb($auth = "noauth")#сборщик страницы
		{
			$limb = new Worker\Limb();

			$template = [
				"norepeat" => ["%header_text%", "%name_user%"],
				"replace_standart" => ["menu"],
				"replace_internal" => "no"
			];
			#################формируем data для полной сборки страницы
				#получаем массив данных
			


			$si2 = new Base\SearchInq("3289t_menu");
			$si2 -> selectQ();
			$si2 -> orderDescQ();
			$menu = $si2 -> resQ(); //массив со всеми записями
				#получаем массив данных

			$name = Base\Control\Control::NameUser();


			$page_ini = parse_ini_file(__DIR__."/../../view/page.ini");

			$replace_main_tmplt = ["header_text" => "LIMB БЛОГ", "name_user" => $name];

			$data = [
				"norepeat" => $replace_main_tmplt,
				"replace_standart" => [$menu],
				"replace_internal" => "no"
			];
			#################формируем data для полной сборки страницы


			$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);

			
			return $render;
		}

	}


?>
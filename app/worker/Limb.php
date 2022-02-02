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
		
		{
			if($auth !== "noauth"){
				//сразу меняем заданный %...%
				//затем выдираем повтор и собираем его с заменой
				//далее избавляемся от правил видимости admin, user
				// echo $html;
				#если есть что для простой замены, то заменяем
				if(is_array($template["norepeat"])){
					$html = Control\Necessary::asortReplace($template["norepeat"], $data["norepeat"], $html);	
				}
				//массив названий папок под повторяющуюся замену
				$array_folder = [];

				//массив, массивов data для замены повторов
				$array_data = [];

				//массив массивов tmplt под замену
				$array_tmplt = [];

				//массив того на что нужно заменить массив на уровень выше
				$array_main_replace = [];

				#выдираем повторы при наличии и заменям
				foreach ($template as $key => $value) {
					
				}
				while($template["repeat"] != "no")
				{
					// $array_tmplt[] = $template["norepeat"];
					

				}
			}
		}
	}
?>
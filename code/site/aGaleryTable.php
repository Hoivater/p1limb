<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
	use limb\app\worker as Worker;#для шаблонизатора
	use limb\app\form as Form;
	/**
	 * работа с данными таблицы
	 *
	 */
	class aGaleryTable
	{
		
		public $csrf;
		#public $replace = [$id, $name, $category, $image, $description, $link, $text, $commentary, $date_creation];


		public function __construct()
		{
			#code...
			$this -> csrf = Form\FormBase::csrf();
		}


		protected function Limb($auth)#сборщик страницы
		{
			$limb = new Worker\Limb();
			$galery = [];
			$dir = scandir(__DIR__."/../../resourse/visible/content");
			if(isset($dir[0])){


			unset($dir[0]);
			unset($dir[1]);
			$dir = array_values($dir);
			for($i= 0; $i < count($dir); $i++)
			{
				$galery[$i]["name_image"] = $dir[$i];
			}

			$template = [
				"norepeat" => ["%title%", "%description%", "%module_pagination%", "%name_category%", "%address%", "%smenu%"],
				"repeat_tm" => ["galery"],
				"internal" => [["name" => "left_content", "folder" => "admin_galery"]]
			];
			$data = [
				"norepeat" => ["title" => "Загрузить изображение", "description" => "", "module_pagination" => "", "name_category" => "", "address" => "", "smenu" => ""],
				"repeat_tm" => [$galery],
				"internal" => [[["csrf" => $this -> csrf]]]
			];


			$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);

			return $render;
			}
		}

	}
?>

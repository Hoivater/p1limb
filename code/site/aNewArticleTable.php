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
	class aNewArticleTable
	{
		public $tmpltArticle = ['%id%', '%name%', '%category%', '%image%', '%description%', '%link%', '%text%', '%commentary%', '%date_creation%'];//массив из таблиц
		public $resultArticle;//финишная сборка для шаблона для возврата в _Page
		public $name = '3289t_article';//имя таблицы которое используется по умолчанию
		public $table_key = "`id`, `name`, `category`, `image`, `description`, `link`, `text`, `commentary`, `date_creation`";
		public $csrf;
		#public $replace = [$id, $name, $category, $image, $description, $link, $text, $commentary, $date_creation];


		public function __construct()
		{
			#code...
			$this -> csrf = Form\FormBase::csrf();
		}

		public static function insertFieldLimb($num)
		{
			$name77656756 = '3289t_article';
			$table_key757658 = "`id`, `name`, `category`, `image`, `description`, `link`, `text`, `commentary`, `date_creation`";
			for($i = 0; $i <= $num-1; $i++)
			{
			$id = Control\Generate::this_idgenerate();
			$name = Control\Generate::varchargenerate(50);
			$category = Control\Generate::varchargenerate(30);
			$description = Control\Generate::varchargenerate(100);
			$link = Control\Generate::linkgenerate($name);
			$text = Control\Generate::textgenerate(1800);
			$commentary = 0;
			$date_creation = Control\Generate::this_dategenerate();
			$image = Control\Generate::imagegenerate();
			
			$value = "".$id.", '".$name."', '".$category."', '".$image."', '".$description."', '".$link."', '".$text."', '".$commentary."', '".$date_creation."'";
			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			$result = $ri -> insert($value);
			}
			#code...
		}
		protected function Limb($auth)#сборщик страницы
		{
			$limb = new Worker\Limb();

			$si = new Base\SearchInq("3289t_menu");
			$si -> selectQ();
			$menu = $si -> resQ();

			$template = [
				"norepeat" => ["%title%", "%description%", "%module_pagination%", "%name_category%", "%address%", "%smenu%"],
				"repeat_tm" => ["selectmenu"],
				"internal" => [["name" => "left_content", "folder" => "admin_new_article"]]
			];
			$data = [
				"norepeat" => ["title" => "Добавить статью", "description" => "", "module_pagination" => "", "name_category" => "", "address" => "", "smenu" => ""],
				"repeat_tm" => [$menu],
				"internal" => [[["csrf" => $this -> csrf]]]
			];


			$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);

			return $render;
		}
		protected function LimbRedaction($auth, $link)#сборщик страницы
		{
			$limb = new Worker\Limb();

			$si = new Base\SearchInq("3289t_menu");
			$si -> selectQ();
			$menu = $si -> resQ();

			$si2 = new Base\SearchInq("3289t_article");
			$si2 -> selectQ();
			$si2 -> whereQ('link', $link, "=");
			$article = $si2 -> resQ();
			if(isset($article[0]["id"]))
			{
				$article[0]["csrf"] = $this -> csrf;
				for($i = 0; $i < count($menu); $i++)
				{
					if($menu[$i]["link"] == $article[0]["category"])
					{
						$article[0]["category"] = $menu[$i]["name"];
						continue;
					}
				}
			}

			$template = [
				"norepeat" => ["%title%", "%description%", "%module_pagination%", "%name_category%", "%address%", "%smenu%"],
				"repeat_tm" => ["selectmenu"],
				"internal" => [["name" => "left_content", "folder" => "admin_redaction_article"]]
			];
			$data = [
				"norepeat" => ["title" => "Добавить статью", "description" => "", "module_pagination" => "", "name_category" => "", "address" => "", "smenu" => ""],
				"repeat_tm" => [$menu],
				"internal" => [$article]
			];


			$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);

			return $render;
		}
	}
?>

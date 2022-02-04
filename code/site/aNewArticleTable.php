<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
	use limb\app\worker as Worker;#для шаблонизатора
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
		#public $replace = [$id, $name, $category, $image, $description, $link, $text, $commentary, $date_creation];


		public function __construct()
		{
			#code...
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
				"replace_standart" => [["name" => "selectmenu", "folder" => "admin_new_article"]],
				"replace_internal" => [["name" => "left_content", "folder" => "article"]]
			];
			$data = [
				"norepeat" => ["title" => "Добавить статью", "description" => "", "module_pagination" => "", "name_category" => "", "address" => "", "smenu" => ""],
				"replace_standart" => [[$menu]],
				"replace_internal" => "no"
			];


			$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);

			return $render;
		}
	}
?>

<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
	use limb\app\worker as Worker;#для шаблонизатора
	/**
	 * работа с данными таблицы
	 *
	 */
	class ArticleTable
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

		//метод достаюший все поля из таблицы
		public function searchFieldCom()
		{
			#$si = new Base\SearchInq($name);
			#$si -> select(); 
			#$si ->  where($key, $value, $operator);
			#$si -> limit();
			#$result = $si -> res();

			#code...

		}
		#метод добавляющий данные в таблицу, value - строка следующего вида
		#NULL, '".$this -> title."', '".$this -> keywords."', '".$this -> description."'
		#функция для автозаполнения созданной таблицы, можно корретировать функции, например выбрать fotogenerate /в будущем =)
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

		public static function addArticle($data)
		{

			$image = $data["image"];


			$category = $data["category"];
			$name77656756 = '3289t_article';
			$table_key757658 = "`id`, `name`, `category`, `image`, `description`, `link`, `text`, `commentary`, `date_creation`";
			$id = Control\Generate::this_idgenerate();
			$name = $data["name"];
			$description = $data["description"];
			$link = Control\Generate::linkgenerate($name);
			$text = $data["text"];
			$commentary = 0;
			$date_creation = time();


			// $value = "".$id.", '".$name."', '".$category."', '".$image."', '".$description."', '".$link."', '".$text."', '".$commentary."', '".$date_creation."'";
			// $ri = new Base\RedactionInq($name77656756, $table_key757658);
			// $result = $ri -> insert($value);
			return $result;
		}


		protected function Limb($auth, $link)#сборщик страницы
		{
			$limb = new Worker\Limb();

			$si = new Base\SearchInq($this -> name);
			$si -> selectQ();
			$si -> whereQ("link", $link, "=");
			$si -> orderDescQ();
			$result = $si -> resQ();  //массив со всеми записями



			if(isset($result[0]["id"])){

				$si -> selectQ();
				$si -> whereQ('category', $result[0]["category"], "=");
				$si -> orderDescQ("date_creation");
				$category_article = $si -> resQ();
				$value_category = $result[0]["category"];

				$si2 = new Base\SearchInq("3289t_menu");
				$si2 -> selectQ();
				$si2 -> whereQ('link', $value_category, "=");
				$si2 -> orderDescQ();
				$menu = $si2 -> resQ();
				if(isset($menu[0]["id"]))
					$name_category = $menu[0]["name"];
				else
				{
					$name_category = "Категория не найдена";
				}
				if(isset($category_article[0]["id"]))
				{
					for($i = 0; $i < count($category_article); $i++)
					{
						if($category_article[$i]["id"] == $result[0]["id"])
						{
							$category_article[$i]["active"] = "active";

							if($i < count($category_article)-1)
							{
								$result[0]["linkprev"] = $category_article[$i+1]["link"];	
								$result[0]["name_article_prev"] = $category_article[$i+1]["name"];
							}
							else
							{
								$result[0]["linkprev"] = $category_article[$i]["link"]."/#";
								$result[0]["name_article_prev"] = "Закончились статьи";
							}
							if($i > 1 && $i < count($category_article))
							{
								$result[0]["name_article_back"] = $category_article[$i-1]["name"];				
								$result[0]["linkback"] = $category_article[$i-1]["link"];
							}
							else
							{
								$result[0]["name_article_back"] = "Публикаций раньше не было";		
								$result[0]["linkback"] = $category_article[$i]["link"]."/#";
							}
							

						}
						else
						{
							$category_article[$i]["active"] = " ";
						}
					}
				}
				$result[0]["date_creation"] = Control\Necessary::ConvertDate($result[0]["date_creation"]);
				$template = [
					"norepeat" => ["%title%", "%description%", "%module_pagination%", "%name_category%", "%address%"],
					"internal" => [["name" => "smenu", "folder" => "article"], ["name" => "left_content", "folder" => "article"]],
					"repeat_tm" => ["smenu"]
				];
				$data = [
					"norepeat" => ["title" => $result[0]["name"], "description" => $result[0]["description"], "module_pagination" => "", "name_category" => $name_category, "address" => ""],
					"internal" => [$menu, $result],
					"repeat_tm" => [$category_article]
				];

				$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);
			}
			else
			{
				header("Location:/");
			}
			return $render;
		}
	}
?>

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
		public static function delete_article($link)
		{
			$name77656756 = '3289t_article';
			$table_key757658 = "`id`, `name`, `category`, `image`, `description`, `link`, `text`, `commentary`, `date_creation`";
			
			#удаляем также и комментарии с этой статьей
			$si = new Base\SearchInq("3289t_article");
			$si -> selectQ();
			$si -> whereQ("link", $link, "=");
			$result = $si -> resQ(); 
			if(isset($result[0]["id"]))
			{
				$name776567562 = '3289t_comments';
				$table_key7576582 = "`id`, `id_article`, `level`, `author`, `email`, `comment`, `date`";
				$ri2 = new Base\RedactionInq($name776567562, $table_key7576582);
				$id_article = $result[0]["id"];
				$si2 = new Base\SearchInq("3289t_comments");
				$si2 -> selectQ();
				$si2 -> whereQ("id_article", $id_article, "=");
				$comment_for_delete = $si2 -> resQ();
				for($i = 0; $i < count($comment_for_delete); $i++)
				{
					$ri2 -> delete("id", $comment_for_delete);
				}
			}


			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			$ri -> delete("link", $link);



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

			#UNIQUE LINK

			$si = new Base\SearchInq("3289t_article");
			$si -> selectQ();
			$si -> whereQ("link", $link, "=");
			$result = $si -> resQ();  //массив со всеми записями
			if(isset($result[0]["id"]))
			{
				$link = $link.Control\Generate::nameLatinGenerate(4);
			}
			#UNIQUE LINK


			$text = self::ReText($data["text"]);
			$commentary = 0;
			$date_creation = time();


			$value = "".$id.", '".$name."', '".$category."', '".$image."', '".$description."', '".$link."', '".$text."', '".$commentary."', '".$date_creation."'";
			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			$result = $ri -> insert($value);
			return $result;
		}

		protected static function ReText($text)
		{
			$text = htmlspecialchars_decode($text);
			#ищем все выражения: [code][/code] и внутри них htmlspecialch...
			// codes:
			// echo (int)str_contains($text, "[code]"); 
			if(str_contains($text, "[code]"))
			{
				$start = "[code]";
				$end = "[/code]";

				$html_for_repeat = self::textInternal([$start, $end], $text);#получаем html для повтора
				$html = self::tmpReplace("&&LIMB&&", $text, [$start, $end]);#временная замена повторяющегося участка

				$result_f = $html_for_repeat[1];
				$text = Control\Necessary::standartReplace("&&LIMB&&", htmlspecialchars($result_f, ENT_QUOTES), $text);
			}
			// if(str_contains($text, "[code]") === true) goto codes;
			return $text;
		}

		public static function redArticle($data)
		{
			$table_key757658 = "`id`, `name`, `category`, `image`, `description`, `link`, `text`, `commentary`, `date_creation`";
			$ri = new  Base\RedactionInq("3289t_article", $table_key757658);
			$text = self::ReText($data["text"]);
			$ri -> update("name", $data["name"], "link", $data["link"]);
			$ri -> update("description", $data["description"], "link", $data["link"]);
			$ri -> update("category", $data["category"], "link", $data["link"]);
			$ri -> update("text", $text, "link", $data["link"]);
		}
		#возвращает текст внутри двух элементов массива
		private static function textInternal($arr, $html)
		{
			$num_start = stripos($html, $arr[0]);
			$num_end = stripos($html, $arr[1]) + strlen($arr[0]);
			// echo $num_start." ".$num_end;
			$res = substr($html, $num_start, $num_end-$num_start);
			$res_arr = explode("\n", $res);
			$template = $res_arr[1];
			$template_arr = explode(" ", $template);
			
			$html_res = str_replace($arr, ["", ""], implode("\n", $res_arr));
			$res_temp = [];
			for($i = 0; $i < count($template_arr); $i++)
			{
				$res_temp[] = trim($template_arr[$i]);
			}
			return [$res_temp, $html_res];
		}
		#заменяем повторяющийся текст на значок шаблонизатора &&LIMB&&
		private static function tmpReplace($limb, $html, $arr)
		{
			$num_start = stripos($html, $arr[0]);
			$num_end = stripos($html, $arr[1]) + strlen($arr[0]);
			$s = substr($html, 0, $num_start).$limb.substr($html, $num_end);
			return $s;
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
				$result[0]["csrf"] = Form\FormBase::csrf();
				$result[0]["user"] = Base\Control\Control::NameUser();
				#######################COMMENTARY##############################
				##Простой вид

				$si3 = new Base\SearchInq("3289t_comments");
				$si3 -> selectQ();
				$si3 -> whereQ('id_article', $result[0]["id"], "=");
				$si3 -> orderDescQ();
				$commentary = $si3 -> resQ();

				$result_arr = $si3 -> paginateQ(4);
				#получаем массив данных
				$commentary = $result_arr[0];

				$pagination = $result_arr[1];


				for($j = 0; $j < count($commentary); $j++)
				{
					$commentary[$j]["date"] = Control\Necessary::ConvertTime($commentary[$j]["date"]);
				}
				#######################COMMENTARY##############################
				$template = [
					"norepeat" => ["%title%", "%description%", "%module_pagination%", "%name_category%", "%address%"],
					"internal" => [["name" => "smenu", "folder" => "article"], ["name" => "left_content", "folder" => "article"]],
					"repeat_tm" => ["smenu", "OneComment"]
				];
				$data = [
					"norepeat" => ["title" => $result[0]["name"], "description" => $result[0]["description"], "module_pagination" => $pagination, "name_category" => $name_category, "address" => ""],
					"internal" => [$menu, $result],
					"repeat_tm" => [$category_article, $commentary]
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

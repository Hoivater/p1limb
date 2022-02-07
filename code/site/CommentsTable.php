<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
	use limb\app\worker as Worker;#для шаблонизатора
	/**
	 * работа с данными таблицы
	 *
	 */
	class CommentsTable
	{
		public $tmpltComments = ['%id%', '%id_article%', '%level%', '%author%', '%email%', '%comment%', '%date%'];//массив из таблиц
		public $resultComments;//финишная сборка для шаблона для возврата в _Page
		public $name = '3289t_comments';//имя таблицы которое используется по умолчанию
		public $table_key = "`id`, `id_article`, `level`, `author`, `email`, `comment`, `date`";
		#public $replace = [$id, $id_article, $level, $author, $email, $comment, $date];

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
		public static function addCommentary($data)
		{
			$name77656756 = '3289t_comments';
			$table_key757658 = "`id`, `id_article`, `level`, `author`, `email`, `comment`, `date`";
			
			$id = Control\Generate::this_idgenerate();
			$id_article = $data["id"];//Control\Generate::intgenerate(1);
			$level = 0;#Control\Generate::intgenerate(1);
			$author = $data["user"];
			$email = $_COOKIE['email'];
			$comment = $data["comment"];
			$date = Control\Generate::this_dategenerate();
			$value = "".$id.", '".$id_article."', '".$level."', '".$author."', '".$email."', '".$comment."', '".$date."'";
			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			$result = $ri -> insert($value);


			$si = new Base\SearchInq("3289t_article");
			$si -> selectQ();
			$si -> whereQ("id", $id_article, "=");
			$article = $si -> resQ();  //массив со всеми записями
			if(isset($article[0]["id"]))
			{
				$name776567562 = '3289t_article';
				$table_key7576582 = "`id`, `name`, `category`, `image`, `description`, `link`, `text`, `commentary`, `date_creation`";
				$count = $article[0]["commentary"] + 1;
				$ri = new Base\RedactionInq($name776567562 , $table_key7576582);
				$result = $ri -> update("commentary", $count, "id", $article[0]["id"]);
			}
		}
		#метод добавляющий данные в таблицу, value - строка следующего вида
		#NULL, '".$this -> title."', '".$this -> keywords."', '".$this -> description."'
		#функция для автозаполнения созданной таблицы, можно корретировать функции, например выбрать fotogenerate /в будущем =)
		public static function insertFieldLimb($num)
		{
			$name77656756 = '3289t_comments';
			$table_key757658 = "`id`, `id_article`, `level`, `author`, `email`, `comment`, `date`";
			for($i = 0; $i <= $num-1; $i++)
			{
			$id = Control\Generate::this_idgenerate();
			$id_article = 15;//Control\Generate::intgenerate(1);
			$level = 0;#Control\Generate::intgenerate(1);
			$author = Control\Generate::varchargenerate(20);
			$email = Control\Generate::emailgenerate(100);
			$comment = Control\Generate::textgenerate();
			$date = Control\Generate::this_dategenerate();
			$value = "".$id.", '".$id_article."', '".$level."', '".$author."', '".$email."', '".$comment."', '".$date."'";
			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			$result = $ri -> insert($value);
			}
			#code...
		}
		public static function delete_commentary($id)
		{
			$name77656756 = '3289t_comments';
			$table_key757658 = "`id`, `id_article`, `level`, `author`, `email`, `comment`, `date`";
			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			$ri -> delete("id", $id);
		}

		protected function Limb($auth = "noauth")#сборщик страницы
		{
			$limb = new Worker\Limb();

			$si = new Base\SearchInq("3289t_menu");
			$si -> selectQ();
			$menu = $si -> resQ();

			$si2 = new Base\SearchInq($this -> name);
			$si2 -> selectQ();
			$si2 -> orderDescQ();
			$comment = $si2 -> resQ();

			$result_arr = $si2 -> paginateQ(5);
			#получаем массив данных
			$comment = $result_arr[0];
			$pagination = $result_arr[1];

			$si3 = new Base\SearchInq("3289t_article");

			for($i = 0; $i < count($comment); $i++)
			{	
				$si3 -> selectQ();
				$si3 -> whereQ("id", $comment[$i]["id_article"], "=");
				$res = $si3 -> resQ();

				$comment[$i]["id_article"] = $res[0]["link"];
				$comment[$i]["name_article"] = $res[0]["name"];
				$comment[$i]["date"] = Control\Necessary::ConvertTime($comment[$i]["date"]);
			}

			$template = [
						"norepeat" => ["%title%", "%description%", "%module_pagination%", "%name_category%", "%address%", "%smenu%"],
						"repeat_tm" => ["comMap"],
						"internal" => [["name" => "left_content", "folder" => "admin_comments"]]
					];
			$data = [
				"norepeat" => ["title" => "Комментарии", "description" => "", "module_pagination" => $pagination, "name_category" => "", "address" => "", "smenu" => ""],
				"repeat_tm" => [$comment]
			];


				$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);
			
			return $render;
		}
	}
?>

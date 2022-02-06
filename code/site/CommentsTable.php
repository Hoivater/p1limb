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


		protected function Limb($auth = "noauth")#сборщик страницы
		{
			$limb = new Worker\Limb();

			$si = new Base\SearchInq($this -> name);
			$si -> selectQ();
			$si -> whereQ("link", $link, "=");
			$si -> orderDescQ();
			$result = $si -> resQ();  //массив со всеми записями
			if(isset($result[0]["id"])){

				$template = [
					"norepeat" => ["%title%", "%description%"],
					"replace_standart" => "no",
					"replace_internal" => [["name" => "left_content", "folder" => "article"]]
				];
				$data = [
					"norepeat" => ["title" => $result[0]["name"], "description" => $result[0]["description"]],
					"replace_standart" => "no",
					"replace_internal" => [$result]
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

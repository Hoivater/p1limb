<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
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
			$table_name32432 = '3289t_comments';
			$table_key32323 = "`id`, `id_article`, `level`, `author`, `email`, `comment`, `date`";
			for($i = 0; $i <= $num-1; $i++)
			{
				$id = Control\Generate::this_idgenerate();
				$id_article = Control\Generate::intgenerate(10);
				$level = Control\Generate::intgenerate(10);
				$author = Control\Generate::varchargenerate(100);
				$email = Control\Generate::varchargenerate(100);
				$comment = Control\Generate::textgenerate();
				$date = Control\Generate::this_dategenerate();
				$value3414323 = "".$id.", '".$id_article."', '".$level."', '".$author."', '".$email."', '".$comment."', '".$date."'";
				$ri = new Base\RedactionInq($table_name32432, $table_key32323);

				$result = $ri -> insert($value3414323);
			}


			#code...
		}
	}
?>

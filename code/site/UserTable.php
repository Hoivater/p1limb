<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
	/**
	 * работа с данными таблицы
	 *
	 */
	class UserTable
	{
		public $tmpltUser = ['%id%', '%name%', '%email%', '%password%', '%access_user%', '%code_email%', '%code%', '%date%'];//массив из таблиц
		public $resultUser;//финишная сборка для шаблона для возврата в _Page
		public $name = '3289t_user';//имя таблицы которое используется по умолчанию
		public $table_key = "`id`, `name`, `email`, `password`, `access_user`, `code_email`, `code`, `date`";
		#public $replace = [$id, $name, $email, $password, $access_user, $code_email, $code, $date];


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
			$name77656756 = '3289t_user';
			$table_key757658 = "`id`, `name`, `email`, `password`, `access_user`, `code_email`, `code`, `date`";
			for($i = 0; $i <= $num-1; $i++)
			{
			$id = Control\Generate::this_idgenerate();
			$name = Control\Generate::varchargenerate(20);
			$email = Control\Generate::emailgenerate();
			$password = Control\Generate::passgenerate();
			$access_user = "admin";
			$code_email = "no";
			$code = Control\Generate::codegenerate(33);
			$date = Control\Generate::this_dategenerate();
			$value = "".$id.", '".$name."', '".$email."', '".$password."', '".$access_user."', '".$code_email."', '".$code."', '".$date."'";
			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			$result = $ri -> insert($value);
			}
			#code...
		}
	}
?>

<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
	/**
	 * работа с данными таблицы
	 *
	 */
	class MenuTable
	{
		public $tmpltMenu = ['%id%', '%name%', '%link%', '%visible%'];//массив из таблиц
		public $resultMenu;//финишная сборка для шаблона для возврата в _Page
		public $name = '3289t_menu';//имя таблицы которое используется по умолчанию
		public $table_key = "`id`, `name`, `link`, `visible`";
		#public $replace = [$id, $name, $link, $visible];


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
			$name77656756 = '3289t_menu';
			$table_key757658 = "`id`, `name`, `link`, `visible`";
			for($i = 0; $i <= $num-1; $i++)
			{
			$id = Control\Generate::this_idgenerate();
			$name = Control\Generate::varchargenerate(40);
			$link = Control\Generate::linkgenerate($name);
			$visible = 1;
			$value = "".$id.", '".$name."', '".$link."', '".$visible."'";
			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			$result = $ri -> insert($value);
			}
			#code...
		}
	}
?>

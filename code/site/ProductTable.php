<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
	/**
	 * работа с данными таблицы
	 *
	 */
	class ProductTable
	{
		public $tmpltProduct = ['%id%', '%name%', '%link%', '%description%', '%condition%', '%price_start%', '%price_end%', '%character%', '%foto%', '%type%', '%avaibility%', '%reserve%', '%date_creation%'];//массив из таблиц
		public $resultProduct;//финишная сборка для шаблона для возврата в _Page
		public $name = '3289t_product';//имя таблицы которое используется по умолчанию
		public $table_key = "`id`, `name`, `link`, `description`, `condition`, `price_start`, `price_end`, `character`, `foto`, `type`, `avaibility`, `reserve`, `date_creation`";
		#public $replace = [$id, $name, $link, $description, $condition, $price_start, $price_end, $character, $foto, $type, $avaibility, $reserve, $date_creation];


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
			$name77656756 = '3289t_product';
			$table_key757658 = "`id`, `name`, `link`, `description`, `condition`, `price_start`, `price_end`, `character`, `foto`, `type`, `avaibility`, `reserve`, `date_creation`";
			for($i = 0; $i <= $num-1; $i++)
			{
			$id = Control\Generate::this_idgenerate();
			$name = Control\Generate::varchargenerate(250);
			$link = Control\Generate::varchargenerate(250);
			$description = Control\Generate::varchargenerate(250);
			$condition = Control\Generate::intgenerate(10);
			$price_start = Control\Generate::intgenerate(10);
			$price_end = Control\Generate::intgenerate(10);
			$character = Control\Generate::textgenerate();
			$foto = Control\Generate::textgenerate();
			$type = Control\Generate::textgenerate();
			$avaibility = Control\Generate::booleangenerate();
			$reserve = Control\Generate::intgenerate(10);
			$date_creation = Control\Generate::this_dategenerate();
			$value = "".$id.", '".$name."', '".$link."', '".$description."', '".$condition."', '".$price_start."', '".$price_end."', '".$character."', '".$foto."', '".$type."', '".$avaibility."', '".$reserve."', '".$date_creation."'";
			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			$result = $ri -> insert($value);
			}
			#code...
		}
	}
?>

<?
namespace limb\code\site;
use limb\app\base as Base; #для работы с базой данный
use limb\app\worker as Worker;#для шаблонизатора
	/**
	 * работа с данными таблицы
	 *
	 */
	class MainTable
	{
		protected $left_content;
		protected $main_tmplt = ["%title%", "%description%"];
		protected $main_repeat_tmplt = ["%left_content%"];

		public function __construct()
		{
			$this -> left_content = file_get_contents(__DIR__."/../../view/public/main/left_content.tm");
		}

		//метод достаюший все поля из таблицы
		public function searchFieldCom()
		{
			#$si = new Base\SearchInq($name);
			#$result = $si -> select() ->  where($key, $value, $operator) -> limit() -> res();

			#code...

		}
		#метод добавляющий данные в таблицу, value - строка следующего вида
		#NULL, '".$this -> title."', '".$this -> keywords."', '".$this -> description."'
		public function insertFieldCom($value)
		{
			#$ri = new Base\RedactionInq($this -> name, $this -> table_key);
			#$result = $ri -> insert($value);

			#code...
		}
		protected function Limb($auth = "noauth")#сборщик страницы
		{
			if($auth !== "noauth")
			{
				$si = new Base\SearchInq("3289t_article");
				$si -> selectQ();
				$si -> orderDescQ();
				$result = $si -> resQ(); //массив со всеми записями

				$worker = new Worker\Limb();
				$template = [
					"norepeat" => $this -> main_tmplt,
					"repeat" => $this -> main_repeat_tmplt,
					"folder" => "main"
				];


				$worker -> TemplateMaster($template, $data, $auth, $this -> html);

			}
			else
			{
				echo "РЕГИСТРАЦИЯ НЕПРЕДУСМОТРЕНА";
			}
		}
	}
?>

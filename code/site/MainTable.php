<?
namespace limb\code\site;
use limb\app\base as Base; #для работы с базой данный
use limb\app\worker as Worker;#для шаблонизатора
use limb\app\base\control as Control;

	/**
	 * работа с данными таблицы
	 *
	 */
	class MainTable
	{
		protected $left_content;
		protected $main_tmplt = ["%title%", "%description%", "%module_pagination%", "%smenu%", "%address%"];
		

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
			$limb = new Worker\Limb();

			#################формируем data для полной сборки страницы
				#получаем массив данных
			$si = new Base\SearchInq("3289t_article");
			$si -> selectQ();
			$si -> orderDescQ();
			$result = $si -> resQ();  //массив со всеми записями
			$result_arr = $si -> paginateQ(5);
				#получаем массив данных
			$result = $result_arr[0];

			$pagination = $result_arr[1];

			$page_ini = parse_ini_file(__DIR__."/../../view/page.ini");
			for ($i = 0; $i < count($result); $i++) {
				$result[$i]["date_creation"] = Control\Necessary::ConvertDate($result[$i]["date_creation"]);
			}
			$replace_main_tmplt = ["title" => $page_ini["main_page_title"], "description" => $page_ini["main_page_description"], "module_pagination" => $pagination, "smenu" => "", "address" => ""];

			$template = [
				"norepeat" => $this -> main_tmplt,
				"internal" => [["name" => "left_content", "folder" => "main"]]
			];
			$data = [
				"norepeat" => $replace_main_tmplt,
				"internal" => [$result]
			];
			#################формируем data для полной сборки страницы


			$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);

			
			return $render;
		}
	}
?>

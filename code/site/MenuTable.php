<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
	use limb\app\worker as Worker;
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
		public static function redMenu($post)
		{
			$name77656756 = '3289t_menu';
			$table_key757658 = "`id`, `name`, `link`, `visible`";
			$name = $post["name"];
			$ri = new Base\RedactionInq($name77656756, $table_key757658);
			if($name !== "")
			{

				$id = Control\Generate::this_idgenerate();
				$link = Control\Generate::linkgenerate($name);

				#UNIQUE LINK

				$si = new Base\SearchInq("3289t_menu");
				$si -> selectQ();
				$si -> whereQ("link", $link, "=");
				$result = $si -> resQ();  //массив со всеми записями
				if(isset($result[0]["id"]))
				{
					$link = $link.Control\Generate::nameLatinGenerate(4);
				}
				#UNIQUE LINK


				$visible = 1;
				$value = "".$id.", '".$name."', '".$link."', '".$visible."'";

				$result = $ri -> insert($value);

			}
			if(isset($post["delete"]))
			{
				$idA = [];
				$linkA = [];
				$nameA = [];

				#Получаем список id с которыми необходимо провести какие-то действия
				#Получаем их name,
				#Получаем их link
				foreach ($post as $key => $value) {
					if(str_contains($key, "menu"))
					{
						$idA[] = (int)str_replace("menu", "", $key);
						$linkA[] = $value;
					}
				}
				for($i = 0; $i < count($idA); $i++)
				{
					$nameA[] = $post["text".$idA[$i]];
				}
				if($post["delete"] == "no")
				{
					#изменяем имена
					for ($i=0; $i < count($nameA); $i++) {
						$ri -> update('name', $nameA[$i], 'id', $idA[$i]);
					}

				}
				elseif($post["delete"] == "yes")
				{
					for($i = 0; $i < count($idA); $i++)
						$ri -> delete('id', $idA[$i]);
				}
			}
		}
		protected function Limb($auth, $link)#сборщик страницы
		{
			$limb = new Worker\Limb();

			$si = new Base\SearchInq("3289t_article");
			$si -> selectQ();
			$si -> whereQ("category", $link, "=");
			$si -> orderDescQ();
			$result = $si -> resQ();//массив со всеми записями
			$result_arr = $si -> paginateQ(5);
			$result = $result_arr[0];
			$pagination = $result_arr[1];
			
			#####################################################
			$si2 = new Base\SearchInq("3289t_menu");
			$si2 -> selectQ();
			$si2 -> whereQ('link', $link, "=");
			$si2 -> orderDescQ();
			$menu = $si2 -> resQ();
			if(isset($menu[0]["id"]))
			{
				$name_category = $menu[0]["name"];
				$link_category = $menu[0]["link"];
			}
			else
			{
				$name_category = "Категория не найдена";
			}
			for ($i=0; $i < count($result); $i++) { 
				$result[$i]["date_creation"] = Control\Necessary::ConvertDate($result[$i]["date_creation"]);
			}
			#####################################################

			if(isset($result[0]["id"])){

				$template = [
					"norepeat" => ["%title%", "%description%", "%module_pagination%", "%smenu%"],
					"internal" => [["name" => "left_content", "folder" => "main"], ["name" => "address", "folder" => "category"]]
				];
				$data = [
					"norepeat" => ["title" => $name_category, "description" => $name_category, "module_pagination" => $pagination, "smenu" => ''],
					"internal" => [$result, [["name" => $name_category, "link" => $link_category]]]
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

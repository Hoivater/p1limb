<?
	namespace limb\code\site;
	use limb\app\base as Base;#для работы с валидатором и бд
	use limb\app\base\control as Control;
	/**
	 * формирование логики вывода страницы
	 * Основные функции:
	 * -проверка подключения к бд(этот статус выводится на всех страницах);
	 * -проверка общих настроек;
	 */
	class MenuPage extends MenuTable
	{
		use tPage;

		public function __construct()
		{
			parent::__construct();
			$staticPage = new StaticPage();//получение html кода статической части страницы

			$this -> html = $staticPage -> getStaticPage();
			
		}
		#метод для сборки страницы
		#вся работа с базой данных идет в родительском классе
		#любой возврат собранной таблицы должен возвращаться как
		#$this -> page = $this -> html;
		public function Page($link)
		{
			session_start();
			$auth = Control\Control::IsRules();
			$this -> page = $this -> Limb($auth, $link);
			
		}

	}
?>
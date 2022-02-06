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
	class aNewArticlePage extends aNewArticleTable
	{
		use tPage;

		public function __construct($link = '')
		{
			parent::__construct();
			$staticPage = new StaticPage();//получение html кода статической части страницы

			$this -> html = $staticPage -> getStaticPage();
			if($link == "")
				$this -> Page();
			else
			{
				$this -> redaction($link);
			}
			
		}
		#метод для сборки страницы
		#вся работа с базой данных идет в родительском классе
		#любой возврат собранной таблицы должен возвращаться как
		#$this -> page = $this -> html;
		public function Page()
		{
			session_start();
			$auth = Control\Control::IsRules();
			$this -> page = $this -> Limb($auth);

		}
		public function redaction($link)
		{
			session_start();
			$auth = Control\Control::IsRules();
			$this -> page = $this -> LimbRedaction($auth, $link);

		}

	}
?>
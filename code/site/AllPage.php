<?
	namespace hoivater\dtbs\limb\site;
	use hoivater\dtbs\base as Base;#для работы с валидатором и бд
	use hoivater\dtbs\modules\auth as Auths;
	/**
	 * формирование логики вывода страницы
	 * Основные функции:
	 * -проверка подключения к бд(этот статус выводится на всех страницах);
	 * -проверка общих настроек;
	 */

	#для сборки остальных страниц, кроме предусмотренных таблицами из бд
	class AllPage extends AllTable
	{
		use tPage;

		public function __construct($name_page)
		{
			parent::__construct();
			$staticPage = new StaticPage();//получение html кода статической части страницы

			$this -> html = $staticPage -> getStaticPage();
			// $this -> Page();

		}
		#метод для сборки страницы
		#вся работа с базой данных идет в родительском классе
		public function Page()
		{
			// $this -> page = $this -> html;
		}
		

		public function HeaderBlock($bool)
		{
			if($bool === true)//собираем для администратора
			{
				$html = file_get_contents(__DIR__."/../../tem_public/static/header.tm");
				$authu = Base\Control\Control::IsRules();
				$res = new Auths\AuthAccess($html, $authu);
				$result = $res -> getResult();
				return $result;
			}
		}

	}
?>
<?php

	namespace limb\code\site;

	use limb\app\base\control as Control;
	use limb\app\base as Base;
	use limb\app\form as Form;
	use limb\app\worker as Worker;#для шаблонизатора

	/**
	 *
	 */
	class mapsArticlePage extends ArticleTable
	{

		use tPage;
		public $sort = '';

		public function __construct($sort = '')
		{
			parent::__construct();
			$staticPage = new StaticPage();//получение html кода статической части страницы
			$this -> sort = $sort;
			$this -> html = $staticPage -> getStaticPage();
			$this -> csrf = Form\FormBase::csrf();
			$this -> Page();
		}

		protected function Page()
		{
			session_start();
			$auth = Control\Control::IsRules();
			$this -> page = $this -> LimbMapsArticle($auth);
		}

		protected function LimbMapsArticle($auth)
		{
			$limb = new Worker\Limb();

			$si2 = new Base\SearchInq("3289t_article");
			$si2 -> selectQ();
			$si2 -> orderDescQ($this -> sort);
			// orderAscQ($field = "")
			$article = $si2 -> resQ();
			$result_arr = $si2 -> paginateQ(7);
				#получаем массив данных
			$article = $result_arr[0];

			$pagination = $result_arr[1];
			for ($i = 0; $i < count($article); $i++) {
				$article[$i]["date_creation"] = Control\Necessary::ConvertDate($article[$i]["date_creation"]);
			}
			$template = [
				"norepeat" => ["%title%", "%description%", "%module_pagination%", "%name_category%", "%address%", "%smenu%"],
				"repeat_tm" => ["articleMap"],
				"internal" => [["name" => "left_content", "folder" => "mapsArticle"]]
			];
			$data = [
				"norepeat" => ["title" => "Карта статей", "description" => "", "module_pagination" => $pagination, "name_category" => "", "address" => "", "smenu" => ""],
				"repeat_tm" => [$article],
				"internal" => [[["csrf" => $this -> csrf]]]
			];

			$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);
			return $render;
		}


	}
?>
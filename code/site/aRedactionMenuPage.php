<?php

	namespace limb\code\site;

	use limb\app\base\control as Control;
	use limb\app\base as Base;
	use limb\app\form as Form;
	use limb\app\worker as Worker;#для шаблонизатора

	/**
	 *
	 */
	class aRedactionMenuPage extends MenuTable
	{

		use tPage;

		public function __construct()
		{
			parent::__construct();
			$staticPage = new StaticPage();//получение html кода статической части страницы

			$this -> html = $staticPage -> getStaticPage();
			$this -> csrf = Form\FormBase::csrf();
			$this -> Page();
		}

		protected function Page()
		{
			session_start();
			$auth = Control\Control::IsRules();
			$this -> page = $this -> LimbRedactionMenu($auth);
		}

		protected function LimbRedactionMenu($auth)
		{
			$limb = new Worker\Limb();

			$si = new Base\SearchInq("3289t_menu");
			$si -> selectQ();
			$menu = $si -> resQ();

			$template = [
				"norepeat" => ["%title%", "%description%", "%module_pagination%", "%name_category%", "%address%", "%smenu%"],
				"repeat_tm" => ["selectmenu"],
				"internal" => [["name" => "left_content", "folder" => "admin_redaction_menu"]]
			];
			$data = [
				"norepeat" => ["title" => "Редактирование меню", "description" => "", "module_pagination" => "", "name_category" => "", "address" => "", "smenu" => ""],
				"repeat_tm" => [$menu],
				"internal" => [[["csrf" => $this -> csrf]]]
			];

			$render = $limb -> TemplateMaster($template, $data, $auth, $this -> html);
			return $render;
		}


	}
?>
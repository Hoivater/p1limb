<?php
namespace limb\app\web;
use limb\app\base\control as Control;
	/**
	 *
	 */
	class Visible
	{

		function __construct()
		{
			// code...
		}


		//вспомогательная функция для вывода массива
		public static function PrintRouteArray($route_array)
		{
			foreach ($route_array as $key) {
				echo $key."<br />";
			}
		}
		public static function PrintPage($code)
		{
			$ini = parse_ini_file(__DIR__."/../../setting.ini");
			$code = Control\Necessary::standartReplace("%name_site%", $ini["name_site"], $code);
			echo $code;
		}
	}
?>
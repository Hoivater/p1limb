<?php
namespace limb\app\web;
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
			echo $code;
		}
	}
?>
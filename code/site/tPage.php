<?php

namespace limb\code\site;

	trait tPage{
		public $html;//основная заготовка сайта
		public $page;//результат работы класса
		public $tmplt  = ["%name_as_table%", "%____________%", "%____________%"];//массив для единичной замены staticPage
		public $repeatreplace = ["name1", "name2"];//массив для повторной замены, включая вложенные
		#public $name1 = ["%name_as_table%", "%_____%"];
		#

	}
?>
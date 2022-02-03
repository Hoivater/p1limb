<?php

namespace limb\code\site;

	trait tPage{
		public $html;//основная заготовка сайта
		public $page;//результат работы класса
		public $tmplt  = ["%header_text%"];//массив для единичной замены staticPage
	}
?>
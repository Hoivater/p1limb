<?php

namespace limb\code\site;

	trait tPage{
		public $html;//основная заготовка сайта
		public $page;//результат работы класса
		public $tmplt  = ["%____________%", "%____________%", "%____________%"];//массив для замены staticPage
	}
?>
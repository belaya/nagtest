<?php
//Класс представлений
class View
{
	// здесь можно указать общий вид по умолчанию.
	function generate($content_view, $template_view, $data = null)
	{
		// преобразуем элементы массива в переменные
		if(is_array($data)) {
			extract($data);
		}
		
		include 'views/'.$template_view;
	}
}
<?php
//Класс "рабочего" контроллера, наследуем из основного

class Controller_Main extends Controller
{
	function action_index()
	{	
		$rep = new Reports();

		//подгружаем данные для формы
		$dat = $rep->viewReport();

		//отправляем данные вьюхе
		return $this->view->generate('main.php', 'template.php', $dat);
	}

	function action_ajax()
	{	
		$rep = new Reports();

		//"экранируем" запрос
		$post = array_map('addslashes', $_POST);

		//возвращаем в ajax минимум данных с json
		echo json_encode($rep->dataReport($post));

		return;
	}
}
<?php
// Класс "маршрутизации"

class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';
		
		$routes = explode('/', trim($_SERVER['REQUEST_URI'],'/'));

		// получаем имя контроллера
		if ( !empty($routes[0]) )
		{	
			$controller_name = $routes[0];
		}
		
		// получаем имя экшена
		if ( !empty($routes[1]) )
		{
			$action_name = $routes[1];
		}

		// добавляем префиксы
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "controllers/".$controller_file;

		if(file_exists($controller_path))
		{
			include "controllers/".$controller_file;
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			self::ErrorPage404();
			return;
		}
		
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			self::ErrorPage404();
		}
	
	}
	
	function ErrorPage404()
	{
		//типа обработка ошибки, доделать
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		die();
    }
}
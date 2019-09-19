<?php
//Класс для работы с БД через расширение PDO, ничего лишнего - все наследуем
class DB
{
    protected static $instance = null;
    final private function __construct() {}
    final private function __clone() {}
    public static function instance()
    {
        if (self::$instance === null)
        {
            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => TRUE,
                PDO::ATTR_STATEMENT_CLASS    => array('myPDOStatement'),
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));"//отключаем  ошибку в запросах, в которых не полный список не агрегированных параметров
            );
            $dsn = 'mysql:host=localhost;dbname=nagtest;charset=utf8';
            self::$instance = new PDO($dsn, 'root', '', $opt);
        }
        return self::$instance;
    }
    public static function __callStatic($method, $args) {
        return call_user_func_array(array(self::instance(), $method), $args);
    }
}
class myPDOStatement extends PDOStatement
{
	function execute($data = array())
	{
		parent::execute($data);
		return $this;
	}
}
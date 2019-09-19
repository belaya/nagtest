<?php
//Реализация метода автозагрузки для неопределеннных классов
class Autoloader
{
    public static function register()
    {
        //Регистрирует заданную функцию в качестве реализации метода __autoload()
        spl_autoload_register(function ($class) {

            if (file_exists($file = __DIR__ . DIRECTORY_SEPARATOR . mb_strtolower($class) . '.php')) { //проверяем наличие файла в "ядре"
                require $file;
                return true;
            } else if (file_exists($file = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . mb_strtolower($class) . '.php')) { //проверяем наличие файла в модулях
                require $file;
                return true;
            }

            return false;
        });
    }
}
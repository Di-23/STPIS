<?
set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }
    throw new MException("$errstr 0 $errno $errfile $errline", 1);
});

function load_php($path)
{
	$start = microtime(true); //начало измерения
	require_once $path;
	$end = microtime(true); //конец измерения
	if(isset($DEBUG))
		echo "Время выполнения $path скрипта: ".($end - $start); //вывод результата
}
date_default_timezone_set('Europe/Moscow');
ini_set('memory_limit', -1);

load_php("storage/config.php");//Конфигурация сервера

load_php("data/exc/MException.php");//Исключения
load_php("data/exc/authException.php");//Исключения
load_php("data/exc/regException.php");//Исключения
load_php("data/exc/sqlException.php");//Исключения


load_php("data/plugins/email.php");//Инициализация среды системы
load_php("data/plugins/minify.php");//Сжатие файлов
load_php("theme/manager.php");//Инициализация интерфейса сайта

load_php("utils.php");//Инициализация среды системы
load_php("sql/sqli.php");//Инициализация базы данных
load_php("data/Account.php");//Менеджер аккаунтов
load_php("data/Friends.php");//Менеджер аккаунтов
load_php("data/post.php");//Менеджер аккаунтов
load_php("data/chat.php");//Менеджер аккаунтов
load_php("data/likes.php");//Менеджер аккаунтов
load_php("data/Session.php");//Менеджер сессий
load_php("data/verifier.php");//Верификация полей и данных

load_php("data/plugins/image.php");//Сжатие файлов
load_php("data/plugins/audio.php");//Сжатие файлов

load_php("router.php");
?>
<?php
function flush_page($path)
{
	if(end(Request::$URL_PARTS)=='ajax')
	{
		require_once 'pages/'.$path;
		echo '<script>'.JS::$additional.'</script>';
	}
	else
	{
		//$start = microtime(true); //начало измерения
		view::init_page();
		view::getHeader(session::isAuthorized() && Request::$URL_PARTS[1]!="team");
		require_once 'pages/'.$path;
		view::getFooter();
		//$end = microtime(true); //конец измерения
		//if($end - $start > 0.9)
		//	echo "Время выполнения скрипта: ".($end - $start); //вывод результата
	}
	exit();
}

if(isset (Request::$REDIRECT))
{
	header('Location: '.Request::$REDIRECT);
	exit;
}
else
{
	if(isset (MException::$CEXCEPTION))
	{
		flush_page("error.php");
	}
	else
	{
		
		if(session::isAuthorized())
		switch (Request::$URL_PARTS[1]) {
			case "": 
					header('Location: '."/feed/");
				break;
			case "feed":
				flush_page("feed.php");
				break;
                        case "team":
				flush_page("team.php");
				break;
			case "id":
				flush_page("account.php");
				break;
			case "friends":
				flush_page("friends.php");
				case "im":
					flush_page("chat.php");
				break;
			case "music":
				flush_page("audio.php");
				break;
			case "logout":
				account::logout();
				header('Location: '."/");
				break;
			default:
				flush_page("notfound.php");
		}
		else
		switch (Request::$URL_PARTS[1]) {
			case "": 
                                flush_page("unauth.php");
				break;
			case "team":
				flush_page("team.php");
				break;
			case "registration":
				flush_page("registration.php");
				break;
			default:
				flush_page("notfound.php");
		}
	}
	
}
?>
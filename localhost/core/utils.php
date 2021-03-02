<?
function getimg($path,$width = 0,$height = 0,$crop = true,$ifnull = null)
{
	return Image::getimage($path,$width,$height,$crop,$ifnull);
}

function minname($path)
{
	return '/'.(md5($path)).'.'.pathinfo($path, PATHINFO_EXTENSION);
}

function getAbPath($path)
{
	return $text = str_replace('\\', '/', __DIR__.'/..'.$path);
}
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

function getpost($elem)
{
	if(isset($_POST[$elem]))
		return htmlspecialchars($_POST[$elem]);
	else
		return null;
}

class Request {
	static function init() {
		self::$URL =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		self::$URL_PARTS = explode('/',$_SERVER['REQUEST_URI']);
		self::$METHOD = $_SERVER['REQUEST_METHOD'];
		self::$FROMIP = $_SERVER['REMOTE_ADDR'];
		self::$TIMESTUMP = time();
		self::$SERVERNAME = $_SERVER['HTTP_HOST'];
		self::$URL_REQUEST = $_SERVER['REQUEST_URI'];
		self::$USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
	}
	
    public static $URL;		// ex. http://example.com/news
	public static $URL_PARTS;  // ex. http://example.com/news/23 ['news',23]
    public static $METHOD;		// ex. GET
	public static $FROMIP;		// ex. 127.0.0.1
	public static $TIMESTUMP;	// ex. 01/01/1970
	public static $SERVERNAME; // Url ex. [http://example.com]/news
	public static $URL_REQUEST;// Url ex. http://example.com[/news]
	public static $USER_AGENT; // ex. Chrome...
	
	public static $PAGEERROR;  // Other errors
	public static $AUTHERROR;  // Errors on auth
	public static $REDIRECT;   // Redirect to page
}

Request::init();




  function now()
  {
      return date("Y-m-d H:i:s");
  }


  function HumanDatePrecise($date) {
    $r = false;
    $a = preg_split("/[:\.\s-]+/", $date);
    $d = time() - strtotime($date);
    if ($d > 0) {
      if ($d < 3600) {
//минут назад
        switch (floor($d / 60)) {
          case 0:
          case 1:
          case 2:
            return "<acronym title='$date'>только что</acronym>";
            break;
          case 3:
            return "<acronym title='$date'>три минуты назад</acronym>";
            break;
          case 4:
            return "<acronym title='$date'>четыре минуты назад</acronym>";
            break;
          case 5:
            return "<acronym title='$date'>пять минут назад</acronym>";
            break;
          default:
            return "<acronym title='$date'>" . floor($d / 60) . ' мин назад</acronym>';
            break;
        };
      } elseif ($d < 18000) {
//часов назад
        switch (floor($d / 3600)) {
          case 1:
            return "<acronym title='$date'>час назад</acronym>";
            break;
          case 2:
            return "<acronym title='$date'>два часа назад</acronym>";
            break;
          case 3:
            return "<acronym title='$date'>три часа назад</acronym>";
            break;
          case 4:
            return "<acronym title='$date'>четыре часа назад</acronym>";
            break;
        };
      } elseif ($d < 172800) {
//сегодня
//2011-07-14 16:20:44
// 0    1  2  3  4  5
        if (date('d') == $a[2]) {
          return "<acronym title='$date'>сегодня в {$a[3]}:{$a[4]}</acronym>";
        }
        if (date('d', time() - 86400) == $a[2]) {
          return "<acronym title='$date'>вчера в {$a[3]}:{$a[4]}</acronym>";
        }
        if (date('d', time() - 172800) == $a[2]) {
          return "<acronym title='$date'>позавчера в {$a[3]}:{$a[4]}</acronym>";
        }
      }
    } else {
////////////////////////////////////////////////////////////////////////////////////////
// В будущем   <editor-fold defaultstate="collapsed" desc="В будущем">
      $d *= - 1;
      if ($d < 3600) {
//минут назад
        switch (floor($d / 60)) {
          case 0:
          case 1:
            return "<acronym title='$date'>сейчас</acronym>";
            break;
          case 2:
            return "<acronym title='$date'>через две минуты</acronym>";
            break;
          case 3:
            return "<acronym title='$date'>через три минуты</acronym>";
            break;
          case 4:
            return "<acronym title='$date'>через четыре минуты</acronym>";
            break;
          case 5:
            return "<acronym title='$date'>через пять минут</acronym>";
            break;
          default:
            return "<acronym title='$date'>через " . floor($d / 60) . ' мин.</acronym>';
            break;
        };
      } elseif ($d < 18000) {
//часов назад
        switch (floor($d / 3600)) {
          case 1:
            return "<acronym title='$date'>через час</acronym>";
            break;
          case 2:
            return "<acronym title='$date'>через два часа</acronym>";
            break;
          case 3:
            return "<acronym title='$date'>через три часа</acronym>";
            break;
          case 4:
            return "<acronym title='$date'>через четыре часа</acronym>";
            break;
        };
      } elseif ($d < 172800) {
//сегодня
//2011-07-14 16:20:44
// 0    1  2  3  4  5
        if (date('d') == $a[2]) {
          return "<acronym title='$date'>сегодня в {$a[3]}:{$a[4]}</acronym>";
        }
        if (date('d', time() - 86400) == $a[2]) {
          return "<acronym title='$date'>завтра в {$a[3]}:{$a[4]}</acronym>";
        }
        if (date('d', time() - 172800) == $a[2]) {
          return "<acronym title='$date'>послезавтра в {$a[3]}:{$a[4]}</acronym>";
        }
      }
      $d *= - 1;
//, В будущем   </editor-fold>
////////////////////////////////////////////////////////////////////////////////////////.
    }
 
    $r = "{$a[2]}.{$a[1]}";
    if ($a[0] != date('Y') OR $d > 0) {
      $r .= '.' . $a[0];
    }
    $r .= " {$a[3]}:{$a[4]}";
    $date.= 'error';
    return "<acronym title='$date'>$r</acronym>";
  }
  
  
  if(config::$config['enabled'] == "false")
  {
	view::init_page();
	view::getHeader();
	require_once 'pages/maintenance.php';
	view::getFooter();
	exit();
  }
?>
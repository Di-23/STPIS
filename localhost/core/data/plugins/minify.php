<?
class minify {
    public static function gethtml($buffer) {
        $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s', '/<!--(.|\s)*?-->/');
        $replace = array('>', '<', '\\1', '');
        $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }

    public static function getjs($path, $move = true) {
        $fpath = getAbPath($path);
        $fminified = ($move ? getAbPath('/core/theme/assets/js/min') . minname($path) :
                pathinfo($fpath, PATHINFO_DIRNAME) . minname($path));
        if (!file_exists($fminified) || filemtime($fminified) < filemtime($fpath)) {
            require_once 'jsmin.php';
            $output = file_get_contents($fpath); //JSMin::minify(file_get_contents($fpath));
            file_put_contents($fminified, $output);
        }
        return pathinfo($path, PATHINFO_DIRNAME) . ($move ? '/min' : '') . minname($path);
    }

    public static function getcss($path, $move = true) {
        $fpath = getAbPath($path);
        $fminified = ($move ? getAbPath('/core/theme/assets/css/min') . minname($path) :
                pathinfo($fpath, PATHINFO_DIRNAME) . minname($path));
        if (!file_exists($fminified) || filemtime($fminified) < filemtime($fpath)) {
            require_once 'cssmin.php';
            $output = CssMin::minify(file_get_contents($fpath));
            file_put_contents($fminified, $output);
        }
        return pathinfo($path, PATHINFO_DIRNAME) . ($move ? '/min' : '') . minname($path);
    }

    /* Add multiple files array */

    /*
      //example
      fmerged = "core/theme/assets/css/all.css"
      $files = array('bootstrap.css','carousel.css');
     */

    public static function getMerged($files, $fmerged) {
        foreach ($files as $file) {
            if (!file_exists(getAbPath($fmerged)) || (filemtime(getAbPath($fmerged)) < filemtime(getAbPath($file)))) {
                $output = '';
                foreach ($files as $file) {
                    $output .= file_get_contents(getAbPath($file));
                }
                file_put_contents(getAbPath($fmerged), $output);
                return $fmerged . '?hash=' . filemtime(getAbPath($fmerged));
            }
        }
        return $fmerged . '?hash=' . filemtime(getAbPath($fmerged));
    }

}
ob_start("minify::gethtml");
?>
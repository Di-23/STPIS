<?php
class config{
    public static $config;
    public static function save()
    {
        $ini = "";
        foreach (self::$config as $key => $value) {
            $ini=$ini."$key=\"$value\"\n";
        }
        echo $ini;
        file_put_contents('core/storage/wteme_new', $ini);
    }
}
config::$config = parse_ini_file('wteme');
?>
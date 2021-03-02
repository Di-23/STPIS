<?
class SQL {
    const NONE = 0x00;
    const FETCH = 0x01;
    const FETCHALL = 0x02;
    const COUNT = 0x03;
    
    private static $conn;
    private static $stmt;

    static function init($path) {
        try {
            self::$conn = new PDO($path);
        } catch (PDOException $e) {
            die("this>connection failed: " . $e->getMessage());
        }
    }
    
    static function exec($query,$values,$operation)
    {
        self::$stmt = self::$conn->prepare($query);
        if (!self::$stmt) {
            echo "\nPDO::errorInfo():\n$query\n";
            print_r(self::$conn->errorInfo());
        }
        self::$stmt->execute($values);
        switch($operation)
        {
            case self::FETCH:
                return self::$stmt->fetch(PDO::FETCH_ASSOC);
            case self::FETCHALL:
                return self::$stmt->fetchAll(PDO::FETCH_ASSOC);
            case self::COUNT:
                return self::$stmt->fetchColumn();
            default:
                return null;
        }
    }
}

SQL::init('sqlite:' . getAbPath(config::$config["sql_file"]));
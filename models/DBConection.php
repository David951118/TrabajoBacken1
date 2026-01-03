<?php
class DBConection
{
    private static $mysqli;

    private static $init = false;

    public static function initConnectionDb()
    {
        $db_host = 'localhost';
        $db_user = 'root';
        $db_password = '';
        $db_db = 'actividad1_1';
        $db_port = 3307; 

        $mysqli = @new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_db,
            $db_port
        );

        if ($mysqli->connect_error) {
            die('Errno: ' . $mysqli->connect_errno . '<br>' . 'Error: ' . $mysqli->connect_error);

        }

        self::$mysqli = $mysqli;
        self::$init = true;

        return $mysqli;
    }
    public static function getConnection()
    {
        if (self::$init)
            return self::$mysqli;
        else
            return self::initConnectionDb();
    }
}
?>
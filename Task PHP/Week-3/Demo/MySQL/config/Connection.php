<?php

/* Class Connection
 * @property object $database to know the state are connected or not connect
 * @method connect()
 * */
class Connection
{
    private static $database;

    /* Method connect to database in MySQL with PDO
     * return object
     * */
    public function connect()
    {
        if (!isset(self::$database)) {
            $config = parse_ini_file('config.ini');
            self::$database = new PDO(
                "mysql:host={$config['host']}; dbname={$config['database']}; charset={$config['charset']}",
                $config['username'],
                $config['password']
            );
        }

        if (self::$database == false) {
            die('Connect was failed..');
        }
        return self::$database;
    }
}

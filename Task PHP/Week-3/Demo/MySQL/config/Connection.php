<?php

class Connection
{
    private static $database;

    /**
     * Method connect to database in MySQL with PDO
     * @return object
     */
    public function connect()
    {
        // Check the state of $database are connect or not
        if (!isset(self::$database)) {
            $config = parse_ini_file('config.ini');
            self::$database = new PDO(
                "mysql:host={$config['host']}; dbname={$config['database']}; charset={$config['charset']}",
                $config['username'],
                $config['password']
            );
        }

        // Check $database connect success or fail
        if (self::$database == false) {
            die('Connect was failed..');
        }
        return self::$database;
    }
}

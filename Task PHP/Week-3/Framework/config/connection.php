<?php

Class Database
{
    private static $connect;

    /**
     * Method to connect MySQL with PDO
     * @return object
     */
    public static function getInstance()
    {
        if (!isset(self::$connect)) {
            self::$connect = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_DATABASE,
                DB_USERNAME, DB_PASSWORD);
        }

        if (self::$connect == false) {die('Connect was failed..');}
        return self::$connect;
    }
}
<?php
class Database 
{
	private $connect;

	public function __construct()
	{
	    if (!isset($this->connect))
	    {
	        // Get data from config.ini file
            $config = parse_ini_file('config.ini');
            // Connect to database
            $this->connect = new mysqli($config["host"], $config['username'], $config["password"], $config["databasename"])
                or die("Can't connect to database: ".$config["databasename"]);
        }
	}

	public function execute($query)
    {
        $rows = [];
        $result = $this->connect->query($query);
        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }
        return $rows;
    }

    public function insertUser($user, $password, $email, $birth)
    {
        $query = "SELECT * FROM user";
    }

}
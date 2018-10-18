<?php
class Database 
{
    // Variable to get/set this connection.
	private $connect;

	// Function set connect to database when class Database was initialized
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

	/* Function get list user from table user
	    - Input: none.
	    - Output: array with all data of user.
	*/
	public function listUser()
    {
        $query = "SELECT * FROM user";
        $rows = [];
        $result = $this->connect->query($query);
        while ($item = $result->fetch_assoc()) {
            $rows[] = $item;
        }
        return $rows;
    }

    /* Function insert a new user to table user
	    - Input: username, password, email, birthday.
	    - Output: return true if name and email not exist in table user else return false.
	*/
    public function insertUser($username, $password, $email, $birthday)
    {
        // Get all user data in table user
        $list = $this->listUser();
        $check = true;

        /*  Check this name and this email in list user
            If name or email or both are exist, set a session with error text.
            check = false.
        */
        foreach ($list as $user) {
            if ($username == $user["username"]) {
                $_SESSION["errorName"] = "This username has already exists";
                $check = false;
            }
            if ($email == $user["email"]) {
                $_SESSION["errorEmail"] = "This email has already exists";
                $check = false;
            }
        }

        // if check = true: insert to database and return true else return false.
        if ($check) {
            $query = "INSERT INTO user(username, password, email, birthday) 
            VALUES('$username', '$password', '$email', '$birthday')";
            $this->connect->query($query);
            return $check;
        }
        return $check;
    }


}
<?php
include_once '../config/Connection.php';

/* Class User
 * @method show()
 * @method insert($name, $pass, $email, $birthday)
 * @method update($id, $name, $pass, $email, $birthday)
 * @method delete($id)
 * @method find($id)
 * */
class User
{
    /* Method to show all user in table User
     * @return array
     * */
    public static function show()
    {
        $pdo = new Connection();
        $database = $pdo->connect();
        $stmt = $database->prepare('SELECT * FROM user');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /* Method to insert new user to table User
     * @param string $name is the name of new user
     * @param string $pass is the password of new user
     * @param string $email is the email of new user
     * @param string $birthday is the day of birth of new user
     * @return boolean
     * */
    public static function insert($name, $pass, $email, $birthday)
    {
        $pdo = new Connection();
        $database = $pdo->connect();
        $stmt = $database->prepare('INSERT INTO user(username, password, email, birthday) VALUES(?, ?, ?, ?)');
        $data = [$name, $pass, $email, $birthday];
        return ($stmt->execute($data)) ? true : false;
    }

    /* Method to update a exist user in table User
    * @param int $id is the ID of this user
    * @param string $name is the name of this user
    * @param string $pass is the password of this user
    * @param string $email is the email of this user
    * @param string $birthday is the day of birth of this user
    * @return boolean
    * */
    public static function update($id, $name, $pass, $email, $birthday)
    {
        $pdo = new Connection();
        $database = $pdo->connect();
        $stmt = $database->prepare('UPDATE user SET username=?, password=?, email=?, birthday=? WHERE id=?');
        $data = [$name, $pass, $email, $birthday, $id];
        return ($stmt->execute($data)) ? true : false;
    }

    /* Method to delete a exist user in table User
    * @param int $id is the ID of this user
    * @return boolean
    * */
    public static function delete($id)
    {
        $pdo = new Connection();
        $database = $pdo->connect();
        return ($database->exec("DELETE FROM user WHERE id=$id")) ? true : false;
    }
}

<?php

class session
{
    private $db;

    // Initialization method of class
    public function __construct()
    {
        // function to override all functions of default session in php
        session_set_save_handler(
            [$this, 'open'],
            [$this, 'close'],
            [$this, 'read'],
            [$this, 'write'],
            [$this, 'destroy'],
            [$this, 'gc']
        );

        register_shutdown_function('session_write_close');
    }

    /*  Method to start sessions
     *  @param string $sessionName to set name for this Session
     *  @param boolean $secure to make sure cookie will sent sent over secure connections or not.
     *  */
    public function start_session($sessionName, $secure)
    {
        $httponly = true;

        // Hash algorithm to use for the sessionid
        $session_hash = 'sha512';

        if (in_array($session_hash, hash_algos())) {
            ini_set('session.hash_function', $session_hash);
        }

        /* How many bits per character of the hash:
           The possible values are '4-bits' (0-9, a-f), '5-bits' (0-9, a-v), and '6-bit' (0-9, a-z, A-Z, "-", ",")
        */
        ini_set('session.hash_bits_per_character', 5);

        // Force the session just only use cookies
        ini_set('session.use_cookies', 1);

        // Get all parameters of cookie
        $cookieParams = session_get_cookie_params();

        // Set all parameters of cookie
        session_set_cookie_params(
            $cookieParams["lifetime"],
            $cookieParams["path"],
            $cookieParams["domain"],
            $secure,
            $httponly
        );

        // Change the session name
        session_name($sessionName);

        // Start the session
        session_start();

        /* This line regenerates the session and delete the old session.
         It also generates a new encryption key in the database.
        */
        session_regenerate_id(true);
    }

    /*  Method to connect to database
     *  return boolean
     *  */
    public function open()
    {
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'secure_sessions';
        $connect = new mysqli($host, $user, $password, $database);
        $this->db = $connect;
        return true;
    }

    /*  Method to close connected with database
     *  return boolean
     *  */
    public function close()
    {
        $this->db->close();
        return true;
    }

    /*  Method to get data of id input session
     *  @param string $id to get id of session in database
     *  return string $data of session
     * */
    public function read($id)
    {
        if (!isset($this->read_stmt)) {
            $this->read_stmt = $this->db->prepare("SELECT data FROM sessions WHERE id = ?");
        }
        $this->read_stmt->bind_param('s', $id);
        $this->read_stmt->execute();
        $this->read_stmt->store_result();
        // Bind result to new variable $data
        $this->read_stmt->bind_result($data);
        $this->read_stmt->fetch();
        $key = $this->getkey($id);
        $data = $this->decrypt($data, $key);
        return $data;
    }

    /*  Method to insert a new session or update old session
     *  @param string $id to get id of session in database or set a new id for new session
     *  @param string $data to get data of session in database or set a new data for new session
     *  return boolean
     * */
    public function write($id, $data)
    {
        // Get unique key
        $key = $this->getkey($id);
        // Encrypt the data
        $data = $this->encrypt($data, $key);

        $time = time();
        if (!isset($this->w_stmt)) {
            $this->w_stmt = $this->db->prepare("REPLACE INTO sessions (id, set_time, data, session_key) VALUES (?, ?, ?, ?)");
        }

        $this->w_stmt->bind_param('siss', $id, $time, $data, $key);
        $this->w_stmt->execute();
        return true;
    }

    /*  Method to remove a session with input id
     *  @param string $id to get session in database
     *  return boolean
     * */
    function destroy($id)
    {
        if (!isset($this->delete_stmt)) {
            $this->delete_stmt = $this->db->prepare("DELETE FROM sessions WHERE id = ?");
        }
        $this->delete_stmt->bind_param('s', $id);
        $this->delete_stmt->execute();
        return true;
    }

    /*  Method garbage collector to remove old sessions in database when the time exist are over
     *  @param string $max to get life time of session in database
     *  return boolean
     * */
    function gc($max)
    {
        if (!isset($this->gc_stmt)) {
            $this->gc_stmt = $this->db->prepare("DELETE FROM sessions WHERE set_time < ?");
        }
        $old = time() - $max;
        $this->gc_stmt->bind_param('s', $old);
        $this->gc_stmt->execute();
        return true;
    }

    /*  Method to get sessionID or create a new random sessionID
     *  @param string $id to get id of session in database
     *  return string $key or $random_key
     * */
    private function getkey($id)
    {
        if (!isset($this->key_stmt)) {
            $this->key_stmt = $this->db->prepare("SELECT session_key FROM sessions WHERE id = ?");
        }
        $this->key_stmt->bind_param('s', $id);
        $this->key_stmt->execute();
        $this->key_stmt->store_result();
        if ($this->key_stmt->num_rows == 1) {
            // bind result to new variable $key
            $this->key_stmt->bind_result($key);
            $this->key_stmt->fetch();
            return $key;
        } else {
            $random_key = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            return $random_key;
        }
    }

    /*  Method to encrypt a data of session with sessionID
     *  @param string $data is a data will be encrypt
     *  @param string $key is sessionID of this session
     *  return string $encrypted is a encrypted data
     * */
    private function encrypt($data, $key)
    {
        $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
        $key = substr(hash('sha256', $salt . $key . $salt), 0, 32);
        $iv_size = openssl_cipher_iv_length('AES-256-CBC');
        $iv = openssl_random_pseudo_bytes($iv_size);
        $encrypted = base64_encode(openssl_encrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        return $encrypted;
    }

    /*  Method to decrypt a data of session with sessionID
     *  @param string $data is a encrypted data will be decrypt
     *  @param string $key is sessionID of this session
     *  return string $decrypted is a decrypted data
     * */
    private function decrypt($data, $key)
    {
        $salt = 'cH!swe!retReGu7W6bEDRup7usuDUh9THeD2CHeGE*ewr4n39=E@rAsp7c-Ph@pH';
        $key = substr(hash('sha256', $salt . $key . $salt), 0, 32);
        $iv_size = openssl_cipher_iv_length('AES-256-CBC');
        $iv = openssl_random_pseudo_bytes($iv_size);
        $decrypted = base64_encode(openssl_encrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv));
        return $decrypted;
    }
}

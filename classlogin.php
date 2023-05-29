<?php

class Login
{
    private $errors = "";

    public function check_login($username)
    {
        $query = "SELECT username from users WHERE username = '$username' limit 1";
        $DB = new database();
        $result = $DB->read($query);
        if ($result) {
            return true;
        }
        return false;

    }
}

?>
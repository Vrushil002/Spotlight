<?php

class User
{
    public function get_data($username)
    {

        $query = "SELECT * from users WHERE username = '$username' limit 1";
        $DB = new Database();
        $result = $DB->read($query);
        if ($result) {
            $row = $result[0];
            return $row;
        } else {
            return false;
        }
    }
}

?>
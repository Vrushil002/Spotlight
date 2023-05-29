<?php

class database{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "spotlight";

    function connect()
    {
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        return $connection;
    }

    function read($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);
        if(!$result){
            return false;
        }
        else{
            $data = "";
            while($row = mysqli_fetch_assoc($result))
            {
                $data[] = $row;
            }

            return $data;
            
        }
    }
    
    function save($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);
        if(!$result){
            return false;
        }
        else{
            return true;
        }

    }

}


?>
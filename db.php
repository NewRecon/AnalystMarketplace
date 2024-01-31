<?php

class Db
{
    private $conn;

    private $params = array(
    "host"=>"localhost",
    "user"=>"root",
    "pass"=>"",
    "db"=>"ozon",
    );

    private $default = array(
        "port"=>3306,
        "socket"=>NULL,
        "charset"=>"utf8",
        "errmode"=>"exception",
        "exception"=>"Exception"
    );

    function __construct($opt = array())
    {
        $opt = array_merge($this->params,$this->default,$opt);

        $this->conn = mysqli_connect(
            $opt["host"],
            $opt["user"],
            $opt["pass"],
            $opt["db"],
            $opt["port"],
            $opt["socket"]
        );
    }

    function __destruct()
    {
        $this->conn->close();
        unset($this->conn);
    }

    public function queryDB($query)
    {
        return mysqli_query($this->conn, $query);
    }
}
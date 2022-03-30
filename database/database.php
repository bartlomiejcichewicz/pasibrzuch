<?php

class Db_Connection
{
    /** @var mysqli */
    public $conn;
    public $criticalMsg = "Wystąpił poważny problem, pracujemy nad tym :)";
    /** @var  mysqli_result*/
    public $lastResult;
    public $lastQuery;
    /**
     * @var string
     */
    public $error;

    public function __construct()
    {
        $config = file_get_contents(ROOT_DIR . "config/config.json");
        if (!$config) {
            exit($this->criticalMsg);
        }
        $config = json_decode($config);
        $this->conn = new mysqli($config->hostname, $config->username, $config->password, $config->database);
    }

    public function Query($qry)
    {
        $qry = htmlspecialchars($qry);
        $this->lastQuery = $qry;
        $this->lastResult = $this->conn->query($qry);
        $this->error = $this->conn->error;
        return $this->lastResult;
    }

    public function FetchLastResult($assoc = false)
    {
        return $assoc ? mysqli_fetch_assoc($this->lastResult) : $this->lastResult->fetch_row();
    }

    public function FetchAllResults($assoc = false, $recognizeBy = false)
    {
        $results = [];
        while($row = $this->FetchLastResult($assoc)) {
            if($recognizeBy) {
                $results[$row[$recognizeBy]][] = $row;
            } else {
                $results[] = $row;
            }
        }
        return $results;
    }

    public function GetLastIntesrtedId()
    {
        return $this->conn->insert_id;
    }
}

<?php

require_once dirname(__FILE__, 2) . '/config/config.php';

class Database
{
    private
    $db_conn,
    $affected_row;

    public function connect()
    {
        try {
            $this->db_conn = new PDO(PDO_CFG, DB_USER, DB_PWD);
        } catch (PDOException $err) {
            echo json_encode([
                "ok" => false,
                "error" => $err->getMessage()
            ]);
        }
    }

    public function dbQuery($sql, $params = [])
    {
        $this->affected_row = 0;

        if (!isset($this->db_conn) || empty($this->db_conn)) {
            $this->connect();
        }

        try {
            $query = $this->db_conn->prepare($sql);
            $query->execute($params);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $this->affected_row = $query->rowCount();
            return $result;

        } catch (PDOException $err) {
            echo json_encode([
                "ok" => false,
                "error" => $err->getMessage()
            ]);
        }
    }

    public function affectedCount()
    {
        return $this->affected_row;
    }

    public function close()
    {
        $this->db_conn = null;
    }
}
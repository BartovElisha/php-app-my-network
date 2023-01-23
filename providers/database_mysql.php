<?php

require_once dirname(__FILE__, 2) . '/config/config.php';

class Database
{
    private
    $db_conn;

    public function connect()
    {
        try {
            $this->db_conn = mysqli_connect(
                DB_URL,
                DB_USER,
                DB_PWD,
                DB_NAME
            );
        } catch (Exception $err) {
            echo json_encode([
                "ok" => false,
                "error" => $err->getMessage()
            ]);
        }
    }

    public function selectRecords($sql)
    {
        $data = [];
        $result = mysqli_query($this->db_conn, $sql);

        if (!$result || mysqli_num_rows($result) === 0) {
            return $data;
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }

    public function runQuery($sql)
    {
        $result = mysqli_query($this->db_conn, $sql);
        return ($result && mysqli_affected_rows($this->db_conn) > 0);
    }

    public function close()
    {
        $this->db_conn = null;
    }
}
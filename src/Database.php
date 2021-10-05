<?php declare(strict_types=1);

namespace App;


use mysqli;

class Database
{
    /**
     * EXAMPLE:
     * $sql = "SELECT * FROM users WHERE id = ? and created_at >= ?;"
     * $types = "is";
     * $params = [1, '2021-01-01'];
     * $dbQuery = new Database();
     * $results = $dbQuery->query($sql, $types, $params);
     * unset($dbQuery, $params, $types, $sql);
     */

    /**
     * @return mysqli
     */
    protected function connect(): mysqli
    {
        $name = $_ENV['DB_NAME'];
        $host = $_ENV['DB_HOST'];
        $port = (int)$_ENV['DB_PORT'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        return new mysqli($host, $user, $pass, $name, $port);
    }

    /**
     * @param string $sql
     * @param string $types
     * @param array $params
     * @return mixed|void
     */
    public function query(string $sql, string $types, array $params)
    {
        $mysqli = $this->connect();
        if ($mysqli->connect_error) {
            die('Connection failed: ' . $mysqli->connect_error);
        }

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        $mysqli->close();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
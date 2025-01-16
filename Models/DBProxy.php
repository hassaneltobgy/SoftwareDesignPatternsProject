<?php

class DBProxy {
    private $conn;
    private $isAdmin = false;

    public function __construct($isAdmin = false) {
        $this->conn = Database::getInstance()->getConnection();
        $this->isAdmin = $isAdmin;
    }

    public function execute($query, $params = []) {
        if (!$this->conn) {
            echo "Database connection error.";
            return false;
        }

        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            echo "SQL Error: " . $this->conn->error;
            return false;
        }

        if (!empty($params)) {
            $paramTypes = ''; 
            foreach ($params as $param) {
                if (is_int($param)) {
                    $paramTypes .= 'i';
                } elseif (is_double($param)) {
                    $paramTypes .= 'd';
                } else {
                    $paramTypes .= 's';
                }
            }

            $stmt->bind_param($paramTypes, ...$params);
        }

        if (!$stmt->execute()) {
            echo "Error executing query: " . $stmt->error;
            return false;
        }

        if (strpos(strtoupper($query), 'SELECT') !== false) {
            return $stmt->get_result();
        }

        return true;
    }

    
    public function executeQuery($query, $params = []) {
        if ($this->isAdmin) {
            return $this->execute($query, $params); // Let the admin execute any query
        } else {
                // echo "You do not have permission to make actions.";
                return false;
            
        }
    }
}

?>
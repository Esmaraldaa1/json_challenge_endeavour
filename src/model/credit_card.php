<?php
require_once __DIR__ . '/../db.php';

class CreditCard {
    private PDO $db_connection;

    function __construct () {
        $this->db_connection = create_db_connection();
    }

    function create ($credit_card): int {
        $sql = "
        INSERT INTO credit_card (
            `type`, 
            `number`, 
            `name`, 
            `expiration_date`
        ) VALUES (
            :type, 
            :number, 
            :name, 
            :expirationDate
        )";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->execute($credit_card);
        return $this->db_connection->lastInsertId();
    }
}
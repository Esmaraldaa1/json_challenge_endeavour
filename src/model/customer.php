<?php
require_once __DIR__ . '/../db.php';

class Customer {
    private PDO $db_connection;
    private CreditCard $credit_card;

    function __construct() {
        $this->db_connection = create_db_connection();
        $this->credit_card = new CreditCard();
    }

    function valid($customer): bool {
        // Validate age if the date of birth is present and valid
        if ($customer['date_of_birth'] && (bool)strtotime($customer['date_of_birth'])) {
            $year = date('Y', strtotime($customer['date_of_birth']));
            $age = date('Y') - $year;

            return $age >= 18 && $age <= 65;
        }
        return true;
    }

    function create ($customer): void {
        // convert boolean to integer because MySQL makes a boolean a tinyint(1)
        if ($customer['checked']) {
            $customer['checked'] = 1;
        } else {
            $customer['checked'] = 0;
        }

        // Convert date to a valid date, or null
        if ($customer['date_of_birth'] && (bool)strtotime($customer['date_of_birth'])) {
            $customer['date_of_birth'] = date('Y-m-d', strtotime($customer['date_of_birth']));
        } else {
            // Not converting 19/11/2005, I could spend more time on it, but it's not useful for this exercise
            $customer['date_of_birth'] = null;
        }

        $customer['credit_card_id'] = $this->credit_card->create($customer['credit_card']);
        unset($customer['credit_card']);

        $sql = "
        INSERT INTO customer (
            `account`, 
            `name`, 
            `address`, 
            `checked`, 
            `description`, 
            `interest`, 
            `date_of_birth`, 
            `email`, 
            `credit_card_id`
        ) VALUES (
            :account, 
            :name, 
            :address, 
            :checked, 
            :description, 
            :interest, 
            :date_of_birth, 
            :email,
            :credit_card_id
        )";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->execute($customer);
    }

    function exists ($account): bool {
        $sql = "SELECT * FROM customer WHERE account = :account";
        $stmt = $this->db_connection->prepare($sql);
        $stmt->execute(['account' => $account]);
        return (bool)$stmt->fetch();
    }
}
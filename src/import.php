<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/model/customer.php';
require __DIR__ . '/model/credit_card.php';

// Changed challenge.json to remove the last customer (which was incomplete) and close the array
$customers_data = file_get_contents(__DIR__."/challenge.json");
$customers = json_decode($customers_data, true);

$customer_object = new Customer();

$created = 0;
$not_created = 0;
$not_valid = 0;

foreach($customers as $customer) {
    if (!$customer_object->valid($customer)) {
        $not_valid++;
        echo "X";
        continue;
    }

    if (!$customer_object->exists($customer['account'])) {
        $customer_object->create($customer);
        $created++;
        echo "+";
    } else {
        $not_created++;
        echo ".";
    }
}

echo "\nCreated: $created";
echo "\nSkipped: $not_created";
echo "\nNot valid: $not_valid";
echo "\nTotal: " . count($customers) . "\n";
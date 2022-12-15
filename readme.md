# PXL.WIDGETS JSON challenge
A small JSON import assignment to test my skills.

## Get started
1. Install dependencies:
```shell
composer install
```

2. Add database credentials by copying `.env.example` to `.env`.

3. Create database structure from `db.sql`.

4. Run the import script:
```shell
php src/import.php
```

The response shows a dot (.) when it's not processing the customer, an X when the customer is not valid, and a + when the customer has been created. In the end it shows the total number of customers processed.

The process can be stopped at any time, and it will resume where it left off (without duplicates).
<?php

require __DIR__ . '/../vendor/autoload.php';

use Iceithq\Accounting\AccountingClient;

// Initialize client
$client = new AccountingClient('https://accounting.iceithq.com');
$response = $client->login('your_username', 'your_password');
$token = $response->token;

// Fetch customers
$customers = $client->get_customers($token);
print_r($customers);

// Fetch companies
$companies = $client->get_companies($token);
print_r($companies);

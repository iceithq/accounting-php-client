# Accounting PHP Client

PHP client library for connecting to the ICEIT Accounting System API.

Provides simple methods to access customers, companies, sales orders, invoices, and other accounting-related data.

## Installation

Install via Composer:

```bash
composer require iceithq/accounting-php-client
```

If you are using a private repository, make sure to add it under the repositories section in your composer.json.

## Usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Iceithq\Accounting\AccountingClient;

// Initialize client
$client = new AccountingClient('https://accounting.iceithq.com', 'your-api-key');
$response = $client->login('your_username', 'your_password');
$token = $response->token;

// Fetch customers
$customers = $client->get_customers($token);
print_r($customers);

// Fetch companies
$companies = $client->get_companies($token);
print_r($companies);
```

## Features
* Connect to ICE Accounting System
* Fetch customers and companies
* (Upcoming) Create sales orders
* (Upcoming) Fetch invoices

## Requirements
* PHP 7.4 or higher
* Composer
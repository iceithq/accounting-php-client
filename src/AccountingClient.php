<?php

/**
 * AccountingClient.php
 * 
 * PHP client library for connecting to the ICE Accounting System API.
 * 
 * Provides simple methods to access customers, companies, sales orders, invoices, and other accounting-related data.
 * 
 * @package  Iceithq\Accounting
 * @author   Ian Escarro <ian.escarro@email.com>
 * @license  MIT License
 * @version  1.0.0
 */

namespace Iceithq\Accounting;

class AccountingClient
{
    var $url;
    var $debug;

    function __construct($url = '', $debug = false)
    {
        $this->init($url, $debug);
    }

    function init($url, $debug = false)
    {
        $this->url = $url;
        $this->debug = $debug;
    }

    function set_url($url)
    {
        $this->url = $url;
    }

    function hello()
    {
        return $this->get_response($this->get($this->url . '/hello'));
    }

    function login($username, $password)
    {
        $data = array('username' => $username, 'password' => $password);
        return $this->get_response($this->post($this->url . '/api/login', $data));
    }

    function get_companies($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_companies', $data));
    }

    function select_company($token, $company_id)
    {
        $data = array('token' => $token, 'company_id' => $company_id);
        return $this->get_response($this->post($this->url . '/api/select_company', $data));
    }

    function get_items($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_items', $data));
    }

    function get_units($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_units', $data));
    }

    function get_expenses($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_expenses', $data));
    }

    function get_sales_receipts($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_sales_receipts', $data));
    }

    function get_journal_entries($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_journal_entries', $data));
    }

    // function get_estimates($token) {
    //   $data = array('token' => $token);
    //   return $this->get_response($this->get($this->url . '/api/get_estimates', $data));
    // }

    function get_invoices($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_invoices', $data));
    }

    function get_customers($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_customers', $data));
    }

    function get_bills($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_bills', $data));
    }

    function get_vendors($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_vendors', $data));
    }

    function get_revenues($token)
    {
        $data = array('token' => $token);
        return $this->get_response($this->get($this->url . '/api/get_revenues', $data));
    }

    function get($url, $data = array())
    {
        $curl = curl_init();

        $params = http_build_query($data);
        $url_with_params = $url . '?' . $params;
        if ($this->debug) {
            echo $url_with_params . '<br>';
        }
        curl_setopt($curl, CURLOPT_URL, $url_with_params);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_HTTPGET, 1);

        $output = curl_exec($curl);

        curl_close($curl);
        return $output;
    }

    function post($url, $data, $headers = null, $username = '', $password = '')
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        $params = http_build_query($data);
        if ($this->debug) {
            echo $url . ' <br>';
            print_r($data);
            echo '<br>';
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($username && $password) {
            curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
        }

        $output = curl_exec($ch);

        curl_close($ch);
        return $output;
    }

    function get_response($response)
    {
        //    if (!$this->debug) {
        $response = json_decode($response);
        //    }
        return $response;
    }
}

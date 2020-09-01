<?php

namespace Javaabu\BmlConnect;

use Javaabu\BmlConnect\Services\Client;

class BmlConnect
{
    const TRANSACTIONS_SANDBOX_ENDPOINT = 'https://transactions.uat.merchants.bankofmaldives.com.mv/';
    const TRANSACTIONS_PRODUCTION_ENDPOINT = 'https://transactions.merchants.bankofmaldives.com.mv/';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $transactions_url;

    /**
     * @var string
     */
    private $api_key;

    /**
     * Constructor
     *
     * @param string $api_key
     * @param string $app_id
     * @param string $mode
     * @param array $client_options
     */
    public function __construct(
        string $api_key,
        string $app_id,
        $mode = 'production',
        array $client_options = []
    )
    {
        $this->client = new Client($api_key, $app_id, $mode, $client_options);

        $this->api_key = $api_key;

        $this->transactions_url = $mode == 'production' ?
                    self::TRANSACTIONS_PRODUCTION_ENDPOINT :
                    self::TRANSACTIONS_SANDBOX_ENDPOINT;
    }

    /**
     * Create a transaction
     *
     * @param array $json
     * @return mixed
     */
    public function createTransaction(array $json)
    {
        return $this->client->transactions->create($json);
    }

    /**
     * Get the url for a transaction
     *
     * @param $id
     * @return mixed
     */
    public function getTransactionUrl(string $id)
    {
        return $this->transactions_url . $id;
    }

    /**
     * Get a specific transaction
     *
     * @param $id
     * @return mixed
     */
    public function getTransaction(string $id)
    {
        return $this->client->transactions->get($id);
    }

    /**
     * List transactions
     *
     * @param array $params
     * @return mixed
     */
    public function listTransactions(array $params = [])
    {
        return $this->client->transactions->list($params);
    }

    /**
     * Cancel a transaction
     *
     * @param $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancelTransaction(string $id)
    {
        return $this->client->post('transactions/cancel', compact('id'));
    }

    /**
     * Make a signature
     *
     * @param $amount
     * @param string $currency
     * @param string $method
     * @return string
     */
    public function makeSignature($amount, string $currency, $method = 'sha1')
    {
        $str = 'amount='.$amount.
            '&currency='.$currency.
            '&apiKey='.$this->api_key;

        if ($method == 'md5') {
            return md5($str);
        }

        return sha1($str);
    }

}

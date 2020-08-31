<?php

namespace Javaabu\BmlConnect;

use Javaabu\BmlConnect\Services\Client;

class BmlConnect
{
    /**
     * @var Client
     */
    protected $client;

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
    public function listTransactions(array $params)
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
}

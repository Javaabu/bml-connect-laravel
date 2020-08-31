<?php

namespace Javaabu\BmlConnect\Services;


use BMLConnect\Transactions;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Str;

/**
 * Methods from \BMLConnect\Client has been rewritten
 * since the original class properties had private access
 * and the endpoints had to be modified to allow support
 * for cancel action
 *
 * @package Javaabu\BmlConnect\Services
 */

class Client extends \BMLConnect\Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $http_client;

    /**
     * @var string
     */
    protected $api_key;

    /**
     * @var string
     */
    protected $app_id;

    /**
     * @var string
     */
    protected $mode;

    /**
     * @var array
     */
    protected $client_options;

    /**
     * @var string
     */
    protected $base_url;

    /**
     * @var Transactions
     */
    public $transactions;

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
        parent::__construct($api_key, $app_id, $mode, $client_options);

        $this->api_key = $api_key;
        $this->app_id = $app_id;
        $this->mode = $mode;
        $this->base_url = ($mode === 'production' ? self::BML_PRODUCTION_ENDPOINT : self::BML_SANDBOX_ENDPOINT);
        $this->client_options = $client_options;

        $this->initHttpClient();

        $this->transactions = new Transactions($this);
    }

    /**
     * @param GuzzleClient $client
     */
    public function setClient(GuzzleClient $client)
    {
        $this->http_client = $client;
    }

    /**
     * Initiates the HttpClient with required headers
     */
    protected function initHttpClient()
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' =>  $this->api_key,
            ]
        ];

        $this->http_client = new GuzzleClient(array_replace_recursive($this->client_options, $options));
    }

    /**
     * Build the url
     *
     * @param $endpoint
     * @return string
     */
    protected function buildUrl($endpoint)
    {
        $base_url = $this->base_url;

        if ($endpoint == 'transactions/cancel') {
            $base_url = Str::beforeLast($base_url, 'public/');
        }

        return $base_url . $endpoint;
    }

    /**
     * @param Response $response
     * @return mixed
     */
    protected function parseResponse(Response $response)
    {
        $stream = \GuzzleHttp\Psr7\stream_for($response->getBody());
        $data = json_decode($stream);

        return $data;
    }

    /**
     * @param string $endpoint
     * @param array $json
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($endpoint, $json)
    {
        $json['apiVersion'] = self::BML_API_VERSION;
        $json['appVersion'] = self::BML_APP_VERSION;
        $json['signMethod'] = self::BML_SIGN_METHOD;

        $response = $this->http_client->request('POST', $this->buildUrl($endpoint), ['json' => $json]);
        return $this->parseResponse($response);
    }

    /**
     * @param string $endpoint
     * @param array $pagination
     * @return mixed
     */
    public function get(string $endpoint, array $pagination = [])
    {
        $response = $this->http_client->request(
            'GET',
            $this->setPagination($this->buildUrl($endpoint), $pagination)
        );

        return $this->parseResponse($response);
    }

    /**
     * @param string $url
     * @param array $pagination
     * @return string
     */
    protected function setPagination(string $url, array $pagination)
    {
        if (count($pagination)) {
            return $url.'?'.http_build_query($this->sanitizePagination($pagination));
        }

        return $url;
    }

    /**
     * @param array $pagination
     * @return array
     */
    protected function sanitizePagination(array $pagination)
    {
        $allowed = [
            'page',
        ];

        return array_intersect_key($pagination, array_flip($allowed));
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->api_key;
    }
}

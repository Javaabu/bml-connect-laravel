<?php

namespace Javaabu\BmlConnect\Services;


class Client extends \BMLConnect\Client
{
    // endpoints modified to support cancel operation
    const BML_SANDBOX_ENDPOINT = 'https://api.uat.merchants.bankofmaldives.com.mv/';
    const BML_PRODUCTION_ENDPOINT = 'https://api.merchants.bankofmaldives.com.mv/';

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
    }
}

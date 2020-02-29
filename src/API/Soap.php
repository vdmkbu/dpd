<?php

namespace Vdmkbu\Dpd\API;


use Vdmkbu\Dpd\Config;

class Soap extends \SoapClient
{
    protected $auth;
    protected $soap_options = [
        'connection_timeout' => 20,
    ];

    public function __construct($wsdl, array $options = [], Config $config)
    {
        try {
            $this->auth = [
                'clientNumber' => $config->get('clientNumber'),
                'clientKey'    => $config->get('clientKey')
            ];

            if (empty($this->auth['clientNumber']) || empty($this->auth['clientKey']))
            {
                throw new \Exception('DPD: Authentication data is not provided');
            }

            parent::__construct(
                $config->get('server') . $wsdl,
                array_merge($options, $this->soap_options));
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function execute($method, $args, $wrap = 'request')
    {
        $params = array_merge($args, ['auth' => $this->auth]);
        $request = $wrap ? [$wrap => $params] : $params;

        return $this->$method($request);
    }
}
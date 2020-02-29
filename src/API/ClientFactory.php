<?php

namespace Vdmkbu\Dpd\API;


use Vdmkbu\Dpd\Config;

class ClientFactory
{
    public static function create($wsdl, Config $config)
    {
        if (class_exists('\\SoapClient')) {
            return new Soap($wsdl, [], $config);
        }

        throw new \Exception('Soap client is not found');
    }
}
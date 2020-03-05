<?php

namespace Vdmkbu\Dpd\Tests;

use PHPUnit\Framework\TestCase;
use Vdmkbu\Dpd\Config;
use Vdmkbu\Dpd\Services\Order\OrderTracking;

class OrderTrackingTest extends TestCase
{
    /** @test */
    public function testOrder()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $config = new Config([
            'clientNumber' => getenv('DPD_CLIENT_NUMBER'),
            'clientKey' => getenv('DPD_CLIENT_KEY'),
            'server' => getenv('DPD_TEST_SERVER')
        ]);

        $code = "RU028215333";
        $order = new OrderTracking($config);

        var_dump($order->getStatusList($code));
        var_dump($order->getLastStatus($code));


    }
}
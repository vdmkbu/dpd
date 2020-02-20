<?php

namespace Vdmkbu\Dpd\Tests;

use PHPUnit\Framework\TestCase;
use Vdmkbu\Dpd\Calculator;
use Vdmkbu\Dpd\Config;
use Vdmkbu\Dpd\Shipment;

class CalculatorTest extends TestCase
{
    /** @test */
    public function testCalculator()
    {

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $config = new Config([
            'clientNumber' => getenv('DPD_CLIENT_NUMBER'),
            'clientKey' => getenv('DPD_CLIENT_KEY'),
            'server' => getenv('DPD_TEST_SERVER')
        ]);

        // Челябинск
        $from_city_id = "49265227";

        // Калуга
        $to_city_id = "195733465";

        $weight = 3;
        $cost = 400;
        $length = 5;
        $width = 6;
        $height = 7;
        $Qty = 8;

        $shipment = new Shipment();
        $shipment->setSender($from_city_id);
        $shipment->setReceiver($to_city_id);
        $shipment->setSelfDelivery(false);
        $shipment->setPickup(true);

        $items = [
            'weight'=>$weight,
            'cost'=>$cost,
            'length'=>$length,
            'width'=>$width,
            'height'=>$height,
            'quantity'=>$Qty
        ];

        $shipment->setItems($items);

        $calculator = new Calculator($config);
        // общая функция
        $calc_result = $calculator->getDeliveryCost($shipment);

        var_dump($calc_result);

    }
}
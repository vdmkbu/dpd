<?php

namespace Vdmkbu\Dpd\Tests;

use PHPUnit\Framework\TestCase;
use Vdmkbu\Dpd\Config;
use Vdmkbu\Dpd\Shipment;

class CalculatorTest extends TestCase
{
    /** @test */
    public function testCalculator_with_multi_service_code()
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
        $length = 50;
        $width = 50;
        $height = 10;
        $Qty = 1;

        $shipment = new Shipment($config);
        $shipment->setSender($from_city_id);
        $shipment->setReceiver($to_city_id);
        $shipment->setSelfDelivery(false);
        $shipment->setPickup(true);
        $shipment->setServiceCode("IND,PCL");

        $items = [
            'weight'=>$weight, // вес посылки, кг
            'cost'=>$cost,     // стоимость
            'length'=>$length, // длина посылки, см
            'width'=>$width,   // ширина посылки, см
            'height'=>$height, // высота посылки, см
            'quantity'=>$Qty   // количество посылок
        ];

        $shipment->setItems($items);

        $calculator = $shipment->calculator()->getDeliveryCost();
        self::assertNotNull($calculator);

        $cost = $calculator->getCostByCode("PCL");
        $days = $calculator->getDaysByCode("PCL");
        $name = $calculator->getNameByCode("PCL");

        self::assertEquals($calculator->getCalculatedData()->return[0]->serviceName, $name);
        self::assertEquals($calculator->getCalculatedData()->return[0]->cost, $cost);
        self::assertEquals($calculator->getCalculatedData()->return[0]->days, $days);

        $cost = $calculator->getCostByCode("IND");
        $days = $calculator->getDaysByCode("IND");
        $name = $calculator->getNameByCode("IND");

        self::assertEquals($calculator->getCalculatedData()->return[1]->serviceName, $name);
        self::assertEquals($calculator->getCalculatedData()->return[1]->cost, $cost);
        self::assertEquals($calculator->getCalculatedData()->return[1]->days, $days);
    }

    /** @test */
    public function testCalculator_with_single_service_code()
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
        $length = 50;
        $width = 50;
        $height = 10;
        $Qty = 1;

        $shipment = new Shipment($config);
        $shipment->setSender($from_city_id);
        $shipment->setReceiver($to_city_id);
        $shipment->setSelfDelivery(false);
        $shipment->setPickup(true);
        $shipment->setServiceCode("PCL");

        $items = [
            'weight'=>$weight, // вес посылки, кг
            'cost'=>$cost,     // стоимость
            'length'=>$length, // длина посылки, см
            'width'=>$width,   // ширина посылки, см
            'height'=>$height, // высота посылки, см
            'quantity'=>$Qty   // количество посылок
        ];

        $shipment->setItems($items);

        $calculator = $shipment->calculator()->getDeliveryCost();
        self::assertNotNull($calculator);


        $cost = $calculator->getCostByCode("PCL");
        $days = $calculator->getDaysByCode("PCL");
        $name = $calculator->getNameByCode("PCL");

        self::assertEquals($calculator->getCalculatedData()->return->serviceName, $name);
        self::assertEquals($calculator->getCalculatedData()->return->cost, $cost);
        self::assertEquals($calculator->getCalculatedData()->return->days, $days);
    }
}
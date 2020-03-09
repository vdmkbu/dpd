<?php

namespace Vdmkbu\Dpd\Tests;

use PHPUnit\Framework\TestCase;
use Vdmkbu\Dpd\Config;
use Vdmkbu\Dpd\Services\Order\Order;

class CreateOrderTest extends TestCase
{

    /** @test */
    public function testCreate()
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $config = new Config([
            'clientNumber' => getenv('DPD_CLIENT_NUMBER'),
            'clientKey' => getenv('DPD_CLIENT_KEY'),
            'server' => getenv('DPD_TEST_SERVER')
        ]);

        $order = new Order($config);

        $order
            ->setDatePickup('2020-03-10')
            ->setSenderName('Иванов Сергей Петрович')
            ->setSenderCountryName('Россия')
            ->setSenderCity('Люберцы')
            ->setSenderStreet('Авиаторов')
            ->setSenderStreetAbbr('ул')
            ->setSenderHouse('1')
            ->setSenderFio('Смирнов Игорь Николаевич')
            ->setSenderPhone('89165555555')
            ->setPickupTimePeriod('9-18')
            ->setPayer('1021004119')
            ->setOrderNumberInternal(time())
            ->setServiceCode('CUR')
            ->setServiceVariant('ДД')
            ->setCargoNumPack(5)
            ->setCargoWeight(5)
            ->setCargoRegistered(false)
            ->setCargoCategory('Одежда')
            ->setReceiverName('Иванов Сергей Петрович')
            ->setReceiverCountryName('Россия')
            ->setReceiverCity('Люберцы')
            ->setReceiverStreet('Авиаторов')
            ->setReceiverStreetAbbr('ул')
            ->setReceiverHouse('2')
            ->setReceiverFio('Смирнов Игорь Николаевич')
            ->setReceiverPhone('89165555555');

        $order_status = $order->manage()->create();


        self::assertNotNull($order_status);
        self::assertNotNull($order_status->getOrderNum());
        self::assertNotNull($order_status->getStatus());
        self::assertNotNull($order_status->getOrderNumInternal());
    }
}
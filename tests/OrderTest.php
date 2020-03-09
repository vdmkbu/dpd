<?php

namespace Vdmkbu\Dpd\Tests;

use PHPUnit\Framework\TestCase;
use Vdmkbu\Dpd\Config;
use Vdmkbu\Dpd\Order;

class OrderTest extends TestCase
{
    /** @test */
    public function testOrder()
    {
        $config = new Config();

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


            self::assertNotNull($order);
            self::assertEquals('2020-03-10', $order->getDatePickup());
            self::assertEquals('Иванов Сергей Петрович', $order->getSenderName());
            self::assertEquals('Россия', $order->getSenderCountryName());

    }
}
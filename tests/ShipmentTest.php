<?php

namespace Vdmkbu\Dpd\Tests;


use Vdmkbu\Dpd\Config;
use Vdmkbu\Dpd\Shipment;
use PHPUnit\Framework\TestCase;

class ShipmentTest extends TestCase
{
    /** @test */
    public function testShipment()
    {
        $config = new Config();

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

        $shipment = new Shipment($config);
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

        self::assertNotNull($shipment);
        self::assertEquals(3, $shipment->getItemsWeight());
        self::assertEquals(400, $shipment->getItemsCost());
        self::assertEquals("49265227", $shipment->getSender());
        self::assertEquals("195733465", $shipment->getReceiver());
        self::assertTrue($shipment->getPickup());
        self::assertFalse($shipment->getSelfDelivery());

    }
}
<?php

namespace Vdmkbu\Dpd\Tests;


use Vdmkbu\Dpd\Shipment;
use PHPUnit\Framework\TestCase;

class ShipmentTest extends TestCase
{
    /** @test */
    public function testShipment()
    {
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

        var_dump($shipment);

        //TODO: проверить геттеры

    }
}
<?php

namespace Vdmkbu\Dpd\Tests;

use PHPUnit\Framework\TestCase;
use Vdmkbu\Dpd\Types\Cost;

class CostTest extends TestCase
{

    /** @test */
    public function testCost()
    {

        $cost = new \StdClass();
        $data = new \StdClass();
        $other = new \StdClass();

        $data->serviceCode = 'MAX';
        $data->serviceName = 'DPD MAX domestic';
        $data->cost = 1014;
        $data->days = 6;

        $other->serviceCode = 'NDY';
        $other->serviceName = 'DPD EXPRESS';
        $other->cost = 2413.9;
        $other->days = 2;

        $cost->return = [
            $data,
            $other
        ];

        $cost = new Cost($cost);


        self::assertEquals('DPD MAX domestic', $cost->getNameByCode('MAX'));
        self::assertEquals(6, $cost->getDaysByCode('MAX'));
        self::assertEquals(1014, $cost->getCostByCode('MAX'));
    }
}
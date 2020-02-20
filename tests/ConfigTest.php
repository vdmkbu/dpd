<?php

namespace Vdmkbu\Dpd\Tests;

use PHPUnit\Framework\TestCase;
use Vdmkbu\Dpd\Config;

class ConfigTest extends TestCase
{
    /** @test */
    public function testConfig()
    {
        $config = new Config([
           'foo' => 'bar'
        ]);

        self::assertNotNull($config);

    }

    /** @test */
    public function testSet()
    {
        $config = new Config([
            'foo' => 'bar'
        ]);

        $config->set('foo2', 'bar2');
        $bar2 = $config->get('foo2');

        self::assertEquals('bar2', $bar2);
    }

    public function testGet()
    {
        $config = new Config([
            'foo' => 'bar'
        ]);

        $bar = $config->get('foo');
        self::assertEquals('bar', $bar);
    }

}
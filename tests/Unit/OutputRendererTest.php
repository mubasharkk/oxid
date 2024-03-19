<?php

use Mubasharkk\Oxid\Renderer\OutputRenderer;

class OutputRendererTest extends \PHPUnit\Framework\TestCase
{

    public function testJsonAndStringOutput()
    {
        $data = [
            "EUR" => 31206.98,
            "USD" => 34000,
            "CHF" => 30270.77,
            "CNY" => 244662.72,
            "PKR" => 9502525.41,
            "AED" => 124827.92,
            "OMR" => 13106.93,
            "BTC" => 0.5,
        ];

        $renderer = new OutputRenderer($data, 'EUR');

        $this->assertJsonStringEqualsJsonString(
            \json_encode($data),
            $renderer->toJson()
        );

        $this->assertEquals(
            http_build_query($data),
            (string)$renderer
        );
    }
}
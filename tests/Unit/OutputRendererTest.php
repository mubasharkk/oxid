<?php

use Mubasharkk\Oxid\Renderers\JsonRenderer;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(JsonRenderer::class)]
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

        $renderer = new JsonRenderer($data);

        $this->assertJsonStringEqualsJsonString(
            \json_encode($data),
            $renderer->generate()
        );
    }
}
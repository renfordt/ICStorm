<?php


use renfordt\ICStorm\EventTransparency;
use PHPUnit\Framework\TestCase;

class EventTransparencyTest extends TestCase
{
    public function testTransparentCase()
    {
        $this->assertEquals('TRANSPARENT', EventTransparency::transparent);
    }

    public function testOpaqueCase()
    {
        $this->assertEquals('OPAQUE', EventTransparency::opaque);
    }

    public function testCases()
    {
        $this->assertEquals(['transparent' => 'TRANSPARENT', 'opaque' => 'OPAQUE'], EventTransparency::cases());
    }
}

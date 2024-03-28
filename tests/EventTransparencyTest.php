<?php


use PHPUnit\Framework\Attributes\CoversClass;
use renfordt\ICStorm\EventTransparency;
use PHPUnit\Framework\TestCase;

#[CoversClass(EventTransparency::class)]
class EventTransparencyTest extends TestCase
{
    public function testTransparentCase()
    {
        $this->assertEquals('TRANSPARENT', EventTransparency::transparent->value);
    }

    public function testOpaqueCase()
    {
        $this->assertEquals('OPAQUE', EventTransparency::opaque->value);
    }

    public function testCases()
    {
        $cases = EventTransparency::cases();
        $this->assertCount(2, $cases);
        dump($cases);

        $this->assertEquals('TRANSPARENT', $cases['transparent']);
        $this->assertEquals('OPAQUE', $cases['opaque']);
    }
}

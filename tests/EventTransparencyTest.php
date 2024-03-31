<?php


use PHPUnit\Framework\Attributes\CoversClass;
use renfordt\ICStorm\EventTransparencyEnum;
use PHPUnit\Framework\TestCase;

#[CoversClass(EventTransparencyEnum::class)]
class EventTransparencyTest extends TestCase
{
    public function testTransparentCase()
    {
        $this->assertEquals('TRANSPARENT', EventTransparencyEnum::transparent->value);
    }

    public function testOpaqueCase()
    {
        $this->assertEquals('OPAQUE', EventTransparencyEnum::opaque->value);
    }

    public function testCases()
    {
        $cases = EventTransparencyEnum::cases();
        $this->assertCount(2, $cases);

        $this->assertInstanceOf(EventTransparencyEnum::class, $cases[0]);
        $this->assertInstanceOf(EventTransparencyEnum::class, $cases[1]);

        $this->assertEquals('TRANSPARENT', $cases[0]->value);
        $this->assertEquals('OPAQUE', $cases[1]->value);
    }
}

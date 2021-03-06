<?php

namespace Tests\Fields;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Statamic\Fields\LabeledValue;
use Tests\TestCase;

class LabeledValueTest extends TestCase
{
    /** @test */
    function it_gets_the_label_and_value()
    {
        $obj = new LabeledValue('world', 'World');

        $this->assertEquals('world', $obj->value());
        $this->assertEquals('World', $obj->label());
    }

    /** @test */
    function it_converts_to_a_string()
    {
        $this->assertSame('world', (new LabeledValue('world', 'World'))->__toString());
        $this->assertSame('',  (new LabeledValue(null, null))->__toString());
        $this->assertSame('4',  (new LabeledValue(4, 'Four'))->__toString());
    }

    /** @test */
    function it_converts_to_an_array()
    {
        $val = new LabeledValue('world', 'World');

        $this->assertInstanceOf(Arrayable::class, $val);
        $this->assertEquals([
            'key' => 'world',
            'value' => 'world',
            'label' => 'World'
        ], $val->toArray());
    }
}

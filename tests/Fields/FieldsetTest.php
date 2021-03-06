<?php

namespace Tests\Fields;

use Tests\TestCase;
use Statamic\Fields\Field;
use Statamic\Fields\Fields;
use Statamic\Fields\Fieldset;
use Illuminate\Support\Collection;
use Facades\Statamic\Fields\FieldsetRepository;

class FieldsetTest extends TestCase
{
    /** @test */
    function it_gets_the_handle()
    {
        $fieldset = new Fieldset;
        $this->assertNull($fieldset->handle());

        $return = $fieldset->setHandle('test');

        $this->assertEquals($fieldset, $return);
        $this->assertEquals('test', $fieldset->handle());
    }

    /** @test */
    function it_gets_contents()
    {
        $fieldset = new Fieldset;
        $this->assertEquals([], $fieldset->contents());

        $contents = [
            'sections' => [
                'main' => [
                    'fields' => ['one' => ['type' => 'text']]
                ]
            ]
        ];

        $return = $fieldset->setContents($contents);

        $this->assertEquals($fieldset, $return);
        $this->assertEquals($contents, $fieldset->contents());
    }

    /** @test */
    function it_gets_the_title()
    {
        $fieldset = (new Fieldset)->setContents([
            'title' => 'Test'
        ]);

        $this->assertEquals('Test', $fieldset->title());
    }

    /** @test */
    function the_title_falls_back_to_a_humanized_handle()
    {
        $fieldset = (new Fieldset)->setHandle('the_blueprint_handle');

        $this->assertEquals('The blueprint handle', $fieldset->title());
    }

    /** @test */
    function it_gets_fields()
    {
        $fieldset = new Fieldset;

        $fieldset->setContents([
            'fields' => [
                'one' => [
                    'type' => 'text'
                ],
                'two' => [
                    'type' => 'textarea'
                ]
            ]
        ]);

        $fields = $fieldset->fields();

        $this->assertInstanceOf(Collection::class, $fields);
        $this->assertEveryItemIsInstanceOf(Field::class, $fields);
        $this->assertEquals(['one', 'two'], $fields->map->handle()->values()->all());
        $this->assertEquals(['text', 'textarea'], $fields->map->type()->values()->all());
    }

    /** @test */
    function gets_a_single_field()
    {
        $fieldset = new Fieldset;

        $fieldset->setContents([
            'fields' => [
                'one' => [
                    'type' => 'textarea',
                    'display' => 'First field'
                ]
            ]
        ]);

        $field = $fieldset->field('one');

        $this->assertInstanceOf(Field::class, $field);
        $this->assertEquals('First field', $field->display());
        $this->assertEquals('textarea', $field->type());

        $this->assertNull($fieldset->field('unknown'));
    }

    /** @test */
    function it_saves_through_the_repository()
    {
        FieldsetRepository::shouldReceive('save')->with($fieldset = new Fieldset)->once();

        $return = $fieldset->save();

        $this->assertEquals($fieldset, $return);
    }
}

<?php

namespace Tests\Tags;

use Tests\TestCase;
use Statamic\Tags\Tags;
use Statamic\Facades\Antlers;
use Tests\TestDependency;
use Statamic\Tags\Context;
use Statamic\Tags\Parameters;

class TagsTest extends TestCase
{
    /** @test */
    public function tags_get_initialized_correctly()
    {
        $class = app(TestTags::class);

        $class->setProperties([
            'parser' => $parser = Antlers::parser(),
            'content' => 'This is the tag content',
            'context' => ['foo' => 'bar'],
            'parameters' => ['limit' => 3],
            'tag' => 'test:listing',
            'tag_method' => 'listing',
        ]);

        $this->assertEquals('This is the tag content', $class->content);
        $this->assertInstanceOf(Context::class, $class->context);
        $this->assertEquals(['foo' => 'bar'], $class->context->all());
        $this->assertInstanceOf(Parameters::class, $class->parameters);
        $this->assertEquals(['limit' => 3], $class->parameters->all());
        $this->assertEquals('test:listing', $class->tag);
        $this->assertEquals('listing', $class->method);
        $this->assertEquals($parser, $class->parser);
        $this->assertInstanceOf(TestDependency::class, $class->dependency);
    }
}

class TestTags extends Tags
{
    public $dependency;

    public function __construct(TestDependency $dependency)
    {
        $this->dependency = $dependency;
    }
}
